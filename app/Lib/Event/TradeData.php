<?php

App::uses('CakeEventListener', 'Event');

class TradeData implements CakeEventListener{
    /**
     * Returns a list of events this object is implementing. When the class is registered
     * in an event manager, each individual method will be associated with the respective event.
     *
     * ## Example:
     *
     * ```
     *    public function implementedEvents() {
     *        return array(
     *            'Order.complete' => 'sendEmail',
     *            'Article.afterBuy' => 'decrementInventory',
     *            'User.onRegister' => array('callable' => 'logRegistration', 'priority' => 20, 'passParams' => true)
     *        );
     *    }
     * ```
     *
     * @return array associative array or event key names pointing to the function
     * that should be called in the object when the respective event is fired
     */
    public function implementedEvents() {
        return array(
            'Data.post.received' => 'fireThis',
        );
    }

    public function fireThis($event){

        CakeLog::write('debug', 'Event listener fired');
        $event->subject->sse($event->data);

    }

    public function parseJson($event){
        $json = json_decode($event);

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

        unset($cntry);
        return $data;
    }


}