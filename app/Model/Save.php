<?php
/**
 * Created by PhpStorm.
 * User: brian
 * Date: 21/03/2015
 * Time: 20:34
 */
App::uses('AppModel', 'Model');
App::uses('Folder', 'Utility');

class Save extends AppModel {
    private $delay;
    private $userSummary;
    private $uSumtTable;
    private $lineNumber;
    private $date;

    public function __construct($id = false, $table = null, $ds = null) {
        $this->delay = 3;
        $this->alias = 'User';
        $this->uSumTable = ClassRegistry::init('user_summary');
        $this->lineNumber = 1;
        $this->date = date('d_m_Y');

        parent::__construct($id, $table, $ds);
    }

    public $useTable = 'users';

    /**
     * Called via shell script
     */
    public function readAndSave() {

        $this->saveFileData();
        $file = null;
        debug('thread kill');
        die;

    }

    /**
     * reads file data, parses & stores in database
     */
    private function saveFileData() {
        //read all lines and store in arrays, save all at end of read. store read location and sleep
        //load from last location and read again, continue and sleep
        while (true) { //set timer here
            $file = $this->loadFile();
            $file->seek($this->lineNumber);
            $change = false;
            $db = $this->getDataSource();

            while (!$file->eof()) {
                $db->begin();
                $change = true;

                try {
                    $line = $file->fgets();

                    if (empty($line)) {
                        break 1;
                    }
                    $this->parseData($line);
                    $file->next();
                    $this->lineNumber++;
                    $db->commit();
                } catch (Exception $e) {
                    $db->rollback();
                }
            }

            if ($change) { // if only blank line needs handling here
                $db->begin();
                try {
                    //more updates here as other summaries get added
                    $this->updateUserSummary(); // delete all is failing
                    $db->commit();
                } catch (Exception $e) {
                    $this->log($e->getMessage());
                    $db->rollback();
                }
            }
            unset($file);
            unset($db);
            sleep($this->delay);
        }
    }

    /**
     * @throws Exception
     * Upates user Summary table
     */
    private function updateUserSummary() {
        $this->uSumTable->useTable = 'user_summary';

        $delOptions = array(
            'conditions' => array(
                'date' => $this->date
            )
        );

        if (!$this->uSumTable->delete($delOptions)) {
            throw new Exception('error deleting user summary data');
        }


        $data = array();
        foreach ($this->userSummary as $k => $v) {
            $record = array(
                'date' => date('Y-m-d'),
                'user_id' => $k,
                'total' => $v
            );
            $data[][$this->uSumTable->alias] = $record;
        }
        $this->uSumTable->create();
        if (!$this->uSumTable->saveAll($data)) {
            throw new Exception('error saving user summaries');
        }
    }

    /**
     * @param $data
     * @throws Exception
     * parses file record object to summarise data & store in database
     */
    private function parseData($data) {
        $d = json_decode($data);
        $val[$this->alias] = array('id' => $d->userId);

        //creates element for first time
        if (!isset($this->userSummary[$d->userId])) {
            $this->userSummary[$d->userId] = 0;
        }
        $this->userSummary[$d->userId]++;


        $this->create();
        if (!$this->save($val)) {
            throw new Exception('Error saving user Id');
        }

    }

    /**
     * @return SplFileObject
     * loads and return file object. If no file exists yet, sleep and
     * try again.
     */
    private function loadFile() {
        $folder_path = APP . DS . 'data';
        $filePath = $folder_path . DS . $this->date;

        $dir = new Folder();

        //create Folder
        if (!is_dir($folder_path)) {
            $dir->create($folder_path);
        }

        while (!file_exists($filePath)) {
            sleep($this->delay);
        }

        $file = new SplFileObject($filePath, 'r');
        return $file;
    }

}