<?php

App::uses('AppController', 'Controller');
App::uses('CakeEventListener', 'Event');

class EventController extends DataController implements CakeEventListener {


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
            'Data.event' => 'parseJson',
            'Data.post.received' => 'fireThis',
        );
    }

    public function fireThis($event = null){
        App::import('DataController', 'Controller');
        CakeLog::write('debug', 'Message from controller side');

        $data = array(
            'lat' => 'lattitude',
            'lng' => 'longigiggi',
            'msg' => 'my message here'
        );
        $this->test_listener($data);
    }
}