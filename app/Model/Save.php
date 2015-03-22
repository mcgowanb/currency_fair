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

    public function __construct($id = false, $table = null, $ds = null) {
        $this->delay = 30;
        $this->alias = 'User';

        parent::__construct($id, $table, $ds);
    }

    public $useTable = 'users';

    /**
     * Called via shell script
     */
    public function readAndSave() {
        $file = $this->loadFile();

        $this->saveFileData($file);
        $file = null;
        debug('thread kill');
        die;

    }

    /**
     * @param $file
     * reads file data, parses & stores in database
     */
    private function saveFileData($file) {
        $db = $this->getDataSource();
        $db->begin();

        try {
            while (!$file->eof()) {
                $data = $file->current();
                $this->parseData($data);
                $file->next();
            }
            $this->updateUserSummary();
            $db->commit();
        }
        catch(Exception $e){
            debug($e->getMessage());
            $this->log($e->getMessage());
            $db->rollback();
        }


//array here with totals, then return data to save.
    }

    /**
     * @throws Exception
     * Upates user Summary table
     */
    private function updateUserSummary(){
        $uSumTable = ClassRegistry::init('user_summary');
        $uSumTable->useTable = 'user_summary';
        $data = array();
        foreach ($this->userSummary as $k => $v){
            $record = array(
                'date' => date('Y-m-d'),
                'user_id' => $k,
                'total' => $v
            );
            $data[][$uSumTable->alias] = $record;
        }
        $uSumTable->create();
        if(!$uSumTable->saveAll($data)){
            throw new Exception('error saving user summaries');
        }
        unset($uSummary);
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
        if(!isset($this->userSummary[$d->userId])){
            $this->userSummary[$d->userId] = 0;
        }
        $this->userSummary[$d->userId]++;


        $this->create();
        if(!$this->save($val)){
            throw new Exception('Error saving data');
        }

    }

    /**
     * @return SplFileObject
     * loads and return file object. If no file exists yet, sleep and
     * try again.
     */
    private function loadFile() {
        $folder_path = APP . DS . 'data';
        $date = date('d_m_Y');
        $filePath = $folder_path . DS . $date;

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