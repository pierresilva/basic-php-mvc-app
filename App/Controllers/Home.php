<?php

    namespace App\Controllers;

    use Core\Controller;

    /**
     * 
     */
    class Home extends Controller {

        /**
         * 
         */
        public function __construct ()
        {
            parent::__construct ();

        }
        
        public function index($param1 = '', $param2 = '', $param3 = '')
        {
            $params = compact('param1', 'param2', 'param3');
            
            echo __CLASS__ . '::' . __FUNCTION__;
            echo '<pre>';
            print_r($params);
            echo '</pre>';
        }
        
        public function test( $params = [] )
        {
            echo '<b>Home::test</b>';
            echo '<pre>';
            print_r($params);
            echo '</pre>';
        }

    }
    