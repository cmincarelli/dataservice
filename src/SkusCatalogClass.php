<?php
class SkusCatalogClass extends CatalogClass {
    protected $model = 'skus';
    
    protected function read1($product) {
        $params = array(
            'products' => explode(',',$product),
            'product_fields' => array_keys(array_merge($this->config['models']['product']['fields'],array('skus' => 'skus'))),
            'sku_fields' => array_keys($this->config['models']['sku']['fields']),
        );
        return $this->_read($params);
    }
}



?>