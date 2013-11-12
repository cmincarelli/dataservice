<?php
class SkuCatalogClass extends CatalogClass {
    protected $model = 'sku';
    
    protected function read1($sku) {
        $params = array(
            'skus' => explode(',',$sku),
            'sku_fields' => array_keys($this->config['models']['sku']['fields']),
        );
        return $this->_read($params);
    }
}


?>