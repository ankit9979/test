
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
                                    ADD CATEGORY
                                </div>
                                <div class="panel-body">
                                    {!! Form::open(array('url' => 'items/category_update','class'=>'form')) !!}
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label >Category Name</label>
                                            <input type="text" name="category_name" value="<?= $category->category_name ?>" required class="form-control"  >
                                            <input type="hidden" name="category_id" value="<?= $category->category_id ?>">
                                        </div>
                                        <input type="submit"  class="md-btn md-raised green  col-md-2 waves-effect p-h-md"   value="Save">

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