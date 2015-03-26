<?php
App::uses('AppShell', 'Console/Command');
App::uses('Data', 'Model');

/**
 * Import Shell
 *
 * http://cakephpsaint.wordpress.com/2013/05/15/6-steps-to-create-cron-jobs-in-cakephp/
 * uses tasks instead of components
 *
 * to execute from APP
 * "Console\cake ImportCron"
 *
 *
 * @package       app.Console.Command
 */
class ScriptsShell extends AppShell
{


    function main() {

//        $this->out('<warning>Fetching URL data, please wait</warning>');
//        $this->out();
//        $this->out('---------------------------------------------------------------');
//        Data::createTest();
//        Data::$heap->enqueue('test add');
//        $this->out(Data::$heap->isEmpty());
////        $this->out(Data::$heap->dequeue());
    }

    public function add(){
        Data::initialize();
        Data::add('mystes agdgs');
    }
    public function remove(){
        $this->out(Data::$heap->dequeue());
    }

    public function start_thread() {

        $this->out('Welcome to the Scripting Console for Currency Fair.............');
        $this->out('<warning>Starting concurrent thread...... please wait...................</warning>');
        Data::initialize();
        Data::infinite();

    }
}