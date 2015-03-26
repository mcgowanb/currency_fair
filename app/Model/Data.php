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

class Data extends AppModel
{

    private $new;
    public static $timer;
    public static $requested = false;
    public $useTable = false;
    public static $keepAlive;
    public static $heap;

    public function __construct($id = false, $table = null, $ds = null) {

        parent::__construct($id, $table, $ds);
        $this->new = false;
    }

    public static function add($str){
        self::$heap->enqueue($str);
    }



//infinte to be called from a cronjob i hope
    public static function infinite() {

        self::$heap = new SplQueue();
        self::$keepAlive = true;

        while (self::$keepAlive) {
//            if (!self::$requested) {
//                if (!self::$heap->isEmpty()) {
//                    self::$heap->dequeue();
//                }
//                if (self::$timer == 5) {
//                    self::$requested = false;
//                    self::$timer = 0;
//                }
//                CakeLog::write('logs', self::$heap->count());
//            } else {
//                if (self::$requested) {
//                    self::$timer++;
//                }
//            }
            CakeLog::write('debug', self::$heap->count());
            usleep(1000000);
        }
    }

    /**
     * @return mixed
     * shifts first element from the stack for rendering
     * returns null if empty stack
     */
    public function getObj() {

        self::$requested = true;
        return self::$heap->dequeue();
    }

    /**
     * @param $json
     * takes json data & writes to file
     * @return bool
     */
    public function saveDataToFile($json) {

        $file = $this->getFile();

        $file->flock(LOCK_EX);
        $file->fwrite($json . PHP_EOL);
        $file = null;
        //add to stack
        $obj = $this->__parseJson($json);
        self::$heap->enqueue($obj);
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


}