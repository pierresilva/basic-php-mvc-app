<?php

    namespace Core;
    
    use Core\Router;
    
    /**
     * 
     */
    class App extends Router{
        
        /**
         * $controller_dir Relative path to default controllers directory
         * @var type string
         */
        protected $controllers_dir = '../App/Controllers/';

        /**
         * $namespace Contains the default namespace for the class
         * refer to default controllers directory
         * @var type string
         */
        protected $namespace = 'App\\Controllers';                

        /**
         * $controller contain the controller name passed trowht url
         * @var type string
         */
        protected $controller = 'Home';
                
        /**
         * $method contains the method name to run passed trowht url
         * @var type string
         */
        protected $method = 'index';

        /**
         * $params contais the params passed trowht url
         * @var type array
         */
        protected $params = [ ];
               

        /**
         * 
         */
        public function __construct ()
        {
            parent::__construct();
            
            $url = $this->_parseUrl ();
            /**
             * @todo Agregar namespace, clase, metodo al la clase Router
             */
            Router::get('home/{string:name}/{int:id}', 'Home@test');
            
            $this->_loadController($url);                        

        }

        /**
         * _loadController() Load the controller, method and params in the url or Home if not specified
         * 
         * @param type $url
         * @return boolean
         */
        private function _loadController ( $url )
        {

            if ( file_exists ( $this->controllers_dir . ucfirst ( $url [ 0 ] ) . '.php' ) )
            {

                $this->controller = ucfirst ( $url [ 0 ] );
                unset ( $url [ 0 ] );                

                if ( isset ( $url [ 1 ] ) )
                {

                    if ( method_exists ( $this->namespace . '\\' . $this->controller, $url [ 1 ] ) )
                    {

                        $this->method = $url [ 1 ];
                        unset ( $url [ 1 ] );
                    }
                }                
                
            }
            
            $this->params = $url ? array_values ( $url ) : [ ];

            call_user_func_array ( [$this->namespace . '\\' . $this->controller, $this->method ], $this->params );

        }

        /**
         * _parseUrl() parse the url to return an array
         * 
         * @return An array with parts of the url
         * 
         */
        private function _parseUrl ()
        {
            $url_param = filter_input(INPUT_GET, 'url');
            
            if ( isset ( $url_param ) )
            {
                return $url = explode ( '/', filter_var ( trim ( $url_param, '/' ), FILTER_SANITIZE_URL ) );
            }
            
        }

    }
    