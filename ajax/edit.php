<?php
if( isset($_GET['row']) ){

    $id = $_GET['row'];
    $productName = $_GET['product_name'];
    $quantityInStock = $_GET['quantity_in_stock'];
    $pricePerItem = $_GET['price_per_item'];
    $datetime_submitted = $_GET['datetime_submitted'];
    $totalValue = intval($quantityInStock) * intval($pricePerItem);

    $jsonString = file_get_contents('data.json');
    $data = json_decode($jsonString, true);

    foreach ($data as $key => $value) {
    if ($value['row_id'] == $id) {
        // Edit the element
        $data[$key]['product_name'] = $productName;
        $data[$key]['quantity_in_stock'] = $quantityInStock;
        $data[$key]['price_per_item'] = $pricePerItem;
        $data[$key]['datetime_submitted'] = $datetime_submitted;
        $data[$key]['total_value'] = $totalValue;
    }
    }

    $newJsonString = json_encode($data);
    $t = file_put_contents('data.json', $newJsonString);

    if($t){
        echo "success";
    }else{
        echo "failed";
    }
}