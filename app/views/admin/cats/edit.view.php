<?php partial('admin/header')?>
<?php
$request=\App\Core\Session::get('request');
$errors=$request['errors'];
$fields=$request['fields'];
//dispalyForDebug($cat);
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Categories
            <small>description</small>
        </h1>
        breadcrumb
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="modal-dialog" style="width:60%">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Category</h4>
                </div>
                <?php start_form('put',"/cats/$cats->id",['enctype'=>"multipart/form-data"])?>
                <div class="box box-solid">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="box-group" id="accordion">
                            <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                            <div class="panel box box-primary">
                                <div class="box-header with-border">

                                </div>
                                <div id="basicinfo" class="panel-collapse collapse in">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="title">title</label>
                                            <input type="text" name="title" value="<?php echo $cats->name; ?>" class="form-control">
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(count($errors)>0):?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php foreach ($errors as $field=>$error):?>
                                        <li><strong><?= $field.' ' ?></strong><?= ' '.$error[0] ?></li>
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
            </div>
        </div>
    </section>
    <!-- /.content -->

<?php partial('admin/footer')?>
    <script src="<?php echo views_dir(); ?>admin/cats/cats.js" type="text/javascript" ></script>
<?php if(count($errors)>0):?>
    <script>
        console.log(jquery);
        document.getElementById('add').click();
    </script>
    <?php \App\Core\Session::delete('request');
endif;
?>