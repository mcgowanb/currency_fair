<?php

App::uses('AppController', 'Controller');
App::uses('EventController', 'Controller');
App::uses('CakeEventManager', 'Event');
App::uses('TradeData', 'Lib/Event');

class DataController extends AppController{

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

        $this->layout = false;

        $this->loadModel('Read');
        $data = $this->Read->getData();


        $lat = $data['lat'];
        $lng = $data['lng'];
        $msg = $data['msg'];

        $this->set(compact('lat', 'lng', 'msg'));
        $this->render('/Elements/sse');
    }

    public function test_event() {

        $data = array(
            'lat' => 'lattitude',
            'lng' => 'longigiggi',
            'msg' => 'my message here'
        );
        $this->autoRender = false;
        $this->layout = false;
        $event = new CakeEvent('Data.post.received', $this, array('data', $data));
        $this->getEventManager()->dispatch($event);

        echo('blah blah');

    }

    public function blah(){
        $td = new EventController();
        $td->fireThis();
        $this->autoRender - false;
    }


    public function test_listener($data = null) {

        $trade = new EventController();
        $this->getEventManager()->attach($trade);

        $this->layout = false;

        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');

        $lat = $data['lat'];
        $lng = $data['lng'];
        $msg = $data['msg'];

        $this->set(compact('lat', 'lng', 'msg'));
        $this->render('/Elements/sse');


    }

    public function deleteAndInsert($deleteId, $newData) {
        $dataSource = $this->getDataSource();

        try {
            $dataSource->begin();

            if (!$this->delete($deleteId)) {
               throw new Exception('Error deleting ID');
            }

            if (!$this->save($newData)) {
                throw new Exception('Error Storing new data');
            }

            $dataSource->commit();
            return 'Action completed successfully';

        }catch(Exception $e){
            $dataSource->rollback();
            return $e->getMessage();
        }
    }



}