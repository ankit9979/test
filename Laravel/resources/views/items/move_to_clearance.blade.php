
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
                                    MOVE TO CLEARANCE
                                </div>
                                <div class="panel-body">
                                    {!! Form::open(array('url' => 'items/add_clearance_item','class'=>'form')) !!}
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">ITEM NAME</label>
                                            <input type="text" class="form-control" name="item_name" readonly value="<?= $item->item_name ?>"  >
                                        </div>
                                        <input type="hidden" value="<?= $item->item_id ?>" name="item_id">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">SIZE</label>
                                            <input type="text" class="form-control " name="size" readonly value="<?= $item->size ?>" >
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Colour </label>
                                            <input type="text" class="form-control " name="color" value="<?= $item->color ?>"   readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">ADDITIONAL DESCRIPTION</label>
                                            <input type="text" class="form-control " name="item_desc" readonly value="<?= $item->item_desc ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">BARCODE NUMBER</label>
                                            <input type="text" class="form-control " name="barcode_number" readonly  value="<?= $item->barcode_number ?>"  >
                                        </div>



                                    </div>


                                    <div class="col-md-12 green-50 padding">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">CURRENT STOCK ITEMS</label>
                                                <input type="text" class="form-control " name="current_items_no" id="current_items_no" readonly value="<?= $item->current_items_no ?>" >
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">CLEARANCE STOCK ITEMS</label>
                                                <input type="text" class="form-control " name="clearance_stock" id="clearance_stock" value="" required >
                                            </div>
                                            <input  type="submit" class="md-btn md-raised indigo col-md-3  p-h-md" value="Submit">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">REMAINING CURRENT STOCK ITEMS</label>
                                                <input type="text" class="form-control " name="remained_stock"  id="remained_stock" >
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">New Item Price</label>
                                                <input type="text" class="form-control "  name="item_price"   required>
                                            </div>
                                        </div>

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