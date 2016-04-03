<?php

    namespace App\Controllers;
    use Core\Controller;

    /**
     * Description of Test
     *
     * @author pierremichel
     */
    class Test extends Controller {

        public function __construct ()
        {
            parent::__construct();

        }
        
        public function index($params = [])
        {
            echo __CLASS__ . '\\' .__FUNCTION__;
        }

    }
    