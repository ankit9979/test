
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
                                    <div class="col-md-6">
                                        {!! Form::open(array('url' => 'items/category_add','class'=>'form')) !!}


                                        <div class="form-group">
                                            <label >Category Name</label>
                                            <input type="text" name="category_name" required class="form-control"  >
                                        </div>
                                        <input type="submit"  class="md-btn md-raised green  col-md-2 waves-effect p-h-md"   value="Save">



                                        {!! Form::close() !!}

                                    </div>
                                    <div class="col-md-6">

                                        <div class="table-responsive">
                                            <table ui-jp="dataTable"  class="table table-striped b-t b-b">
                                                <thead>
                                                    <tr>
                                                        <th>Category Name</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>  

                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                    if (!empty($categories)) {
                                                        foreach ($categories as $category) {
                                                            ?>
                                                            <tr>
                                                                <td><?= $category->category_name ?></td>
                                                                <td><a class="md-btn md-raised green" href="<?= url('items/category_edit/' . $category->category_id) ?>">Edit</a></td>
                                                                <td><a class="md-btn md-raised red" onclick="return confirm('Are you sure?')" href="<?= url('items/category_delete/' . $category->category_id) ?>">Delete</a>

                                                                </td>
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
</div>
<!-- / content -->



@stop