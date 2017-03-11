<?php partial('admin/header')?>
<?php
$request=\App\Core\Session::get('request');
$errors=$request['errors'];
$fields=$request['fields'];
\App\Core\Session::delete('request');
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

                    <li class="dropdown pull-right">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                            <i class="fa fa-gear"></i> Options <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#viewCourses" ><i class="fa fa-edit"></i>view Courses</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target="#AddCourses" ><i class="fa fa-plus"></i>Add Courses</a></li>
                        </ul>
                    </li>

                </div>


                
                <?php start_form('put',"/cats/$cats->id")?>
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
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </div>
                <?php close_form()?>
            </div>
        </div>


        <div  class="modal fade" id="AddCourses" tabindex="-1" role="dialog" aria-labelledby="Add Courses" aria-hidden="true" >
            <div class="modal-dialog" style="width:60%">
            <?php start_form('post',"/courses")?>
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
                                        <label for="title">Title</label>
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <textarea id="editor" name="desc" class="form-control"></textarea>

                                    </div>
                                    <div class="form-group">
                                        <label for="date">Start Date</label>
                                        <input type="date" name="start" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="date">End Date</label>
                                        <input type="date" name="end" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="cat">Category</label>
                                        <select name="cat" id="cat" class="form-control">
                                            <?php foreach ($cats as $cat):?>
                                                <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
                                            <?php endforeach?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="rank">Rate</label>
                                        <input type="number" id="rank" name="rank" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if(count($errors)>0):?>
                        <?php partial('admin/verrors',['errors'=>$errors]);?>
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



                <section class="content" id="viewCourses">
                    <?php foreach (array_chunk($courses,4) as $coursechunk):?>
                        <?php foreach ($coursechunk as $course):?>
                            <div class="col-md-3 col-sm-2">
                                <?php partial('admin/course',['course'=>$course])?>
                            </div>
                        <?php endforeach;?>
                    <?php endforeach;?>
                </section>


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