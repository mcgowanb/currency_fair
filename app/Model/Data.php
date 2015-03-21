<?php
/**
 * Created by PhpStorm.
 * User: brian
 * Date: 20/03/2015
 * Time: 22:14
 */
App::uses('AppModel', 'Model');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class Data extends AppModel{

    public $useTable = false; // This model does not use a database table


    public function saveDataToFile($json){
        $file = $this->getFile();

        $file->fwrite($json."\n");
        $file = null;



        debug($json);die;
    }

    private function getFile(){
        $folder_path = APP .DS. 'data';
        $date = date('d_m_Y');

        $dir = new Folder();

        //create Folder
        if (!is_dir($folder_path)) {
            $dir->create($folder_path);
        }

        $file = new SplFileObject($folder_path.DS.$date, 'a');
        return $file;

    }

}