<?php

class CategoriesCatalogClass extends CatalogClass {
    protected $model = 'categories';
    
    protected function read0() {
        $params = array(
            'cat_recursion' => 6,
            'categories' => array_keys($this->config['models']['categories']['defaults']),
            'category_fields' => array_keys(array_merge($this->config['models']['category']['fields'],array('children' => 'children'))),
        );
        return $this->_read($params);
    }
    
    protected function read1($category) {
        $params = array(
            'cat_recursion' => 6,
            'categories' => explode(',',$category),
            'category_fields' => array_keys(array_merge($this->config['models']['category']['fields'],array('children' => 'children'))),
        );
        return $this->_read($params);
    }
}

?>