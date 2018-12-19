
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
                                    Business Expenses
                                </div>
                                <div class="panel-body">
                                    {!! Form::open(array('url' => 'finanace/business_expance','class'=>'form')) !!}
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label >Start Date</label>
                                            <input type="text" class="form-control dpd1" required  name="start_date">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="text" class="form-control dpd2 " required name="end_date" >
                                        </div>



                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Expense</label>
                                            <input type="text" class="form-control  " required name="expenses_name" >
                                        </div>
                                        <input  type="submit" class="md-btn md-raised  col-md-3 indigo  p-h-md" value="Submit">


                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="text" class="form-control  " required name="amount" >
                                        </div>



                                    </div>


                                    {!! Form::close() !!}

                                </div>
                                <div class="panel-body">


                                    {!! Form::open(array('url' => 'finanace/business_expance_remove','class'=>'')) !!}

                                    <div class="table-responsive">
                                        <table ui-jp="dataTable"  class="table table-striped b-t b-b">
                                            <thead>
                                                <tr>
                                                    <th  style="width:20%">Start Date</th>
                                                    <th  style="width:20%">End Date</th>
                                                    <th  style="width:20%">Expense</th>
                                                    <th  style="width:20%">Amount</th>
                                                    <th  style="width:20%">Remove</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($expenses)) {
                                                    foreach ($expenses as $expense) {
                                                        ?>
                                                        <tr>
                                                            <td><?= $expense->start_date ?></td>
                                                            <td><?= $expense->end_date ?></td>
                                                            <td><?= $expense->expenses_name ?></td>
                                                            <td>R <?= number_format($expense->amount,2) ?></td>

                                                            <td><label class="md-check">
                                                                    <input type="checkbox" name="delete[]" value="<?= $expense->expenses_id ?>" ><i class="indigo"></i> 
                                                                </label></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <input  type="submit" class="md-btn md-raised  col-md-3 red  p-h-md" value="Remove">
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