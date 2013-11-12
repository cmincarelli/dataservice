<?php
class ProductCatalogClass extends CatalogClass {
    protected $model = 'products';
    
    protected function read1($product) {
        $params = array(
            'products' => explode(',',$product),
            'product_fields' => array_keys($this->config['models']['product']['fields']),
        );
        return $this->_read($params);
    }
}



?>