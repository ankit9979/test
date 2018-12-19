
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
                                            <li> <a href="<?= url('') ?>/home/employee_timesheet_one">Individual Employee Summary</a></li>
                                            <li  class="active"><a href="<?= url('') ?>/home/employee_timesheet_all">All employees Summary</a></li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body">



                                    <h3>Employee office hours (Summary)</h3>

                                    <div class="table-responsive">


                                        {!! Form::open(array('url' => 'home/employee_timesheet_all','class'=>'form')) !!}
                                        <div class="col-md-12 " style="border: 1px solid;padding: 10px 10px">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label >Start Date</label>
                                                    <input type="text"  class="form-control dpd1 required"   name="date1">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label >End Date </label>
                                                    <input type="text"  class="form-control dpd2 required"   name="date2">
                                                </div>

                                            </div>
                                            <div class="col-md-4">
                                                <input  type="submit" class="md-btn md-raised  indigo  p-h-md " style="margin-top: 25px" name="history" value="Submit">

                                            </div>






                                        </div>
                                        {!! Form::close() !!}

                                        <table class="table table-striped b-t b-b dataTable no-footer">
                                            <thead>
                                                <tr><th>  Employee Name</th><th>Total Hours worked</th><th>Total Days Worked </th><th>Accumulated Leave days  </th> </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($get_all_emps)) {
                                                    $time_t = 0;
                                                    foreach ($get_all_emps as $ci) {
                                                        ?>
                                                        <tr> 
                                                            <td><?= $ci->name . $ci->surname ?></td>
                                                            <td><?= $ci->total_hour ?></td>
                                                            <td><?= $ci->total_day ?></td>
                                                            <td><?= $ci->leave ?></td>

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