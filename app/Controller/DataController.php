<?php

    App::uses('AppController', 'Controller');

    class DataController extends AppController {


        public function post_json() {

            $this->autoRender = false;
            if($this->request->is('post')) {
                $data = $this->request->input();
                $data = $this->Data->saveDataToFile($data);
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

        public function eee(){
            $this->autoRender = false;
            $this->Data->infinite();
        }

        public function sse_test() {

            $this->layout = false;
            $data = $this->Data->getObj();
            header('Content-Type: text/event-stream');
            header('Cache-Control: no-cache');



            $lat = $data['lat'];
            $lng = $data['lng'];
            $msg = $data['msg'];

            $this->set(compact('lat', 'lng','msg'));
            $this->render('/Elements/sse');
        }

        public function view() {

            $this->render('/Elements/test');
        }

        public function test(){
            $this->autoRender = false;
            $data =  array(
                0 => '{"userId": "111111", "currencyFrom": "EUR", "currencyTo": "GBP", "amountSell": 1000, "amountBuy": 747.10, "rate": 0.7471, "timePlaced" : "24-JAN-15 10:27:44", "originatingCountry" : "FR"}',
                1 => '{"userId": "222222", "currencyFrom": "EUR", "currencyTo": "GBP", "amountSell": 1000, "amountBuy": 747.10, "rate": 0.7471, "timePlaced" : "24-JAN-15 10:27:44", "originatingCountry" : "GB"}',
                2 => '{"userId": "333333", "currencyFrom": "EUR", "currencyTo": "GBP", "amountSell": 1000, "amountBuy": 747.10, "rate": 0.7471, "timePlaced" : "24-JAN-15 10:27:44", "originatingCountry" : "ES"}',
                3 => '{"userId": "444444", "currencyFrom": "EUR", "currencyTo": "GBP", "amountSell": 1000, "amountBuy": 747.10, "rate": 0.7471, "timePlaced" : "24-JAN-15 10:27:44", "originatingCountry" : "CY"}',
                4 => '{"userId": "555555", "currencyFrom": "EUR", "currencyTo": "GBP", "amountSell": 1000, "amountBuy": 747.10, "rate": 0.7471, "timePlaced" : "24-JAN-15 10:27:44", "originatingCountry" : "GR"}',
                5 => '{"userId": "666666", "currencyFrom": "EUR", "currencyTo": "GBP", "amountSell": 1000, "amountBuy": 747.10, "rate": 0.7471, "timePlaced" : "24-JAN-15 10:27:44", "originatingCountry" : "IE"}',
                6 => '{"userId": "777777", "currencyFrom": "EUR", "currencyTo": "GBP", "amountSell": 1000, "amountBuy": 747.10, "rate": 0.7471, "timePlaced" : "24-JAN-15 10:27:44", "originatingCountry" : "PL"}',
                7 => '{"userId": "888888", "currencyFrom": "EUR", "currencyTo": "GBP", "amountSell": 1000, "amountBuy": 747.10, "rate": 0.7471, "timePlaced" : "24-JAN-15 10:27:44", "originatingCountry" : "IT"}',
                8 => '{"userId": "999999", "currencyFrom": "EUR", "currencyTo": "GBP", "amountSell": 1000, "amountBuy": 747.10, "rate": 0.7471, "timePlaced" : "24-JAN-15 10:27:44", "originatingCountry" : "NL"}',
                9 => '{"userId": "dddddd", "currencyFrom": "EUR", "currencyTo": "GBP", "amountSell": 1000, "amountBuy": 747.10, "rate": 0.7471, "timePlaced" : "24-JAN-15 10:27:44", "originatingCountry" : "SE"}'
            );

            $id = rand(0 , 9);
            $res = $this->Data->saveDataToFile($data[$id]);
            $this->log('running');
            return $res;
        }


    }