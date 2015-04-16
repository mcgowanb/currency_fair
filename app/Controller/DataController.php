<?php

App::uses('AppController', 'Controller');

class DataController extends AppController
{

    public function post_json() {

        $this->autoRender = false;
        if ($this->request->is('post')) {
            $data = $this->request->input();
            $result = $this->Data->saveDataToFile($data);
            echo $result;
        } else {
            throw new UnauthorizedException('Unauthorized access. Post data only');
        }
    }

    public function index() {

        $this->render('/Elements/index');
    }


    public function sse() {

        $this->autoRender = false;
        $this->layout = false;

        $this->loadModel('Read');
        $data = $this->Data->getData();


        $lat = $data['lat'];
        $lng = $data['lng'];
        $msg = $data['msg'];

        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');

        $this->set(compact('lat', 'lng', 'msg'));
        $this->render('/Elements/sse');
    }
}