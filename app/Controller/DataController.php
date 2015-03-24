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

        public function sse_test() {

            $this->layout = false;
            header('Content-Type: text/event-stream');
            header('Cache-Control: no-cache');

            $data = array(
                'lat' => 54.271640,
                'lng' => -8.475952,
                'country' => 'Ireland',
                'currencyFrom' => 'EUR',
                'currencyTo' => 'GBP',
                'sell' => 1000,
                'buy' => 747.1,
                'rate' => 0.7471,
                'user' => 1234
            );

            $lat = $data['lat'];
            $lng = $data['lng'];
            $country = $data['country'];
            $cFrom = $data['currencyFrom'];
            $cTo = $data['currencyTo'];
            $buy = $data['buy'];
            $sell = $data['sell'];
            $rate = $data['rate'];
            $user = $data['user'];

            $id = 3;
            $msg = 'dgsgde';

            $this->set(compact('lat', 'lng','country'));
            $this->render('/Elements/sse');
        }

        public function view() {

            $this->render('/Elements/test');
        }


    }