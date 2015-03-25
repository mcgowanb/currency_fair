<?php
/**
 * Created by PhpStorm.
 * User: brian
 * Date: 20/03/2015
 * Time: 22:14
 */
App::uses('AppModel', 'Model');
App::uses('Folder', 'Utility');

class Data extends AppModel{

    private $new;
    private $stack;
    private $timer;
    private $requested;
    public $useTable = false;
    private $keepAlive;

    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
        $this->stack = array();
        $this->timer  = 0;
        $this->new = false;
        $this->requested = false;
        $this->keepAlive = false;
    }

    /**
     * @param boolean $keepAlive
     */
    public function setKeepAlive($keepAlive) {
        $this->keepAlive = $keepAlive;
    }



//infinte to be called from a cronjob i hope
    public function infinite(){

        while($this->keepAive){
            if(!$this->requested){
                array_shift($this->stack);
                if($this->timer == 5){
                    $this->requested = false;
                    $this->timer = 0;
                }
                $this->log('infinite write');
            }
            else if ($this->requested){
                $this->timer++;
            }
            usleep(500000);
        }
    }


    /**
     * @param $json
     * takes json data & writes to file
     * @return bool
     */
    public function saveDataToFile($json){
        $file = $this->getFile();

        $file->flock(LOCK_EX);
        $file->fwrite($json.PHP_EOL);
        $file = null;
        //add to stack
        array_push($this->stack, $this->__parseJson($json));
    }

    /**
     * @return mixed
     * shifts first element from the stack for rendering
     * returns null if empty stack
     */
    public function getObj(){
        $this->requested = true;
        return array_shift($this->stack);
    }


    /**
     * @return SplFileObject
     * if no file exists, create a new one and return the file object.
     */
    private function getFile(){
        $folder_path = APP .DS. 'data';
        $date = date('d_m_Y');
        $filePath = $folder_path.DS.$date;

        $dir = new Folder();

        //create Folder
        if (!is_dir($folder_path)) {
            $dir->create($folder_path);
        }
        $this->new = !file_exists($filePath);

        $file = new SplFileObject($filePath, 'a');
        return $file;

    }

    private function __parseJson($json){

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
        $msg = $json->timePlaced.' from '.$result[$cntry->alias]['country'].',<br>'.
            'Trading '.$json->currencyFrom.' to '.$json->currencyTo.',<br>'.
            'Buy: '.$json->amountBuy.' Sell: '.$json->amountSell.' Rate: '.$json->rate.'<br>';

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