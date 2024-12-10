<?php 
include "../conn.php";

$brand = $_POST['brand'];

$query = "SELECT * FROM comp_models WHERE comp_brand_name = '$brand'";
$res = mysqli_query($conn, $query);

if(mysqli_num_rows($res) > 0){ ?>

    <option value="">- Select an item -</option>

    <?php foreach($res as $r) :?>
        <option value="<?php echo $r['comp_mod_series'];?>"> <?php echo $r['comp_mod_series'];?> </option>
    <?php endforeach ?>

<?php } ?>