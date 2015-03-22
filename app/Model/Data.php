<?php
/**
 * Created by PhpStorm.
 * User: brian
 * Date: 20/03/2015
 * Time: 22:14
 */
App::uses('AppModel', 'Model');
App::uses('Folder', 'Utility');

class Data extends AppModel{

    private $new;

    public $useTable = false;

    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
        $this->new = false;
    }


    /**
     * @param $json
     * takes json data & writes to file
     */
    public function saveDataToFile($json){
        $file = $this->getFile();

        $file->flock(LOCK_EX);
        $file->fwrite($json);
        $file = null;
        debug($json);die;
    }


    /**
     * @return SplFileObject
     * if no file exists, create a new one and return the file object.
     */
    private function getFile(){
        $folder_path = APP .DS. 'data';
        $date = date('d_m_Y');
        $filePath = $folder_path.DS.$date;

        $dir = new Folder();

        //create Folder
        if (!is_dir($folder_path)) {
            $dir->create($folder_path);
        }
        $this->new = !file_exists($filePath);

        $file = new SplFileObject($filePath, 'a');
        return $file;

    }

}