<?php
/**
 * Created by PhpStorm.
 * User: brian
 * Date: 20/03/2015
 * Time: 22:14
 */
App::uses('AppModel', 'Model');
App::uses('DataProcessor', 'Model');
App::uses('Folder', 'Utility');
App::uses('CakeEvent', 'Event');

class Data extends AppModel
{
    public $useTable = false;

    /**
     * @param $json
     * takes json data & writes to file & database
     * @return bool
     */
    public function saveDataToFile($json) {

        $file = $this->getFile();

        $file->flock(LOCK_EX);
        $file->fwrite($json . PHP_EOL);
        $file = null;

        $lines = ClassRegistry::init('lines');
        $lines->create();
        $data[$lines->alias] = array(
            'string' => $json
        );
        if ($lines->save($data)) {
            return 'Data stored successfully - Thank you';
        } else {
            return 'Error saving data, please try again';
        }
    }

    /**
     * @return SplFileObject
     * if no file exists, create a new one and return the file object.
     */
    private function getFile() {

        $folder_path = APP . DS . 'data';
        $date = date('d_m_Y');
        $filePath = $folder_path . DS . $date;

        $dir = new Folder();

        //create Folder
        if (!is_dir($folder_path)) {
            $dir->create($folder_path);
        }
        $this->new = !file_exists($filePath);

        $file = new SplFileObject($filePath, 'a');
        return $file;

    }

    /**
     * returns object from db of results after parsing from parse method
     * @return array
     */
    public function getData() {

        $tab = ClassRegistry::init('lines');

        $options = array(
            'order' => array(
                'id' => 'asc'
            )
        );
        $line = $tab->find('first', $options);

        if (!empty($line)) {
            $tab->delete($line[$tab->alias]['id']);
            $obj = $this->__parseJson($line[$tab->alias]['string']);
            return $obj;
        } else {
            return null;
        }

    }

    /**
     * @param $json
     * @return array
     */
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
}