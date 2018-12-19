
@extends('layouts.admin')
@section('content')


<!-- content -->
<div id="content" class="app-content" role="main">
    <div class="box">
        <!-- Content Navbar -->
        <div class="navbar md-whiteframe-z1 no-radius indigo">
            <!-- Open side - Naviation on mobile -->
            <a md-ink-ripple  data-toggle="modal" data-target="#aside" class="navbar-item pull-left visible-xs visible-sm"><i class="mdi-navigation-menu i-24"></i></a>
        </div>
        <!-- Content -->

        <div class="box-row">
            <div class="box-cell">
                <div class="box-inner padding">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading bg-white">
                                    ITEMS
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table ui-jp="dataTable"  class="table table-striped b-t b-b">
                                            <thead>
                                                <tr>
                                                    <th>Category Name</th>
                                                    <th>Item Name</th>
                                                    <th>Additional Description</th>
                                                    <th>Size</th>
                                                    <th>Colour</th>
                                                    <th>Barcode Number</th>
                                                    <th>Total Number of Items</th>
                                                    <th>Latest update date</th> 
                                                    <th>Move To Clearance</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($items)) {
                                                    foreach ($items as $item) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $item->category_name ?></td>
                                                            <td><?= $item->item_name ?></td>
                                                            <td><?= $item->item_desc ?></td>
                                                            <td><?= $item->size ?> </td>
                                                            <td><?= $item->color ?> </td>
                                                            <td><?= $item->barcode_number ?></td>
                                                            <td><?= $item->current_items_no ?></td>
                                                            <td><?= date('d-m-Y', strtotime($item->latest_updated)) ?></td>
                                                            <td><a href="<?= url('items/move_to_clearance/' . $item->item_id) ?>" class="btn btn-primary col-md-10 waves-effect" style="width: 160px">Move To Clearance</a></td>
                                                            <td><a href="<?= url('items/delete/' . $item->item_id) ?>" class="btn btn-primary col-md-10 waves-effect red" style="width: 160px" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a></td>



                                                        </tr><?php
                                                    }
                                                }
                                                ?>


                                            </tbody>
                                        </table>
                                    </div>

                                    <h3>Clearance Stock</h3>
                                    <div class="table-responsive">
                                        <table ui-jp="dataTable"  class="table table-striped b-t b-b">
                                            <thead>
                                                <tr>
                                                    <th>Category Name</th>
                                                    <th>Item Name</th>
                                                    <th>Additional Description</th>
                                                    <th>Size</th>
                                                    <th>Colour</th>
                                                    <th>Barcode Number</th>
                                                    <th>Total Number of Items</th>
                                                    <th>Latest update date</th> 

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($items_c)) {
                                                    foreach ($items_c as $itemc) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $itemc->category_name ?></td>
                                                            <td><?= $itemc->item_name ?></td>
                                                            <td><?= $itemc->item_desc ?></td>
                                                            <td><?= $itemc->size ?> </td>
                                                            <td><?= $itemc->color ?> </td>
                                                            <td><?= $itemc->barcode_number ?></td>
                                                            <td><?= $itemc->clearance_stock ?></td>
                                                            <td><?= date('d-m-Y', strtotime($itemc->latest_updated)) ?></td>
                                                        </tr><?php
                                                    }
                                                }
                                                ?>


                                            </tbody>
                                        </table>
                                    </div>




                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<!-- / content -->



@stop