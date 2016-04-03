<?php    

    namespace Core;

    /**
     * Description of Route
     *
     * @author pierremichel
     */
    class Router {                
        
        public $url_param;
        protected $string = '[a-z0-9\-_]';
        protected $int = '[0-9]';
        public $return_params = [];
        public $router_errors = [];

        public function __construct(  )
        {
            $this->url_param = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
        }
        
        public function get( $route, $action )
        {

            $url_params = explode('/', $this->url_param);
            $url_params_count = count($url_params);
            
            $route_params = explode('/', $route);
            $route_params_count = count($route_params);
            
            $action_parts = explode('@', $action);  
            
            //print_r($route_params);
            
            if($url_params_count == $route_params_count)
            {
                foreach ($url_params as $i => $url_param)
                {                    
                    if( ! $this->_parseParam( $url_param, $route_params[$i] ) )
                    {
                        return $this->router_errors;
                    }                                        
                }                
                
                call_user_func_array(['App\\Controllers\\' . $action_parts[0], $action_parts[1] ], [$this->return_params]);
            }
            
            if($this->router_errors)
            {
                print_r($this->router_errors);
            }
            
            return false;
                        
            echo '</pre>';
        }
        
        private function _parseParam( $param_url, $param_route )
        {
            if( $param_url == $param_route )
            {
                return true;
            }
            
            $route_var = [];
            
            //print $param_route;
            
            preg_match('~{(.*?)}~', $param_route, $route_var);
            
            //print_r($route_var);
            
            $r_var = explode(':', $route_var[1]);
            
            switch ( $r_var[0] )
            {
                case 'string':
                    
                    if( ereg ( $this->string, $param_url ) )
                    {
                        $this->return_params[$r_var[1]] = $param_url;
                        return true;
                    }
                    
                    $this->router_errors[] = 'La variable ' . $r_var[1] . ' solo puede contener letras minúsculas, números, - 0 _.';
                    return false;
                    
                    break;
                    
                case 'int':
                    
                    if( ereg ( $this->int, $param_url ) )
                    {
                         $this->return_params[$r_var[1]] = $param_url;
                        return true;
                    }
                    
                    $this->router_errors[] = 'La variable ' . $r_var[1] . ' debe ser un número entero.';
                    return false;

                    break;
                
                default:                                        
                    
                    $this->router_errors[] = 'La variable parece no ser valida.';
                    return false;
                    
                    break;
            }
            
        }
    }
    