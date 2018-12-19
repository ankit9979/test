
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

                                <div class="subinner_nav panel-heading bg-white">
                                    <div class="bs-example">
                                        <ul class="nav nav-tabs two_tabs">
                                            <li class="active"> <a href="<?= url('') ?>/home/employee_timesheet_one">Individual Employee Summary</a></li>
                                            <li ><a href="<?= url('') ?>/home/employee_timesheet_all">All employees Summary</a></li>

                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">



                                    <h3>Employee office hours </h3>
                                    {!! Form::open(array('url' => 'home/employee_timesheet_one','class'=>'form')) !!}


                                    <div class="col-md-12 " style="border: 1px solid;padding: 10px 10px">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label >Select Employee</label>
                                                <select class="select2 form-control" name="employee_id"  required >
                                                    <option value="">Select Employee</option>

                                                    <?php
                                                    if (!empty($empolyees)) {
                                                        foreach ($empolyees as $empolyee) {
                                                            ?>
                                                            <option value="<?= $empolyee->id ?>" <?= (isset($id) && $id == $empolyee->id ? "selected" : "") ?>><?= $empolyee->name . " " . $empolyee->surname ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>

                                                </select>
                                            </div>  </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label >Start Date</label>
                                                <input type="text"  class="form-control dpd1  "   name="date1">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label >End Date </label>
                                                <input type="text"  class="form-control dpd2  "   name="date2">
                                            </div>

                                        </div>
                                        <div class="col-md-3">
                                            <input  type="submit" class="md-btn md-raised  indigo  p-h-md " style="margin-top: 25px" name="history" value="Submit">

                                        </div>






                                    </div>

                                    {!! Form::close() !!}
                                    <div class="clearfix"></div>

                                    <div class="table-responsive">



                                        {!! Form::open(array('url' => 'home/employee_timesheet_delete','class'=>'form')) !!}
                                        <table class="table table-striped b-t b-b dataTable no-footer">
                                            <thead>
                                                <tr><th>  Date</th><th>Time in</th><th>Time out  </th><th>Duration  </th> <th>Delete Entry</th></tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($history)) {
                                                    $time_t = 0;
                                                    foreach ($history as $ci) {
                                                        ?>
                                                        <tr> 
                                                            <td><?= $ci->date ?></td>
                                                            <td><?= $ci->time_in ?></td>
                                                            <td><?= $ci->time_out ?></td>
                                                            <td><?= $ci->duration ?></td>
                                                            <td> 
                                                                <label class="md-check">
                                                                    <input type="checkbox" name="delete[]" value="<?= $ci->time_id ?>"><i class="indigo"></i> 
                                                                </label></td>
                                                        </tr>
                                                        <?php
                                                        $time = explode(':', $ci->duration);
                                                        if (count($time) > 1) {
                                                            $time_t += $time[0] * 3600 + $time[1] * 60;
                                                        } else {
                                                            $time_t += $time[0] * 3600;
                                                        }
                                                    }
                                                    ?>
                                                    <tr><td >Total days worked</td><td colspan="4"><?= count($history) ?></td></tr>
                                                    <tr><td >Total hours</td><td colspan="4">


                                                            <?php
                                                            $h1 = floor($time_t / 3600);
                                                            $m1 = strval(floor(($time_t % 3600) / 60));
                                                            if ($m1 == 0) {
                                                                $m1 = "00";
                                                            } else {
                                                                $m1 = $m1;
                                                            }
                                                            echo $h1 . ":" . $m1;
                                                            ?>
                                                        </td></tr>
                                                    <tr><td >Total leave days accumulated</td><td colspan="4"><?= count($history) / 17 ?></td></tr>
                                                    <?php
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                        <?php if (!empty($history)) { ?>
                                            <input  type="submit" class="md-btn md-raised  indigo  p-h-md  " style="margin-top: 25px;" name="delete_history" value="Delete">
                                        <?php } ?>
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
</div>
<!-- / content -->



@stop