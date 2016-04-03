<?php
    require 'config.php';
    /**
     * 
     * @return boolean
     */
    function loader ( $namespace )
    {
        $file_path = BASE_PATH . DIRECTORY_SEPARATOR . str_replace ( '\\', DIRECTORY_SEPARATOR, $namespace ) . '.php';

        if ( file_exists ( $file_path ) )
        {
            spl_autoload ( $namespace );
            require $file_path;
            return true;
        }

    }

    spl_autoload_register ( 'loader' );
    