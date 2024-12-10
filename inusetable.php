<?php
include "conn.php";
?>

<div class="table-container">
    <div class="table-header">
        <h2>Asset Aktif</h2>

        <!-- Tombol Modal Form -->
        <button class="btn buttonAdd" type="button" data-bs-toggle="modal" data-bs-target="#formAddNew"><i class="fa fa-plus"> </i>
            Add New Asset
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
                        <form>
                            <!-- Dropdown : ??? -->
                            <div class="mb-3 w-50">
                                <label for="asset-type-drop" class="col-form-label">Asset Type</label>
                                <select class="form-select form-select-sm" id="asset-type-drop" aria-label="asset type label">
                                    <option selected>- select asset type -</option>
                                    <option value="1">Laptop</option>
                                    <option value="2">Tablet</option>
                                    <option value="3">Desktop</option>
                                </select>
                            </div>

                            <!-- Input : ??? -->
                            <div class="mb-3 w-50">
                                <label for="assetnumber" class="col-form-label">Asset Number:</label>
                                <input type="text" class="form-control" id="assetnumber">
                            </div>

                            <!-- Input : ??? -->
                            <div class="mb-3 w-50">
                                <label for="serialnumber" class="col-form-label">Serial Number:</label>
                                <input type="text" class="form-control" id="serialnumber">
                            </div>

                            <!-- Dropdown : ??? -->
                            <div class="mb-3 w-75">
                                <label for="comp-manf-drop" class="col-form-label">Computer Manufacturer</label>
                                <select class="form-select form-select-sm" id="comp-manf-drop" aria-label="computer manufacturer label">
                                    <option selected>- select computer manufacturer -</option>
                                    <option value="1">Lenovo</option>
                                    <option value="2">Dell</option>
                                    <option value="3">HP</option>
                                </select>
                            </div>

                            <!-- Dropdown : Computer Model (Series) -->
                            <div class="mb-3 w-75">
                                <label for="comp-model-drop" class="col-form-label">Computer Model</label>
                                <select class="form-select form-select-sm" id="comp-model-drop" aria-label="computer manufacturer label">
                                    <option selected>- select computer model -</option>
                                    <option value="1">ThinkPad T14s Gen 3</option>
                                    <option value="2">ThinkCentre M80s</option>
                                    <option value="3">ThinkPad P15v Gen 2</option>
                                </select>

                            </div>

                            <label for="asset-name-drop" class="col-form-label">Asset Name</label>
                            <select class="form-select form-select-sm" id="asset-name-drop" aria-label="asset name label">
                                <option selected>- select asset name -</option>
                                <option value="1">SEMB</option>
                                <option value="2">TESE</option>
                            </select>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Message:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=table-scroll>
        <table id="assetTable">
            <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>Match</th>
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
                        <!-- inputan filter berupa pemilihan tanggal -->
                        <label for="datefilter">Date Modified</label>
                        <input type="date" id="datefilter">
                    </th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="checkbox"></td>
                    <td></td>
                    <td>Laptop</td>
                    <td>30027522</td>
                    <td>PF425D8G</td>
                    <td>Lenovo</td>
                    <td>ThinkPad T14s Gen 3</td>
                    <td>SEMB</td>
                    <td>Gudang IT</td>
                    <td>31/10/2024</td>
                    <td>pc dalam keadaan mati</td>
                </tr>
                <tr>
                    <td><input type="checkbox"></td>
                    <td></td>
                    <td>Desktop</td>
                    <td>30027701</td>
                    <td>PC2LPJSE</td>
                    <td>Lenovo</td>
                    <td>M80q Tiny</td>
                    <td>TESE</td>
                    <td>IT room</td>
                    <td>31/11/2024</td>
                    <td>pc dalam keadaan mati</td>
                </tr>
                <!-- <tr>
                    <td><input type="checkbox"></td>
                    <td></td>
                    <td>Tablet</td>
                    <td>No Tag</td>
                    <td>PC2LPJSX</td>
                    <td>Lenovo</td>
                    <td>IdeaPad Miix</td>
                    <td>No Tag</td>
                    <td>Server Room</td>
                    <td>31/12/2024</td>
                    <td>pc dalam keadaan mati</td>
                </tr> -->
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