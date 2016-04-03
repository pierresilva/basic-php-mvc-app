<?php

    require '../autoloader.php';

    use Core\App;

    class Index extends App {

        public function __construct ()
        {
            parent::__construct ();

        }

    }

    new Index;
    