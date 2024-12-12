<?php
include "conn.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#editbutton').on('click', function() {
                // Get the row data
                var row = $(this).closest('tr');
                var assetType = row.find('td:eq(1)').text();
                var assetNumber = row.find('td:eq(2)').text();
                var serialNumber = row.find('td:eq(3)').text();
                var computerManufacturer = row.find('td:eq(4)').text();
                var computerModel = row.find('td:eq(5)').text();
                var assetName = row.find('td:eq(6)').text();
                var location = row.find('td:eq(7)').text();
                var remark = row.find('td:eq(9)').text();

                // Populate the modal fields
                $('#edit-asset-type-drop').val(assetType);
                $('#edit-assetnumber').val(assetNumber);
                $('#edit-serialnumber').val(serialNumber);
                $('#edit-brand-drop').val(computerManufacturer);
                $('#edit-model-drop').val(computerModel);
                $('#edit-asset-name-drop').val(assetName);
                $('#edit-location-drop').val(location);
                $('#edit-message-text').val(remark);
            });
        });
    </script>
</head>
<body>
    <div class="table-container">
        <div class="table-header">
            <h2>Asset Gudang</h2>

            <!-- Tombol Modal Form Tambah Asset Baru-->
            <button class="btn buttonAdd" type="button" data-bs-toggle="modal" data-bs-target="#formAddNew"><i class="fa fa-plus"> </i> 
                Add New Asset
            </button>

            <!-- Modal Form Tambah Asset Baru-->
            <div class="modal fade" id="formAddNew" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">New Asset Form</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- <form id="myForm" method="POST" action="util/insert_stock.php"> -->
                            <form id="myForm" method="POST" action="util/insert_stock.php">
                                <!-- Dropdown : Asset Type -->
                                <div class="mb-3 w-50">
                                    <label for="asset-type-drop" class="col-form-label">Asset Type</label>
                                    <select name="tasset_type" class="form-select form-select-sm" id="asset-type-drop" aria-label="asset type label">
                                        <option selected>- select asset type -</option>
                                        <option value="Laptop">Laptop</option>
                                        <option value="Tablet">Tablet</option>
                                        <option value="Desktop">Desktop</option>
                                    </select>
                                </div>

                                <!-- Input : Asset Number -->
                                <div class="mb-3 w-50">
                                    <label for="assetnumber" class="col-form-label">Asset Number:</label>
                                    <input type="text" name="tasset_number" class="form-control" id="assetnumber">
                                </div>

                                <!-- Input : Serial Number -->
                                <div class="mb-3 w-50">
                                    <label for="serialnumber" class="col-form-label">Serial Number:</label>
                                    <input type="text" name="tserial_number" class="form-control" id="serialnumber">
                                </div>

                                <!-- Dropdown : Computer Manufacturer (Brand) -->
                                <div class="mb-3 w-75">
                                    <?php 
                                        $sql = "SELECT * FROM comp_brands";
                                        $result = mysqli_query($conn, $sql);
                                        $brand = $model = "";
                                    ?>
                                    <label for="brand-drop" class="col-form-label">Computer Manufacturer</label>
                                    <select name="tcomputer_manufacturer" class="form-select form-select-sm" id="brand-drop" aria-label="computer manufacturer label" required
                                            onchange="getItem(this.value)"> 
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

                                <!-- Dropdown : Asset Name (SEMB or TESE)  -->
                                <label for="asset-name-drop" class="col-form-label">Asset Name</label>
                                <select name="tasset_name" class="form-select form-select-sm" id="asset-name-drop" aria-label="asset name label">
                                    <option selected>- select asset name -</option>
                                    <option value="SEMB">SEMB</option>
                                    <option value="TESE">TESE</option>
                                </select>

                                <!-- Dropdown : Asset Location -->
                                <label for="location-drop" class="col-form-label">Location</label>
                                <select name="tlocation" class="form-select form-select-sm" id="location-drop" aria-label="asset location label">
                                    <option selected>- select asset location -</option>
                                    <option value="Gudang IT lantai 2">Gudang IT lantai 2</option>
                                    <option value="IT Room Lantai 3">IT Room Lantai 3</option>
                                    <option value="Gudang Method Lantai 2">Gudang Method Lantai 2</option>
                                    <option value="Gudang Maintenance PCBA">Gudang Maintenance PCBA</option>
                                    <option value="Server Room">Server Room</option>
                                </select>

                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Message:</label>
                                    <textarea name="tremark" class="form-control" id="message-text"></textarea>
                                </div>

                                <button type="submit" name="badd" class="btn btn-success">Add</button>
                            </form>
                        </div>

                
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class= table-scroll>
            <table id="assetTable">
                <thead>
                    <tr>
                        <th>Asset ID</th>
                        <th>
                            <!-- Asset Type -->
                            <div class="dropdown">
                                <button class="btn dropdown-btn btn-sm dropdown-toggle dropdown-toggle-split" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Asset Type
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Laptop</a></li>
                                    <li><a class="dropdown-item" href="#">Desktop</a></li>
                                    <li><a class="dropdown-item" href="#">Tablet</a></li>
                                </ul>
                            </div>
                        </th>
                        <th>Asset Number</th>
                        <th>Serial Number</th>
                        <th>
                            <div class="dropdown">
                                <button class="btn dropdown-btn btn-sm dropdown-toggle dropdown-toggle-split" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Computer Manufacturer
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Lenovo</a></li>
                                    <li><a class="dropdown-item" href="#">Dell</a></li>
                                    <li><a class="dropdown-item" href="#">HP</a></li>
                                </ul>
                            </div>
                        </th>
                        <th>
                            <div class="dropdown">
                                <button class="btn dropdown-btn btn-sm dropdown-toggle dropdown-toggle-split" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Computer Model
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Model1</a></li>
                                    <li><a class="dropdown-item" href="#">Model2</a></li>
                                    <li><a class="dropdown-item" href="#">Model3</a></li>
                                </ul>
                            </div>
                        </th>
                        <th>
                            <div class="dropdown">
                                <button class="btn dropdown-btn btn-sm dropdown-toggle dropdown-toggle-split" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Asset Name
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">SEMB</a></li>
                                    <li><a class="dropdown-item" href="#">TESE</a></li>
                                    <li><a class="dropdown-item" href="#">No Tag</a></li>
                                </ul>
                            </div>
                        </th>
                        <th>
                            <div class="dropdown">
                                <button class="btn dropdown-btn btn-sm dropdown-toggle dropdown-toggle-split" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Location
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Gudang IT Lt.2</a></li>
                                    <li><a class="dropdown-item" href="#">Gudang Method Lt.2</a></li>
                                    <li><a class="dropdown-item" href="#">Server Room Lt.2</a></li>
                                </ul>
                            </div>
                        </th>
                        <th>
                            Date Modified
                            <input type="date" id="datefilter">
                        </th>
                        <th>Remarks</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <?php
                    $no = 1;
                    $tampil = mysqli_query($conn, "SELECT * FROM stock_asset order by stock_asset_id asc");
                ?>
                <tbody>
                    <?php while ($data = mysqli_fetch_array($tampil)) {?>
                        <tr>
                            <td><?=$no++ ?></td>
                            <td><?=$data['asset_type']?></td>
                            <td><?=$data['asset_number']?></td>
                            <td><?=$data['serial_number']?></td>
                            <td><?=$data['computer_manufacturer']?></td>
                            <td><?=$data['computer_model']?></td>
                            <td><?=$data['asset_name']?></td>
                            <td><?=$data['location']?></td>
                            <td><?=$data['date_modified']?></td>
                            <td><?=$data['remark']?></td>
                            <td>
    <!-- ============================== EDIT FEATURE UNDER DEVELOPMENT (START) ===================================================================== -->

                                <!-- <a href="#" class="btn btn-warning btn-sm mb-3"><i class="bi bi-pen"></i></a> -->
                                <button class="btn btn-warning btn-sm mb-3" id="editbutton" type="button" data-bs-toggle="modal" data-bs-target="#formEdit">
                                    <i class="bi bi-pen"></i>
                                </button>
                                <!-- Modal Form Tambah Asset Baru-->
                                <div class="modal fade" id="formEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Asset Form</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="myEditForm" method="POST" action="util/update_stock.php">
                                                    
                                                    <input type="hidden" name="eid" id="edit-id">

                                                    <!-- Dropdown : Asset Type -->
                                                    <div class="mb-3 w-50">
                                                        <label for="edit-asset-type-drop" class="col-form-label">Asset Type</label>
                                                        <select name="easset_type" class="form-select form-select-sm" id="edit-asset-type-drop" aria-label="asset type label">
                                                            <option selected>- select asset type -</option>
                                                            <option value="Laptop">Laptop</option>
                                                            <option value="Tablet">Tablet</option>
                                                            <option value="Desktop">Desktop</option>
                                                        </select>
                                                    </div>

                                                    <!-- Input : Asset Number -->
                                                    <div class="mb-3 w-50">
                                                        <label for="edit-assetnumber" class="col-form-label">Asset Number:</label>
                                                        <input type="text" name="easset_number" class="form-control" id="edit-assetnumber">
                                                    </div>

                                                    <!-- Input : Serial Number -->
                                                    <div class="mb-3 w-50">
                                                        <label for="edit-serialnumber" class="col-form-label">Serial Number:</label>
                                                        <input type="text" name="eserial_number" class="form-control" id="edit-serialnumber">
                                                    </div>

                                                    <!-- Dropdown : Computer Manufacturer (Brand) -->
                                                    <div class="mb-3 w-75">
                                                        <?php 
                                                            $sql = "SELECT * FROM comp_brands";
                                                            $result = mysqli_query($conn, $sql);
                                                            $brand = $model = "";
                                                        ?>
                                                        <label for="edit-brand-drop" class="col-form-label">Computer Manufacturer</label>
                                                        <select name="ecomputer_manufacturer" class="form-select form-select-sm" id="edit-brand-drop" aria-label="computer manufacturer label" required
                                                                onchange="getItem(this.value)"> 
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

                                                        <?php  
                                                            $sql = "SELECT * FROM comp_models WHERE comp_brand_name = '$brand'";   
                                                            $result = mysqli_query($conn, $sql);
                                                        ?>
                                                        <label for="edit-model-drop" class="col-form-label">Computer Model</label>
                                                        <select name="ecomputer_model" class="form-select form-select-sm" id="edit-model-drop" aria-label="computer model label" required>
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

                                                    <!-- Dropdown : Asset Name (SEMB or TESE)  -->
                                                    <label for="edit-asset-name-drop" class="col-form-label">Asset Name</label>
                                                    <select name="easset_name" class="form-select form-select-sm" id="edit-asset-name-drop" aria-label="asset name label">
                                                        <option selected>- select asset name -</option>
                                                        <option value="SEMB">SEMB</option>
                                                        <option value="TESE">TESE</option>
                                                    </select>

                                                    <!-- Dropdown : Asset Location -->
                                                    <label for="edit-location-drop" class="col-form-label">Location</label>
                                                    <select name="elocation" class="form-select form-select-sm" id="edit-location-drop" aria-label="asset location label">
                                                        <option selected>- select asset location -</option>
                                                        <option value="Gudang IT lantai 2">Gudang IT lantai 2</option>
                                                        <option value="IT Room Lantai 3">IT Room Lantai 3</option>
                                                        <option value="Gudang Method Lantai 2">Gudang Method Lantai 2</option>
                                                        <option value="Gudang Maintenance PCBA">Gudang Maintenance PCBA</option>
                                                        <option value="Server Room">Server Room</option>
                                                    </select>

                                                    <div class="mb-3">
                                                        <label for="edit-message-text" class="col-form-label">Message:</label>
                                                        <textarea name="eremark" class="form-control" id="edit-message-text"></textarea>
                                                    </div>

                                                    <button type="submit" name="bedit" class="btn btn-success">Update</button>
                                                </form>
                                            </div>

                                    
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

    <!-- ============================== EDIT FEATURE UNDER DEVELOPMENT (END) ===================================================================== -->
                                <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    <?php }?> 
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
    <!-- <script>
        $(document).ready(function() {
            $('#editbutton').on('click', function() {
                // Get the row data
                var row = $(this).closest('tr');
                var id = row.find('.id').text();
                var assetType = row.find('.asset-type').text();
                var assetNumber = row.find('.asset-number').text();
                var serialNumber = row.find('.serial-number').text();
                var computerManufacturer = row.find('.computer-manufacturer').text();
                var computerModel = row.find('.computer-model').text();
                var assetName = row.find('.asset-name').text();
                var location = row.find('.location').text();
                var remark = row.find('.remark').text();

                // Populate the modal fields
                $('#edit-id').val(id);
                $('#edit-asset-type-drop').val(assetType);
                $('#edit-assetnumber').val(assetNumber);
                $('#edit-serialnumber').val(serialNumber);
                $('#edit-brand-drop').val(computerManufacturer);
                $('#edit-model-drop').val(computerModel);
                $('#edit-asset-name-drop').val(assetName);
                $('#edit-location-drop').val(location);
                $('#edit-message-text').val(remark);
            });
        });
    </script> -->
</body>
</html>

