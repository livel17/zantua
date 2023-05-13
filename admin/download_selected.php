<?php
include "../dbcon.php";

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; Filename = " ."Products". "-" ."All". "_List.xls");

// Get the selected product IDs from the POST data
$selectedIDs = explode(',', $_POST['selected_ids']);

// Create a comma-separated string of the selected IDs for use in the SQL query
$idString = implode(',', $selectedIDs);

?>
<table border="1">
    <thead>
        <tr>
            <th>stock_No</th>
            <th>name</th>
            <th>cost</th>
            <th>retail_price</th>
            <th>quantity</th>
            <th>barcodes</th>
            <th>tags</th>
            <th>taxes</th>
            <th>tax_exempt</th>
            <th>description</th>
            <th>enable_decimal</th>
            <th>enable_open_price</th>
            <th>disable_discount</th>
            <th>disable_inventory</th>
            <th>supplier_name</th>
            <th>supplier_list</th>
            <th>category_name</th>
            <th>subcategory</th>
            <th>status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch the rows with the selected IDs from the database
        $sql = $conn->query("SELECT * FROM products WHERE id IN ($idString)");
        while($row = $sql->fetch(PDO::FETCH_ASSOC)){
        ?>
        <tr>
            <td><?php echo $row['stock_No']?></td>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['cost']?></td>
            <td><?php echo $row['retail_price']?></td>
            <td><?php echo $row['quantity']?></td>
            <td><?php echo $row['barcodes']?></td>
            <td><?php echo $row['tags']?></td>
            <td><?php echo $row['taxes']?></td>
            <td><?php echo $row['tax_exempt']?></td>
            <td><?php echo $row['description']?></td>
            <td><?php echo $row['enable_decimal']?></td>
            <td><?php echo $row['enable_open_price']?></td>
            <td><?php echo $row['disable_discount']?></td>
            <td><?php echo $row['disable_inventory']?></td>
            <td><?php echo $row['supplier_name']?></td>
            <td><?php echo $row['supplier_list']?></td>
            <td><?php echo $row['category_name']?></td>
            <td><?php echo $row['subcategory']?></td>
            <td><?php echo $row['status']?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>
