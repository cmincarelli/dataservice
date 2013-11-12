<?php

class CatalogClass extends RPCClass {
    protected $config;
    protected $lang;
    
    public function __construct($brand,$locale,$lang=null) {
        global $CatalogConfig;
        
        $this->config = $CatalogConfig[strtolower($brand)][strtolower($locale)];
        $this->lang = $lang ? $lang : $this->config['language'][0];
        
        $this->config['models'] = array_merge_recursive($this->config['models'], $CatalogConfig['Models']);
    }
    
    public function __call($name,$args) {
        $count = count($args);
        $method = "$name$count";
        return call_user_func_array(array($this, $method), $args);
    }
    
    protected function _read($params){
        $paramArray = array();
        array_push($paramArray,$params);
        $json = array(
            'method' => $this->config['method'],
            'params' => $paramArray
        );
        $payload = array();
        array_push($payload,$json);
        return $this->executeQuery('GET',$payload);

    }
    
    /* full crud implimentation */
    
    protected function create0() {
        return $this->_read(array());
    }
        
    protected function read0() {
        return $this->_read(array());
    }
    
    protected function update0() {
        return $this->_read(array());        
    }
    
    protected function delete0() {
        return $this->_read(array());
    }
    
    protected function parse($model,$data,$override=null){
        $override = $override ? $override : $model;
        $returns = $this->config['models'][$model]['returns'];
        $object = $this->config['models'][$model]['object'];
        $contains = array_keys($this->config['models'][$model]['contains']);
        
        if(property_exists($data,$override)){
            foreach($data->$override as $item){
                $vars = get_object_vars($item);
                foreach($vars as $oldKey => $oldValue){
                    if(in_array($oldKey,$contains)){
                        $model = $this->config['models'][$model]['contains'][$oldKey];
                        $this->parse($model,$item,$oldKey);
                    } else {
                        $newKey = $this->config['models'][$object]['fields'][$oldKey];
                        if($this->config['models'][$object]['map'][$oldKey]){
                            if($this->config['models'][$object]['map'][$oldKey][$oldValue]){
                                $oldValue = $this->config['models'][$object]['map'][$oldKey][$oldValue];
                            } else {
                                $oldValue = $this->config['models'][$object]['map'][$oldKey]['default'];
                            }
                        }
                        $item->$newKey = $oldValue;
                        unset($item->$oldKey);
                    }
                }
            }
        } else {
            $vars = get_object_vars($data);
            foreach($vars as $oldKey => $oldValue){
                if(in_array($oldKey,$contains)){
                    $model = $this->config['models'][$model]['contains'][$oldKey];
                    $this->parse($model,$data);
                } else {
                    $newKey = $this->config['models'][$object]['fields'][$oldKey];  
                    if($this->config['models'][$object]['map'][$oldKey]){
                        if($this->config['models'][$object]['map'][$oldKey][$oldValue]){
                            $oldValue = $this->config['models'][$object]['map'][$oldKey][$oldValue];
                        } else {
                            $oldValue = $this->config['models'][$object]['map'][$oldKey]['default'];
                        }
                    } 
                    $item->$newKey = $oldValue;
                    unset($item->$oldKey);
                }
            }
        }
        
        return $this->prettyPrint(json_encode($data));
    }
}



?>