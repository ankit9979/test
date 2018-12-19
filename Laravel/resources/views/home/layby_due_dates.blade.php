
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
                                    NOTIFICATIONS
                                </div>

                                <div class="panel-body">


                                    {!! Form::open(array('url' => 'home/layby_due_dates','class'=>'form')) !!}
                                    <div class="table-responsive">
                                        <table ui-jp="dataTable"  class="table table-striped b-t b-b">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Contact Number</th>
                                                    <th>Email Address</th>
                                                    <th>Item Name</th>
                                                    <th>Additional Description</th>
                                                    <th>Size</th>
                                                    <th>Barcode Number</th>
                                                    <th>Date of Layby</th>
                                                    <th>Total Cost</th>
                                                    <th>Payment Received</th>
                                                    <th>Payment Outstanding</th>
                                                    <th>Due date</th>
                                                    <th>Paid</th>
                                                    <th>Delete</th>


                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                if (!empty($notifications)) {
                                                    foreach ($notifications as $notification) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $notification->first_name ?></td>
                                                            <td><?= $notification->last_name ?></td>
                                                            <td><?= $notification->email_id ?></td>
                                                            <td><?= $notification->item_name ?></td>
                                                            <td><?= $notification->item_desc ?></td>
                                                            <td><?= $notification->size ?></td>
                                                            <td><?= $notification->barcode_number ?></td>

                                                            <td><?= $notification->intial_date ?></td>
                                                            <td>R <?= number_format($notification->total_price,2) ?></td>
                                                            <td>R <?= number_format($notification->amount_paid,2) ?></td>

                                                            <td>R <?= number_format($notification->remained_amount,2) ?></td>
                                                            <td><?= $notification->due_date_remain_payment ?></td>
                                                            <td> <label class="md-check">
                                                                    <input type="checkbox" name="item_paid[]" value="<?= $notification->sale_id ?>"><i class="indigo"></i> 
                                                                </label></td>
                                                            <td>
                                                                <label class="md-check">
                                                                    <input type="checkbox" name="item_delete[]" value="<?= $notification->sale_id ?>"><i class="indigo"></i> 
                                                                </label>
                                                            </td>




                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>


                                            </tbody>
                                        </table>
                                    </div>
                                    <input  type="submit" class="md-btn md-raised  col-md-2 indigo  p-h-md" value="Submit">


                                    {!! Form::close() !!}

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