<?php
/**
 * Created by PhpStorm.
 * User: brian
 * Date: 20/03/2015
 * Time: 22:32
 */

class DummySource extends DataSource {

    function connect() {
        $this->connected = true;
        return $this->connected;
    }

    function disconnect() {
        $this->connected = false;
        return !$this->connected;
    }

    function isConnected() {

        return true;
    }

}