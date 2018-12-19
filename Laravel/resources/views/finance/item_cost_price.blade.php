
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
                                    Item Cost and Sales Price
                                </div>
                                <div class="panel-body">
                                    {!! Form::open(array('url' => 'finanace/item_cost_price','class'=>'form')) !!}
                                    <div class="table-responsive">
                                        <table ui-jp="dataTable"  class="table table-striped b-t b-b">
                                            <thead>
                                                <tr>
                                                    <th>Item Name</th>
                                                    <th>Additional Description</th>
                                                    <th>Size</th>
                                                      <th>Colour</th>
                                                    <th>Barcode Number</th>
                                                    <th>Total Number of Items</th>
                                                    <th>Latest date</th>
                                                    <th>Cost Price</th>
                                                    <th> Sale Price</th>



                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                if (!empty($items)) {
                                                    foreach ($items as $item) {
                                                        ?>
                                                        <tr>

                                                            <td><a href="<?= url('finanace/edit_cost_sales/' . $item->item_id) ?>" class="btn btn-primary col-md-10 waves-effect"><?= $item->item_name ?></a></td>
                                                            <td><?= $item->item_desc ?></td>
                                                            <td><?= $item->size ?></td>
                                                              <td><?= $item->color ?></td>
                                                            <td><?= $item->barcode_number ?></td>
                                                            <td><?= $item->current_items_no ?></td>
                                                            <td><?= date('d-m-Y', strtotime($item->latest_updated)) ?></td>
                                                            <td><?= $item->cost_price ?></td>
                                                            <td>R <?= number_format($item->price,2) ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>


                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-2">
                                        <input  type="submit" class="md-btn  md-raised green btn-block p-h-md" value="Download Sheet">


                                    </div>
                                    <!--                                    <div class="col-md-2">
                                    
                                                                            <input  type="submit" class="md-btn md-raised  yellow  p-h-md" value="Upload Sheet">
                                    
                                                                        </div>-->


                                    {!! Form::close() !!}

                                    <!--                                    <form role="form">
                                                                            <div class="form-group">
                                                                                <label for="exampleInputEmail1">Email address</label>
                                                                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleInputPassword1">Password</label>
                                                                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleInputFile">File input</label>
                                                                                <input type="file" id="exampleInputFile">
                                                                                <p class="help-block">Example block-level help text here.</p>
                                                                            </div>
                                                                            <div class="checkbox">
                                                                                <label>
                                                                                    <input type="checkbox"> Check me out
                                                                                </label>
                                                                            </div>
                                                                            <button type="submit" class="btn btn-default m-b">Submit</button>
                                                                        </form>-->
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