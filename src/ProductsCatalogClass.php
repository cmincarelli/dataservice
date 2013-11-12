<?php
class ProductsCatalogClass extends CategoriesCatalogClass {

    protected function read0() {
        return $this->_read(array());
    }
    
    protected function read1($category) {
        $params = array(
            'cat_recursion' => 6,
            'categories' => explode(',',$category),
            'category_fields' => array_keys(array_merge($this->config['models']['category']['fields'],array('products' => 'products'))),
            'product_fields' => array_keys($this->config['models']['product']['fields']),
        );
        return $this->_read($params);
    }
}



?>