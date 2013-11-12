<?php

$CatalogConfig['Models'] = array(
    'categories' => array(
        'returns' => 'array',
        'object' => 'category',
        'contains' => array(
            'children' => 'categories',
            'products' => 'products',
        ),
    ),
    'category' => array(
        'returns' => 'object',
        'object' => 'category',
        'contains' => array(
            'children' => 'categories',
            'products' => 'products',
        ),
    ),
    'products' => array(
        'returns' => 'array',
        'object' => 'product',
        'contains' => array(
            'categories' => 'categories',
            'products' => 'products',
            'skus' => 'skus',
        ),
    ),
    'product' => array(
        'returns' => 'object',
        'object' => 'product',
        'contains' => array(
            'categories' => 'categories',
            'products' => 'products',
            'skus' => 'skus',
        ),
    ),
    'skus' => array(
        'returns' => 'array',
        'object' => 'sku',
        'contains' => array(
            'products' => 'products',
            'skus' => 'skus'
        ),
    ),
    'sku' => array(
        'returns' => 'object',
        'object' => 'sku',
        'contains' => array(
            'products' => 'products',
            'skus' => 'skus'
        ),
    ),
);

?>