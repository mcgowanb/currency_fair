<?php

    App::uses('AppController', 'Controller');

    class DataController extends AppController {


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

        public function sse_test(){
            $this->layout = false;
            header('Content-Type: text/event-stream');
            header('Cache-Control: no-cache');

            $time = date('r');
            $data = "data: The server time is: {$time}\n\n";

            $id = 3;
            $msg = 'dgsgde';

            $this->set(compact('id','msg'));
            $this->render('/Elements/sse');
        }

        public function view(){
            $this->render('/Elements/test');
        }


    }