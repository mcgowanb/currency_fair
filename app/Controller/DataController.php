<?php

    App::uses('AppController', 'Controller');

    class DataController extends AppController {

        public $useTable = false;

        public function post_json() {

            $this->autoRender = false;
            if($this->request->is('post')) {
                $data = $this->request->input();
                $this->Data->saveDataToFile($data);
                echo('Posted data successfully processed');
            }
            else {
                throw new UnauthorizedException('Unauthorized access. Post data only');
            }
        }

        public function index() {

            $this->render('/Elements/index');
        }

        public function rff() {

            $model = ClassRegistry::init('Save');
            $model->readAndSave();

        }


    }