
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
                                    Update Cost and Sale Price (<?= $item->item_name ?>)
                                </div>
                                <div class="panel-body">
                                    {!! Form::open(array('url' => 'finanace/update_cost_sales','class'=>'form')) !!}
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label >Cost Price</label>
                                            <input type="text" name="cost_price" value="<?= $item->cost_price ?>" required class="form-control"  >
                                            <input type="hidden" name="item_id" value="<?= $item->item_id ?>">
                                        </div>


                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label >Sale Price</label>
                                            <input type="text" name="price" value="<?= $item->price ?>" required class="form-control"  >
                                        </div>


                                    </div>
                                    <div class="col-md-6">
                                        <input type="submit"  class="md-btn md-raised green  col-md-2 waves-effect p-h-md"   value="Update"> </div>

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