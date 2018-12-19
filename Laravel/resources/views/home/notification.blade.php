
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
                                    NOTIFICATION
                                </div>
                                <div class="panel-body">
                                    {!! Form::open(array('url' => 'home/notification','class'=>'form')) !!}
                                    <div class="table-responsive">
                                        <table ui-jp="dataTable"  class="table table-striped b-t b-b">
                                            <thead>
                                                <tr>
                                                    <th  style="width:20%">DATE</th>
                                                    <th  style="width:25%">NOTIFICATION</th>
                                                    <th  style="width:25%">SELECT</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                if (!empty($notifications)) {
                                                    foreach ($notifications as $notification) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $notification->due_date_of_noty ?></td>
                                                            <td><a href="<?= url('home/notification_edit') ?>/<?= $notification->notification_id ?>"><?= $notification->notification_name ?></td>
                                                            <td> <label class="md-check">
                                                                    <input type="checkbox" name="delete[]" value="<?= $notification->notification_id ?>"><i class="indigo"></i> 
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
                                    <div class="col-md-3">
                                        <a href="<?= url('home/create_notification') ?>"  class="md-btn  md-raised green btn-block p-h-md">Create a notification</a>

                                    </div>
                                    <?php
                                    if (!empty($notifications)) {
                                        ?>
                                        <div class="col-md-2">

                                            <input  type="submit" class="md-btn md-raised  red  p-h-md" value="Delete Notification">

                                        </div>
                                    <?php } ?>

                                    {!! Form::close() !!}


                                </div>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading bg-white">
                                    CRITICAL ITEMS LIST
                                </div>
                                <div class="panel-body">
                                    {!! Form::open(array('url' => 'home/critical_items_report','class'=>'form')) !!}
                                    <div class="table-responsive">
                                        <table   class="table table-striped b-t b-b">
                                            <thead>
                                                <tr>
                                                    <th  style="width:20%">Category</th>
                                                    <th  style="width:25%">Item</th>
                                                    <th  style="width:25%">Nr Of Unit Remaining </th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                if (!empty($final_data)) {
                                                    foreach ($final_data as $item) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $item->category_name ?></td>
                                                            <td><?= $item->item_name ?></td>
                                                            <td><?= $item->current_items_no ?></td>

                                                    <input type="hidden" name="item_id[]" value="<?= $item->item_id ?>">
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="col-md-1">

                                        <input  type="submit" name="save" class="md-btn md-raised  green  p-h-md" value="Email">

                                    </div>
                                    <div class="col-md-2">

                                        <input  type="submit" name="save" class="md-btn md-raised  green  p-h-md" value="Download">

                                    </div>


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