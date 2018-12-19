
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
                                    LOAD STOCK
                                </div>
                                <div class="panel-body">
                                    {!! Form::open(array('url' => 'items/update_stocks','class'=>'form')) !!}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">CATEGORIES</label>
                                            <select class="select2 form-control" name="item_category_id" >
                                                <option value=" ">Select Category</option>
                                                <?php
                                                if (!empty($categories)) {
                                                    foreach ($categories as $category) {
                                                        ?>
                                                        <option value="<?= $category->category_id ?>" <?= ($item->item_category_id == $category->category_id) ? "selected" : ""; ?>  ><?= $category->category_name ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label >ITEM NAME</label>
                                            <input type="text" class="form-control" name="item_name" required value="<?= $item->item_name ?>"  >
                                        </div>
                                        <input type="hidden" value="<?= $item->item_id ?>" name="item_id">
                                        <div class="form-group">
                                            <label >SIZE</label>
                                            <input type="text" class="form-control " name="size" required value="<?= $item->size ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label >COLOUR</label>
                                            <input type="text" class="form-control " name="color" required value="<?= $item->color ?>" >
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label >ADDITIONAL DESCRIPTION</label>
                                            <input type="text" class="form-control "  name="item_desc" required value="<?= $item->item_desc ?>">
                                        </div>
                                        <div class="form-group">
                                            <label >BARCODE NUMBER</label>
                                            <input type="text" class="form-control " name="barcode_number" required value="<?= $item->barcode_number ?>" >
                                        </div>
                                        <div class="form-group">
                                            <label >Price</label>
                                            <input type="text" class="form-control " name="price" required value="<?= $item->price ?>" >
                                        </div>



                                    </div>


                                    <div class="col-md-12 green-50 padding">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label >CURRENT NUMBER OF ITEMS</label>
                                                <input type="text" class="form-control " readonly required name="current_items_no" id="current_items_no" value="<?= $item->current_items_no ?>">
                                            </div>

                                            <div class="form-group">
                                                <label >TOTAL ITEMS</label>
                                                <input type="text" class="form-control " name="total_items" id="total_items">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label >NEW ITEMS</label>
                                                <input type="text" class="form-control " required name="new_item_number"  id="new_item_number">
                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <input  type="submit" class="md-btn md-raised indigo col-md-3  p-h-md" value="Submit">


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