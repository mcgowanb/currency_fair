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
    private $uList;

    public function __construct($id = false, $table = null, $ds = null) {
        $this->delay = 30;
        $this->alias = 'User';

        parent::__construct($id, $table, $ds);
    }

    public $useTable = 'users';

    public function readAndSave() {
        //todo while loop here. less than midnight, loop the thread otherwise kill it.
        $file = $this->loadFile();

        $this->saveFileData($file);
        debug($this->uList);
        die;
        //save data to db

    }

    private function saveFileData($file) {
        $db = $this->getDataSource();
        $db->begin();

        try {
            while (!$file->eof()) {
                $data = $file->current();
                $this->parseData($data);
                //array & save here
                $file->next();
            }
            $db->commit();
        }
        catch(Exception $e){
            $db->rollback();
        }


        $x = 3;
//array here with totals, then return data to save.
    }

    private function parseData($data) {
        $d = json_decode($data);
        $val[$this->alias] = array('id' => $d->userId);
        $this->create();
        if(!$this->save($val)){
            throw new Exception('Error saving data');
        }

    }

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