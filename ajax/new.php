<?php
error_reporting(0);
if( isset($_GET["q"]) ){

    // Get the data sent from the form
    $productName = $_GET['product_name'];
    $quantityInStock = $_GET['quantity_in_stock'];
    $pricePerItem = $_GET['price_per_item'];

    // Calculate the total value
    $totalValue = $quantityInStock * $pricePerItem;
    $datetime_submitted = date('Y-m-d H:i:s');
    $id = rand(999, 99999999);

    // Create a matrix to represent the data
    $data = array(
        'row_id' => $id,
        'product_name' => $productName,
        'quantity_in_stock' => $quantityInStock,
        'price_per_item' => $pricePerItem,
        'datetime_submitted' => $datetime_submitted,
        'total_value' => $totalValue
    );

    // Read data in a JSON file
    $existingData = json_decode(file_get_contents('data.json'), true);

    // Add the new data to the array
    $existingData[] = $data;

    // Display data
    foreach ($existingData as $row) {
    ?>
        <tr>
            <th id="<?php echo $row['row_id'] . $row['product_name']; ?>" ondblclick="edit('<?php echo $row['row_id']; ?>', '<?php echo $row['row_id'] . $row['product_name']; ?>', '<?php echo $row['row_id'] . $row['quantity_in_stock']. 1; ?>', '<?php echo $row['row_id'] . $row['price_per_item'] . 2; ?>', '<?php echo $row['row_id'] . $row['datetime_submitted']; ?>', '<?php echo $row['row_id'] . $row['total_value']; ?>')" > <?php echo $row['product_name']; ?> </th>
            <th id="<?php echo $row['row_id'] . $row['quantity_in_stock']. 1; ?>" ondblclick="edit('<?php echo $row['row_id']; ?>', '<?php echo $row['row_id'] . $row['product_name']; ?>', '<?php echo $row['row_id'] . $row['quantity_in_stock']. 1; ?>', '<?php echo $row['row_id'] . $row['price_per_item'] . 2; ?>', '<?php echo $row['row_id'] . $row['datetime_submitted']; ?>', '<?php echo $row['row_id'] . $row['total_value']; ?>')" > <?php echo $row['quantity_in_stock']; ?> </th>
            <th id="<?php echo $row['row_id'] . $row['price_per_item'] . 2; ?>" ondblclick="edit('<?php echo $row['row_id']; ?>', '<?php echo $row['row_id'] . $row['product_name']; ?>', '<?php echo $row['row_id'] . $row['quantity_in_stock']. 1; ?>', '<?php echo $row['row_id'] . $row['price_per_item'] . 2; ?>', '<?php echo $row['row_id'] . $row['datetime_submitted']; ?>', '<?php echo $row['row_id'] . $row['total_value']; ?>')"> <?php echo $row['price_per_item']; ?> </th>
            <th id="<?php echo $row['row_id'] . $row['datetime_submitted']; ?>" ondblclick="edit('<?php echo $row['row_id']; ?>', '<?php echo $row['row_id'] . $row['product_name']; ?>', '<?php echo $row['row_id'] . $row['quantity_in_stock']. 1; ?>', '<?php echo $row['row_id'] . $row['price_per_item'] . 2; ?>', '<?php echo $row['row_id'] . $row['datetime_submitted']; ?>', '<?php echo $row['row_id'] . $row['total_value']; ?>')"> <?php echo $row['datetime_submitted']; ?> </th>
            <th id="<?php echo $row['row_id'] . $row['total_value']; ?>" class="total-value" ondblclick="edit('<?php echo $row['row_id']; ?>', '<?php echo $row['row_id'] . $row['product_name']; ?>', '<?php echo $row['row_id'] . $row['quantity_in_stock']. 1; ?>', '<?php echo $row['row_id'] . $row['price_per_item'] . 2; ?>', '<?php echo $row['row_id'] . $row['datetime_submitted']; ?>', '<?php echo $row['row_id'] . $row['total_value']; ?>')"> <?php echo $row['total_value']; ?> </th>
            <th>
                <button id="<?php echo $row['row_id']; ?>" type="button" class="btn btn-primary" onclick="edit(this.id, '<?php echo $row['row_id'] . $row['product_name']; ?>', '<?php echo $row['row_id'] . $row['quantity_in_stock']. 1; ?>', '<?php echo $row['row_id'] . $row['price_per_item'] . 2; ?>', '<?php echo $row['row_id'] . $row['datetime_submitted']; ?>', '<?php echo $row['row_id'] . $row['total_value']; ?>')"> edit </button>
            </th>
        </tr>
<?php
    }

    // Save the updated data in a JSON file
    file_put_contents('data.json', json_encode($existingData));

}else{
    // Read data in a JSON file
    $existingData = json_decode(file_get_contents('data.json'), true);

    // display Data
    foreach ($existingData as $row) {

    ?>
        <tr title="press dblclick on any faield to edit">
            <th id="<?php echo $row['row_id'] . $row['product_name']; ?>" ondblclick="edit('<?php echo $row['row_id']; ?>', '<?php echo $row['row_id'] . $row['product_name']; ?>', '<?php echo $row['row_id'] . $row['quantity_in_stock']. 1; ?>', '<?php echo $row['row_id'] . $row['price_per_item'] . 2; ?>', '<?php echo $row['row_id'] . $row['datetime_submitted']; ?>', '<?php echo $row['row_id'] . $row['total_value']; ?>')" > <?php echo $row['product_name']; ?> </th>
            <th id="<?php echo $row['row_id'] . $row['quantity_in_stock']. 1; ?>" ondblclick="edit('<?php echo $row['row_id']; ?>', '<?php echo $row['row_id'] . $row['product_name']; ?>', '<?php echo $row['row_id'] . $row['quantity_in_stock']. 1; ?>', '<?php echo $row['row_id'] . $row['price_per_item'] . 2; ?>', '<?php echo $row['row_id'] . $row['datetime_submitted']; ?>', '<?php echo $row['row_id'] . $row['total_value']; ?>')" > <?php echo $row['quantity_in_stock']; ?> </th>
            <th id="<?php echo $row['row_id'] . $row['price_per_item'] . 2; ?>" ondblclick="edit('<?php echo $row['row_id']; ?>', '<?php echo $row['row_id'] . $row['product_name']; ?>', '<?php echo $row['row_id'] . $row['quantity_in_stock']. 1; ?>', '<?php echo $row['row_id'] . $row['price_per_item'] . 2; ?>', '<?php echo $row['row_id'] . $row['datetime_submitted']; ?>', '<?php echo $row['row_id'] . $row['total_value']; ?>')"> <?php echo $row['price_per_item']; ?> </th>
            <th id="<?php echo $row['row_id'] . $row['datetime_submitted']; ?>" ondblclick="edit('<?php echo $row['row_id']; ?>', '<?php echo $row['row_id'] . $row['product_name']; ?>', '<?php echo $row['row_id'] . $row['quantity_in_stock']. 1; ?>', '<?php echo $row['row_id'] . $row['price_per_item'] . 2; ?>', '<?php echo $row['row_id'] . $row['datetime_submitted']; ?>', '<?php echo $row['row_id'] . $row['total_value']; ?>')"> <?php echo $row['datetime_submitted']; ?> </th>
            <th id="<?php echo $row['row_id'] . $row['total_value']; ?>" class="total-value" ondblclick="edit('<?php echo $row['row_id']; ?>', '<?php echo $row['row_id'] . $row['product_name']; ?>', '<?php echo $row['row_id'] . $row['quantity_in_stock']. 1; ?>', '<?php echo $row['row_id'] . $row['price_per_item'] . 2; ?>', '<?php echo $row['row_id'] . $row['datetime_submitted']; ?>', '<?php echo $row['row_id'] . $row['total_value']; ?>')"> <?php echo $row['total_value']; ?> </th>
            <th>
                <button title="press dblclick on any faield to edit" id="<?php echo $row['row_id']; ?>" type="button" class="btn btn-primary" onclick="edit(this.id, '<?php echo $row['row_id'] . $row['product_name']; ?>', '<?php echo $row['row_id'] . $row['quantity_in_stock']. 1; ?>', '<?php echo $row['row_id'] . $row['price_per_item'] . 2; ?>', '<?php echo $row['row_id'] . $row['datetime_submitted']; ?>', '<?php echo $row['row_id'] . $row['total_value']; ?>')"> edit </button>
            </th>
        </tr>
<?php
    }
}
?>