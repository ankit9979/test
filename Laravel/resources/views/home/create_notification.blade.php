
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
                                    CREATE NOTIFICATION
                                </div>
                                <div class="panel-body">
                                    {!! Form::open(array('url' => 'home/create_notification','class'=>'form')) !!}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label >Select User</label>
                                            <select class="select2 form-control"  name="user_id" required="">
                                                <option value="">Select User</option>
                                                <?php
                                                if (!empty($users)) {
                                                    foreach ($users as $user) {
                                                        ?>
                                                        <option value="<?= $user->id ?>"><?= $user->name . " " . $user->surname ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label >Notification</label>
                                            <input type="text" class="form-control" required  name="notification_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date of Post</label>
                                            <input type="text" class="form-control dpd1" required name="date_of_post" >
                                        </div>
                                        <div class="form-group">
                                            <label >Due date of Notification</label>
                                            <input type="text" class="form-control dpd2" required name="due_date_of_noty"  >
                                        </div>
                                        <input  type="submit" class="md-btn md-raised  col-md-3 indigo  p-h-md" value="Submit">

                                    </div>
                                    {!! Form::close() !!}

                                </div>
                                <div class="panel-body">



                                    <div class="table-responsive">
                                        <table ui-jp="dataTable"  class="table table-striped b-t b-b">
                                            <thead>
                                                <tr>
                                                    <th  style="width:20%">User</th>
                                                    <th  style="width:25%">NOTIFICATION</th>
                                                    <th  style="width:25%">Date of Post</th>
                                                    <th  style="width:25%">Due date of Notification</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                if (!empty($notifications)) {
                                                    foreach ($notifications as $notification) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $notification->name . " " . $notification->surname ?></td>
                                                            <td><?= $notification->notification_name ?></td>
                                                            <td><?= $notification->date_of_post ?> </td>
                                                            <td><?= $notification->due_date_of_noty ?></td>
                                                        </tr>
                                                        <?php
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