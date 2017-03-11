<?php partial('admin/header')?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= $cat->name?>

    </h1>
    <ol class="breadcrumb">
        <li><a href="/cats/create"><i class="fa fa-book"></i> Categories</a></li>
        <li><a href="/courses/<?=$course->id?>"><?=$course->title?></a></li>
    </ol>
    <!-- Main content -->
    <section class="content">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#info" data-toggle="tab" aria-expanded="true"> Category</a></li>
                <li class=""><a href="#materials" data-toggle="tab" aria-expanded="false">Courses</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="info">
                    <div class="center-block">
                        <p class="text-center">Category Name:  <?= $cat->name?> </p>
                        <hr>
                    </div>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="materials">
                    <!-- The timeline -->
                    <ul class="timeline timeline-inverse">
                        <!-- timeline time label -->
                        <li class="time-label">
                            <span class="bg-red">Courses</span>
                        </li>
                        <?php foreach (array_chunk($courses,4) as $coursechunk):?>
                            <?php foreach ($coursechunk as $course):?>
                                <div class="col-md-3 col-sm-2">
                                    <?php partial('admin/course',['course'=>$course])?>
                                </div>
                            <?php endforeach;?>
                        <?php endforeach;?>
                        <!-- END timeline item -->
                    </ul>
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>
    </section>
<!-- /.row -->
<?php partial('admin/footer')?>

