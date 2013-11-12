<?php

$CatalogConfig['clinique']['na'] = array(
    'host' => 'http://www.clinique.com',
    'endpoint' => '/rpc/jsonprc.tmpl',
    'language' => array('en_US','en_CA','fr_CA'),
    'method' => 'prodcat',
);

$CatalogConfig['clinique']['na']['models'] = array(
    'categories' => array(
        'defaults' => array(
            'CAT1667' => 'Skin Care',
            'CAT1609' => 'Men&apos;s',
            'CAT7774' => 'Gift Sets',
            'CAT9931' => 'Online Exclusive',
            'CAT1577' => 'Fragrance',
            'CAT4324' => 'Gifts',
            'CAT1592' => 'Makeup',
            'CAT1659' => 'Sun',
        ),
    ),
    'category' => array(
        'fields' => array_merge($CatalogConfig['CategoryFields'],array(

        )),
        'map' => array_merge($CatalogConfig['CategoryFieldsMap'],array(

        )),
    ),
    'product' => array(
        'fields' => array_merge($CatalogConfig['ProductFields'],array(

        )),
        'map' => array_merge($CatalogConfig['ProductFieldsMap'],array(

        )),
    ),
    'sku' => array(
        'fields' => array_merge($CatalogConfig['SkuFields'],array(

        )),
        'map' => array_merge($CatalogConfig['SkuFieldsMap'],array(

        )),
    ),
);

?>