
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
                                    NEW ITEMS
                                </div>
                                <div class="panel-body">
                                    {!! Form::open(array('url' => 'items/new_item','class'=>'form')) !!}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">CATEGORIES</label>
                                            <select class="select2 form-control" name="item_category_id" required >
                                                <option value="">Select Category</option>
                                                <?php
                                                if (!empty($categories)) {
                                                    foreach ($categories as $category) {
                                                        ?>
                                                        <option value="<?= $category->category_id ?>"><?= $category->category_name ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">ITEM NAME</label>
                                            <input type="text" class="form-control" name="item_name" required >
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">SIZE</label>
                                            <input type="text" class="form-control " name="size" required >
                                        </div>


                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">ADDITIONAL DESCRIPTION</label>
                                            <input type="text" class="form-control " name="item_desc"  required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">BARCODE NUMBER</label>
                                            <input type="text" class="form-control " name="barcode_number"  value="<?= $unique_number ?>" required >
                                        </div>
                                        <div class="form-group">
                                            <label >Price</label>
                                            <input type="text" class="form-control " name="price" id="item_price" required >
                                        </div>


                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Colour </label>
                                            <input type="text" class="form-control " name="color"  required>
                                        </div>



                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Commission Percentage</label>
                                            <input type="text" class="form-control" name="commission_percentage" id="commission_percentage" required >
                                        </div>


                                    </div>   <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Commission Amount</label>
                                            <input type="text" class="form-control " name="commission_amount" id="commission_amount" required >
                                        </div>   </div>
                                    <div class="col-md-12 green-50 padding">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">CURRENT NUMBER OF ITEMS</label>
                                                <input type="text" class="form-control " name="current_items_no" required >
                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">CRITICAL MINIMUM ITEM NUMBER </label>
                                                <input type="text" class="form-control " name="critical_items_no" required >
                                            </div>

                                        </div>

                                        <div class="col-md-12" style="text-align: center">

                                            <input  type="submit" class="md-btn md-raised indigo col-md-3  p-h-md" style="float: none" value="Submit">


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