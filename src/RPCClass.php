<?php

class RPCClass {
    private $counter = 1;
    private $isJsonp = false;
    private $jsonpCallback = '';
    
    protected function prettyPrint( $json )
    {
        $result = '';
        $level = 0;
        $prev_char = '';
        $in_quotes = false;
        $ends_line_level = NULL;
        $json_length = strlen( $json );

        for( $i = 0; $i < $json_length; $i++ ) {
            $char = $json[$i];
            $new_line_level = NULL;
            $post = "";
            if( $ends_line_level !== NULL ) {
                $new_line_level = $ends_line_level;
                $ends_line_level = NULL;
            }
            if( $char === '"' && $prev_char != '\\' ) {
                $in_quotes = !$in_quotes;
            } else if( ! $in_quotes ) {
                switch( $char ) {
                    case '}': case ']':
                        $level--;
                        $ends_line_level = NULL;
                        $new_line_level = $level;
                        break;

                    case '{': case '[':
                        $level++;
                    case ',':
                        $ends_line_level = $level;
                        break;

                    case ':':
                        $post = " ";
                        break;

                    case " ": case "\t": case "\n": case "\r":
                        $char = "";
                        $ends_line_level = $new_line_level;
                        $new_line_level = NULL;
                        break;
                }
            }
            if( $new_line_level !== NULL ) {
                $result .= "\n".str_repeat( "\t", $new_line_level );
            }
            $result .= $char.$post;
            $prev_char = $char;
        }

        return $result;
    }
    
    private function get($url,$payload){
        $opts = array(
          'http'=>array(
            'method'=>"GET",
          )
        );
        $context = stream_context_create($opts);
        $fullUrl = "$url&$payload";
        $file = file_get_contents($fullUrl, false, $context);
        
        $result = json_decode($file);
        $result = $result[0];
        
        if(property_exists($result,'error')){
            header(':', true, 500);
            return $this->prettyPrint(json_encode($result->error));
        } else {
            return $this->parse($this->model,$result->result->value);
        }
        

    }
    
    private function post(){
        
    }
        
    public function executeQuery($method,$payload){
        $payload[0]['id'] = $this->counter++;
        $url = $this->config['host'] . $this->config['endpoint'];
        $rpcMethod = $this->config['method'];
        $language = $this->lang;
        $fullUrl = "$url?dbgmethod=$rpcMethod&LOCALE=$this->lang";
        $method = strtolower($method);
        
        $jsonrpc = 'JSONRPC=' . urlencode(json_encode($payload));
        
        $returnValue = $this->$method($fullUrl,$jsonrpc);
        
        if($this->isJsonp()) {
            header('Content-Type: application/javascript');
        } else {
            header('Content-Type: application/json');
        }
        
        return $this->isJsonp ?
            $this->getJsonp() . "($returnValue)" :
            $returnValue;
    }

    public function isJsonp (){
        return $this->isJsonp;
    }
    
    public function setJsonp ($callback){
        $this->isJsonp = true;
        $this->jsonpCallback = $callback;
    }
    
    public function getJsonp (){
        return $this->jsonpCallback;
    }
}

?>