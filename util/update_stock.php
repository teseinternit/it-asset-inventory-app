<?php
include "../conn.php";

// Check if form is submitted
if (isset($_POST['bedit'])) {
    $id = $_POST['eid']; // Assuming you have a hidden input field for the ID
    $assetType = $_POST['easset_type'];
    $assetNumber = $_POST['easset_number'];
    $serialNumber = $_POST['eserial_number'];
    $computerManufacturer = $_POST['ecomputer_manufacturer'];
    $computerModel = $_POST['ecomputer_model'];
    $assetName = $_POST['easset_name'];
    $location = $_POST['elocation'];
    $remark = $_POST['eremark'];

    // Update query
    $update = mysqli_query($conn, "UPDATE stock_asset SET 
                                    asset_type = '$assetType',
                                    asset_number = '$assetNumber',
                                    serial_number = '$serialNumber',
                                    computer_manufacturer = '$computerManufacturer',
                                    computer_model = '$computerModel',
                                    asset_name = '$assetName',
                                    location = '$location',
                                    remark = '$remark'
                                    WHERE id = '$id'");

    // Check if update was successful
    if ($update) {
        echo "<script>
                alert('Update data Sukses!');
                document.location='../dashboard.php?load=stocktable';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mengupdate data!');
                document.location='../dashboard.php?load=stocktable';
              </script>";
    }
}
?>