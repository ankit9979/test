
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
                                    EDIT NOTIFICATION
                                </div>
                                <div class="panel-body">
                                    {!! Form::open(array('url' => 'home/notification_update','class'=>'form')) !!}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label >Select User</label>
                                            <select class="select2 form-control"  name="user_id" required="">
                                                <option value="">Select User</option>
                                                <?php
                                                if (!empty($users)) {
                                                    foreach ($users as $user) {
                                                        ?>
                                                        <option value="<?= $user->id ?>" <?= ($notification->user_id == $user->id) ? "selected" : "" ?>><?= $user->name . " " . $user->surname ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <input type="hidden" value="<?= $notification->notification_id ?>" name="notification_id">
                                        <div class="form-group">
                                            <label >Notification</label>
                                            <input type="text" class="form-control" required value="<?= $notification->notification_name ?>"  name="notification_name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date of Post</label>
                                            <input type="text" class="form-control dpd1" required value="<?= $notification->date_of_post ?>" name="date_of_post" >
                                        </div>
                                        <div class="form-group">
                                            <label >Due date of Notification</label>
                                            <input type="text" class="form-control dpd2" value="<?= $notification->due_date_of_noty ?>" required name="due_date_of_noty"  >
                                        </div>
                                        <input  type="submit" class="md-btn md-raised  col-md-3 indigo  p-h-md" value="Submit">

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