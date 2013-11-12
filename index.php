<?php

/*
    ajax prodcat
    
    url: /brand/locale/catalog/[category|categories]/[id,ids]/products?locale=[en_US]
    
    examples:
    
    GET http://www.elcdatastore.com/clinique/na/catalog/categories -> returns default category array
    GET http://www.elcdatastore.com/clinique/na/catalog/category/1000 -> returns category 1000
    GET http://www.elcdatastore.com/clinique/na/catalog/category/1000,1001,1002
    GET http://www.elcdatastore.com/clinique/na/catalog/category/1000/products -> returns the product array in category 1000

    additional examples:

    GET http://www.elcdatastore.com/clinique/na/catalog/product/2000
    GET http://www.elcdatastore.com/clinique/na/catalog/product/2000,2001,2002
    GET http://www.elcdatastore.com/clinique/na/catalog/product/2000/skus

    GET http://www.elcdatastore.com/clinique/na/catalog/sku/3000
    GET http://www.elcdatastore.com/clinique/na/catalog/sku/3000,3001,3002
    
*/

require(dirname(__FILE__) . '/src/bootstrap.php');

$url = $_SERVER['REQUEST_URI'];
$url = preg_replace('/\?.*$/','',$url);

$lang = $_GET['locale'];
$jsonp_callback = $_GET['callback'];

list($dump,$brand,$locale,$store,$method,$id,$item) = explode('/',$url);

if($brand && $locale && $store && $method){
    
    $brand = ucfirst($brand);
    $locale = strtoupper($locale);
    $store = ucfirst($store);
    $method = ucfirst($method);
    if($item){
        $method = ucfirst($item);
    }

    $className = $method.$store."Class";
    
    $obj = new $className($brand,$locale,$lang);
    if ($jsonp_callback) $obj->setJsonp($jsonp_callback);

    $returnValue =  $id ?
        $obj->read($id)
    :
        $obj->read();
    
    print $returnValue;
       
} else {
    print "no data";
}
?>