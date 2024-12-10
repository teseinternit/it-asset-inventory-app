<?php

include "../conn.php";

// jika tombol simpan di klik 
if (isset($_POST['badd'])) {

    // // Data akan disimpan baru
    $simpan = mysqli_query($conn, "INSERT INTO stock_asset (asset_type, asset_number, serial_number, computer_manufacturer, computer_model, asset_name, location, date_modified, remark)
                                    VALUES ( '$_POST[tasset_type]',
                                             '$_POST[tasset_number]',
                                             '$_POST[tserial_number]',
                                             '$_POST[tcomputer_manufacturer]',
                                             '$_POST[tcomputer_model]',
                                             '$_POST[tasset_name]',
                                             '$_POST[tlocation]',
                                             CURRENT_TIMESTAMP,
                                             '$_POST[tremark]' )");

    // Uji jika simpan data sukses
    if ($simpan) {
        echo "<script>
                alert('Simpan data Sukses!');
                document.location='../dashboard.php?load=stocktable';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menyimpan data!');
                document.location='../dashboard.php?load=stocktable';
              </script>";
    }
}
?>
