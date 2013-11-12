<?php

$CatalogConfig['CategoryFields'] = array(
    'CATEGORY_ID' => 'categoryId',
    'CATEGORY_NAME' => 'categoryName',
    'URL' => 'url,'
    // ...
);

$CatalogConfig['ProductFields'] = array(
    'PRODUCT_ID' => 'productId',
    'PROD_RGN_NAME' => 'productName',
    'SMALL_IMAGE' => 'mppImage',
    'LARGE_IMAGE' => 'sppImage',
    'DESCRIPTION' => 'description',
    'SHORT_DESC' => 'shortDesc',
    'URL' => 'url',
    'PROD_CAT_DISPLAY_ORDER' => 'displayOrder',
    'PROD_CAT_DISPLAY_STATUS' => 'displayStatus',
    'PRODUCT_TYPE' => 'prodType',
    // ...
);

$CatalogConfig['ProductFieldsMap'] = array(
    'PRODUCT_TYPE' => array(
        '1' => 'shaded',
        '2' => 'sized',
        'default' => 'other',
    ),
    'PROD_CAT_DISPLAY_STATUS' => array(
        '7' => 1,
        'default' => 0,
    )
);

$CatalogConfig['SkuFields'] = array(
    'SKU_ID' => 'skuId',
    'PRODUCT_CODE' => 'productCode',
    'PRODUCT_SIZE' => 'size',
    'SHADENAME' => 'shade',
    // ...
);

?>