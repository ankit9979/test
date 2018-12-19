
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
                                {!! Form::open(array('url' => 'finanace/performance','class'=>'')) !!}
                                <div class="panel-heading bg-white">
                                    PERFORMANCE
                                </div>
                                <div class="panel-body">

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <input type="text" class="form-control dpd2" required   value="<?= isset($start_date) ? $start_date : "" ?>"  placeholder="Start Date" name="start_date">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <input type="text" class="form-control dpd1"  value="<?= isset($end_date) ? $end_date : "" ?>"  placeholder="End Date" required name="end_date" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">

                                            <input type="submit"  class="md-btn md-raised green   waves-effect p-h-md"   value="Check">
                                        </div>
                                    </div>




                                </div>

                                <div class="panel-body">


                                    <?php
                                    if (!empty($get_all_pck_infos)) {
                                        ?>

                                        <div class="table-responsive">
                                            <table  class="table table-striped b-t b-b">
                                                <thead>
                                                    <tr>
                                                        <th >Item Name</th>
                                                        <th >Additional Description</th>
                                                        <th >Size</th>
                                                        <th >Barcode Number</th>
                                                        <th >Date of Purchase</th>
                                                        <th >Total Items Sold</th>
                                                        <th >Cash Sales</th>
                                                        <th >Card Sales</th>
                                                        <th >Layby</th>
                                                        <th >Total Cash</th>
                                                        <th>Total Card</th>
                                                        <th>Sum Total </th>

                                                        <th>Unit Sales Price</th>
                                                        <th>Profit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    if (!empty($get_all_pck_infos)) {
                                                        foreach ($get_all_pck_infos as $info) {
                                                            ?>
                                                            <tr>
                                                                <td><?= $info['item_name'] ?></td>
                                                                <td><?= $info['item_desc'] ?></td>
                                                                <td><?= $info['size'] ?></td>
                                                                <td><?= $info['barcode_number'] ?></td>
                                                                <td><?= date('d-m-Y', $info['date_of_purchase']) ?></td>
                                                                <td><?= $info['total_itm'] ?></td>
                                                                <td><?= number_format($info['cash_sales'],2) ?></td>

                                                                <td><?= number_format($info['card_sales'],2) ?></td>
                                                                <td><?= $info['layby'] ?></td>

                                                                <td>R <?= number_format($info['cash_total'],2) ?></td>
                                                                <td>R <?= number_format($info['card_total'],2) ?></td>
                                                                <td>R <?= number_format($info['total'],2) ?></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>





                                                </tbody>
                                            </table>
                                        </div>




                                        <div class="table-responsive col-md-3">
                                            <table  class="table table-striped b-t b-b">
                                                <thead>
                                                    <tr>
                                                        <th  >Revenue Summary</th>
                                                    </tr>
                                                    <tr>
                                                        <th  >Total Float Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>

                                                        <td>R <?= $full_of_array['daily_cash_float'] ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="table-responsive col-md-3">
                                            <table  class="table table-striped b-t b-b">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2"  >Sales</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Cash</th>
                                                        <th>Card</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>R <?= $full_of_array['cash_amount'] ?></td>
                                                        <td>R <?= $full_of_array['card_amount'] ?></td>
                                                        <td>R <?= $full_of_array['cash_card_total'] ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="table-responsive col-md-3">
                                            <table  class="table table-striped b-t b-b">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2"  >Commission</th>
                                                    </tr>
                                                    <tr>

                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>

                                                        <td>R <?= $full_of_array['commision'] ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="table-responsive col-md-3">
                                            <table  class="table table-striped b-t b-b">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2"  >Total Revenue</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Float</th>

                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>R <?= $full_of_array['daily_cash_float'] ?></td>

                                                        <td>R <?= $full_of_array['result'] ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="table-responsive col-md-12">
                                            <table  class="table table-striped b-t b-b">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2"  >Costs Summary</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Item</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                      $ex_amount = 0;
                                                    if (!empty($expenses)) {
                                                      
                                                        foreach ($expenses as $expense) {
                                                            ?>

                                                            <tr>
                                                                <td><?= $expense->expenses_name ?></td>
                                                                <td><?= $expense->start_date ?></td>
                                                                <td><?= $expense->end_date ?></td>
                                                                <td>R <?= $expense->amount ?></td>
                                                            </tr><?php
                                                            $ex_amount+= $expense->amount;
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td colspan="3">Total</td>
                                                            <td>R <?= $ex_amount ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>


                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="table-responsive col-md-12">
                                            <table  class="table table-striped b-t b-b">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2"  >Conclusion</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Revenue</th>
                                                        <th>Total Expenses</th>
                                                        <th>Difference</th>

                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    <tr>
                                                        <td>R <?= $full_of_array['result'] ?></td>
                                                        <td>R <?= $ex_amount ?></td>
                                                        <td>R <?= $full_of_array['result'] - $ex_amount ?></td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-md-12">


                                            <input  type="submit" name="email_report" class="md-btn md-raised indigo col-md-2   p-h-md" value="Email Report">
                                            <input  type="submit" name="archive_report" class="md-btn md-raised indigo col-md-2 m-l-md p-h-md" value="Archive Report">

                                            <input  type="submit" name="print" class="md-btn md-raised indigo col-md-2 m-l-md p-h-md" value="Print Report">



                                        </div>

                                    <?php } ?>
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
<!-- / content -->



@stop