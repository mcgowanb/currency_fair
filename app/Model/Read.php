<?php
/**
 * Created by PhpStorm.
 * User: brian
 * Date: 21/03/2015
 * Time: 20:34
 */
App::uses('AppModel', 'Model');
App::uses('Folder', 'Utility');

class Read extends AppModel{

    private $countries;

    public function __construct($id = false, $table = null, $ds = null) {
        $this->alias = 'User';
        $this->lineNumber = 1;
        $this->date = date('d_m_Y');

        parent::__construct($id, $table, $ds);
    }

    public $useTable = false;


    public function getData(){
        $tab = ClassRegistry::init('lines');

        while (true){
            $line = $tab->find('first');

            if(!empty($line)){
                $tab->delete($line[$tab->alias]['id']);
                $obj = $this->__parseJson($line[$tab->alias]['string']);
                return $obj;
            }

            else{
                usleep(500000);
            }

        }

    }

    private function __parseJson($json) {

        $json = json_decode($json);

        $cntry = ClassRegistry::init('Countries');

        $options = array(
            'fields' => array(
                'lat',
                'lng',
                'country'
            ),
            'conditions' => array(
                'code' => $json->originatingCountry
            )
        );
        $result = $cntry->find('first', $options);


        $fields = array(
            'currencyFrom' => $json->currencyFrom,
            'currencyTo' => $json->currencyTo,
            'sell' => $json->amountSell,
            'buy' => $json->amountBuy,
            'rate' => $json->rate,
            'user' => $json->userId,
            'time' => $json->timePlaced,
            'msg' => 'My Message here'
        );
        $msg = $json->timePlaced . ' from ' . $result[$cntry->alias]['country'] . ',<br>' .
            'Trading ' . $json->currencyFrom . ' to ' . $json->currencyTo . ',<br>' .
            'Buy: ' . $json->amountBuy . ' Sell: ' . $json->amountSell . ' Rate: ' . $json->rate . '<br>';

        $data = array(
            'lat' => $result[$cntry->alias]['lat'],
            'lng' => $result[$cntry->alias]['lng'],
            'msg' => $msg
        );

        $this->log('running from model');
        unset($cntry);
        return $data;
    }


    /**
     * @return SplFileObject
     * loads and return file object. If no file exists yet, sleep and
     * try again.
     */
    protected function _loadFile() {
        $folder_path = APP . DS . 'data';
        $filePath = $folder_path . DS . $this->date;

        $dir = new Folder();

        //create Folder
        if (!is_dir($folder_path)) {
            $dir->create($folder_path);
        }

        while (!file_exists($filePath)) {
            usleep(500000);
        }

        $file = new SplFileObject($filePath, 'r');
        return $file;
    }
}