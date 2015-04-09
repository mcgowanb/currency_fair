<?php

App::uses('AppController', 'Controller');

class DataController extends AppController {


    public function post_json() {

        //event listener here and function, then set and render the sse page

        $this->autoRender = false;
        if ($this->request->is('post')) {
            $data = $this->request->input();
            $this->Data->saveDataToFile($data);
            echo('Posted data successfully processed');
        } else {
            throw new UnauthorizedException('Unauthorized access. Post data only');
        }
    }

    public function index() {

        $this->render('/Elements/index');
    }

    //write file data to db
    public function eee() {

        $this->loadModel('Save');
        $this->Save->storeInDb();
    }

    public function sse() {

        $tradeData = new TradeData();
        $this->Data->getEventManager()->attach($tradeData);

        $this->layout = false;

        $this->loadModel('Read');
        $data = $this->Read->getData();

        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');

        $lat = $data['lat'];
        $lng = $data['lng'];
        $msg = $data['msg'];

        $this->set(compact('lat', 'lng', 'msg'));
        $this->render('/Elements/sse');
    }
}