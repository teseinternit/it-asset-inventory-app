<?php
include "conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>

<?php
// --- Fngsi tambah data (Create)
function tambah($conn){
    
	if (isset($_POST['btn_simpan'])){
		$id = time();
        $asset_type = $_POST['tasset_type'];
        $asset_number = $_POST['tasset_number'];
        $serial_number = $_POST['tserial_number'];
        $computer_manufacturer = $_POST['tcomputer_manufacturer'];
        $computer_model = $_POST['tcomputer_model'];
        $asset_name =$_POST['tasset_name'];
        $location =$_POST['tlocation'];
        $remark = $_POST['tremark'];

        if(!empty($asset_type) && !empty($asset_number) && !empty($serial_number) && !empty($computer_manufacturer) && !empty($computer_model) && !empty($asset_name) && !empty($location) && !empty($remark)){
            $sql = "INSERT INTO asset_stock (stock_asset_id, asset_type, asset_number, serial_number, computer_manufacturer, computer_model, asset_name, location, date_modified, remark) VALUES(".$id.", ".$asset_type.", ".$asset_number.", ".$serial_number.", ".$computer_manufacturer.", ".$computer_model.", ".$asset_name.", ".$location.", CURRENT_TIMESTAMP, ".$remark.")";
            $simpan = mysqli_query($conn, $sql);
            if($simpan && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'create'){
                    header('location: dashboard.php');
                }
            }
        } else {
            $pesan = "Tidak dapat menyimpan, data belum lengkap!";
        }
    }
}
?>




<div class="header">
    <input type="text" placeholder="Find what you are looking for...">
    <div class="icons">
        <i class="fas fa-bell"></i>
        <i class="fas fa-cog"></i>
        <i class="fas fa-user-circle"></i>
    </div>
</div>

<div class="table-container">
            <div class="table-header">
                <h2>Users</h2>
                <input type="text" placeholder="Find what you are looking for...">

                <button class="btn buttonAdd" type="button" data-bs-toggle="modal" data-bs-target="#formAddNew"><i class="fa fa-plus"> </i> 
                    Add New User
                </button>

                <!-- Modal Form -->
                <div class="modal fade" id="formAddNew" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">New Asset Form</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <form id="myForm" method="POST" action="">
                                    <!-- Dropdown : Asset Type -->
                                    <div class="mb-3 w-50">
                                        <label for="asset-type-drop" class="col-form-label">Asset Type</label>
                                        <select name="tasset_type" class="form-select form-select-sm" id="asset-type-drop" aria-label="asset type label">
                                            <option selected>- select asset type -</option>
                                            <option value="1">Laptop</option>
                                            <option value="2">Tablet</option>
                                            <option value="3">Desktop</option>
                                        </select>
                                    </div>

                                    <!-- Input : Asset Number -->
                                    <div class="mb-3 w-50">
                                        <label for="assetnumber" class="col-form-label">Asset Number:</label>
                                        <input type="text" name="tasset_number"  class="form-control" id="assetnumber">
                                    </div>

                                    <!-- Input : Serial Number -->
                                    <div class="mb-3 w-50">
                                        <label for="serialnumber" class="col-form-label">Serial Number:</label>
                                        <input type="text" name="tserial_number"  class="form-control" id="serialnumber">
                                    </div>

                                    <!-- Dropdown : Computer Manufacturer (Brand) -->
                                    <div class="mb-3 w-75">
                                        <!-- <label for="comp-manf-drop" class="col-form-label">Computer Manufacturer</label>
                                        <select class="form-select form-select-sm" id="comp-manf-drop" aria-label="computer manufacturer label">
                                            <option selected>- select computer manufacturer -</option>
                                            <option value="1">Lenovo</option>
                                            <option value="2">Dell</option>
                                            <option value="3">HP</option>
                                        </select> -->
                                        <?php 
                                            $sql = "SELECT * FROM comp_brands";
                                            $result = mysqli_query($conn, $sql);
                                            $brand = $model = "";
                                        ?>
                                        <label for="brand-drop" class="col-form-label">Computer Manufacturer</label>
                                        <select name="tcomputer_manufacturer"  class="form-select form-select-sm" id="brand-drop" aria-label="computer manufacturer label" required
                                                onchange="getItem( this.value)"> 
                                            <option value="">- select computer brand -</option>
                                            <?php foreach($result as $res) :?>
                                                <option 
                                                    value="<?php echo $res['comp_brand_name'];?>"

                                                    <?php  if($brand == $res['comp_brand_name']) {?> 
                                                        selected 
                                                    <?php } ?> 
                                                > 
                                                    <?php echo $res['comp_brand_name']; ?>
                                                </option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>

                                    <!-- Dropdown : Computer Model (Series) -->
                                    <div class="mb-3 w-75">
                                        <!-- <label for="comp-model-drop" class="col-form-label">Computer Model</label>
                                        <select class="form-select form-select-sm" id="comp-model-drop" aria-label="computer manufacturer label">
                                            <option selected>- select computer model -</option>
                                            <option value="1">ThinkPad T14s Gen 3</option>
                                            <option value="2">ThinkCentre M80s</option>
                                            <option value="3">ThinkPad P15v Gen 2</option>
                                        </select> -->

                                        <?php  
                                            $sql = "SELECT * FROM comp_models WHERE comp_brand_name = '$brand'";   
                                            $result = mysqli_query($conn, $sql);
                                        ?>
                                        <label for="model-drop" class="col-form-label">Computer Model</label>
                                        <select name="tcomputer_model" class="form-select form-select-sm" id="model-drop" aria-label="computer model label" required>
                                            <!-- <option selected>- select computer model -</option> -->
                                            <?php foreach($result as $res) :?>
                                                <option 
                                                    value="<?php echo $res['comp_mod_id'];?>"

                                                    <?php  if($model == $res['comp_mod_id']) 
                                                    {?> selected <?php } ?> 
                                                > 
                                                    <?php echo $res['comp_mod_series']; ?>
                                                </option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>

                                    <label for="asset-name-drop" class="col-form-label">Asset Name</label>
                                    <select name="tasset_name" class="form-select form-select-sm" id="asset-name-drop" aria-label="asset name label">
                                        <option selected>- select asset name -</option>
                                        <option value="1">SEMB</option>
                                        <option value="2">TESE</option>
                                    </select>
                                    
                                    <label for="location-drop" class="col-form-label">Location</label>
                                    <select name="tlocation" class="form-select form-select-sm" id="location-drop" aria-label="asset location label">
                                        <option selected>- select asset location -</option>
                                        <option value="1">Gudang IT lantai 2</option>
                                        <option value="2">IT Room Lantai 3</option>
                                        <option value="3">Gudang Method Lantai 2</option>
                                        <option value="4">Gudang Maintenance PCBA</option>
                                        <option value="5">Server Room</option>
                                    </select>

                                    <div class="mb-3">
                                        <label for="message-text" class="col-form-label">Message:</label>
                                        <textarea name="tremark" class="form-control" id="message-text"></textarea>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" name="badd" class="btn btn-success">Add</button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            <div class= table-scroll>
            <table id="userTable">
                <thead>
                    <tr>
                        <th><input type="checkbox"></th>
                        <th>Match</th>
                        <th>No.</th>
                        <th>Employee ID</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Date Created</th>
                        <th>Date Modified</th>
                        <th>Action</th>
                    </tr>
                </thead>
            <?php
                $no = 1;
                $tampil = mysqli_query($conn, "SELECT * FROM it_team order by itteam_id asc");

                ?>
                <tbody>
                    <?php while ($data = mysqli_fetch_array($tampil)) {?>
                        <tr>
                        <td><input type="checkbox"></td>
                        <td></td>
                        <td><?=$no++ ?></td>
                        <td><?=$data['employee_id']?></td>
                        <td><?=$data['email']?></td>
                        <td><?=$data['name']?></td>
                        <td><?=$data['role']?></td>
                        <td><?=$data['created_at']?></td>
                        <td><?=$data['updated_at']?></td>
                        <td>
                            <a href="#" class="btn btn-warning">Edit</a>
                            <a href="#" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                   <?php 
                }?> 
            </tbody>
        </table>
    </div>
</div>

<div class="footer">
    <span>Selected 1 of 34 Items</span>
    <div>
        <button><i class="fa fa-print" ></i> Print to pdf</button>
    </div>
</div>
</body>
</html>