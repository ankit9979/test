
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
                                    Time Clocking and Leave Accumilated
                                </div>
                                <div class="panel-body">
                                    {!! Form::open(array('url' => 'home/time','class'=>'form','id'=>'save_time')) !!}
                                    <div class="col-md-5 " style="border: 1px solid;padding: 10px 10px">
                                        <div class="form-group">
                                            <label >Clock In</label>
                                            <input type="text" value="" placeholder="<?= (isset($times)) ? $times->time_in : "" ?>" class="form-control time_add "  id=""  name="time_in">
                                        </div>
                                        <div class="form-group">
                                            <label >Clock Out</label>
                                            <input type="text" value=""  placeholder="<?= (isset($times)) ? $times->time_out : "" ?>" class="form-control  time_add"   name="time_out">
                                        </div>


<!--                                        <input  type="submit" class="md-btn md-raised  col-md-3 indigo  p-h-md" name="time_add" value="Submit">-->


                                    </div>
                                    {!! Form::close() !!}
                                    <div class="col-md-6 " style="border: 1px solid;padding: 10px 10px;margin-left: 5%">

                                        <div class="col-md-6 text-center">
                                            <h4>Current Date </h4>
                                            <h1 class="time"><?= date('d-m-Y') ?></h1>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <h4>Current Time</h4>
                                            <canvas class="CoolClock:swissRail:120"></canvas>
                                        </div>

                                    </div>


                                    <div class="clearfix"></div>
                                    <div class="table-responsive">
                                        <h3>Work History  </h3>
                                        {!! Form::open(array('url' => 'home/time','class'=>'form')) !!}
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