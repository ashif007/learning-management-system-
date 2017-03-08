<?php partial('admin/header')?>
<?php
$request=\App\Core\Session::get('request');
$error=$request['errors'];
$fields=$request['fields'];
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Users
        <small>description</small>
    </h1>
    breadcrumb
</section>
<!-- Main content -->
<section class="content">


    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">All Users</h3>
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#AddUser">
                Add new
            </button>
        </div>
        <div class="box-body">
            <table id="indextable" class="table table-bordered table-striped">
                <thead>
                <tr>

                    <th>Name</th>
                    <th>Edit</th>
                    <th>View</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($cats as $cat):?>
                <tr>
                    <td><?= $cat->name?></td>
                    <td><a href="/cats/<?=$cat->id?>/edit"><span class="fa fa-edit"></span></a></td>
                    <td><a href="/cats/<?=$cat->id?>"><span class="fa fa-book"></span></a></td>
                    <td>
                        <?php start_form('delete',"/cats/$cat->id")?>
                        <button type="submit" style="border: none;background-color: rgba(0,0,0,0); color:#9f191f">
                            <span class="fa fa-remove"></span>
                        </button>
                        <?php close_form()?>
                    </td>
                </tr>
                <?php endforeach?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>View</th>
                    <th>Delete</th>
                </tr>
                </tfoot>
            </table>
        </div>

        <div class="box-footer">
        </div>
    </div>
    <div class="modal fade" id="AddUser" tabindex="-1" role="dialog" aria-labelledby="Add New User" aria-hidden="true" >
        <div class="modal-dialog" style="width:60%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Add New Category</h4>
                </div>
                <?php start_form('post',"/cats")?>
                <div class="box box-solid">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="box-group" id="accordion">
                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                            <div class="panel box box-primary">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#basicinfo">
                                            Basic Info
                                        </a>
                                    </h4>
                                </div>
                                <div id="basicinfo" class="panel-collapse collapse in">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>
                        <?php if(count($errors)>0):?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $filed=>$error):?>
                                <li><strong><?= $field?></strong><?= $error?></li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                        <?php endif;?>
                    </div>
                    <!-- /.box-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>

                </div>
                <?php close_form()?>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>

</section>
<!-- /.content -->
<?php partial('admin/footer')?>

