<?php
/**
 * Created by PhpStorm.
 * User: brian
 * Date: 21/03/2015
 * Time: 20:34
 */
App::uses('AppModel', 'Model');
App::uses('Folder', 'Utility');

class Save extends AppModel
{
    private $delay;
    private $userSummary;
    private $uSumtTable;
    private $lineNumber;
    private $date;

    public function __construct($id = false, $table = null, $ds = null) {

        $this->date = date('d_m_Y');
        $this->alias = 'Line';

        parent::__construct($id, $table, $ds);
    }

    public $useTable = 'lines';

    /**
     * Called via shell script
     */
    public function storeInDB() {

        while (true) {
            $file = $this->loadFile();
            $file->flock(LOCK_EX);
            $data = array();

            while (!$file->eof()) {
                $line = $file->fgets();

                if (empty($line)) {
                    break;
                }

                $record = array(
                        'string' => $line
                );
                $data[] = $record;
            }

            $this->create();
            $this->saveMany($data);
            unset($data);
            $file->ftruncate(0);
            //delete file data;
            $file = null;
debug('done');die;
            sleep(30);

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

        $file = new SplFileObject($filePath, 'r+');
        return $file;
    }

}