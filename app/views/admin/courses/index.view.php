<?php partial('admin/header')?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Courses
        <small>List</small>
    </h1>
    breadcrumb
</section>
<!-- Main content -->
<section class="content">
    <?php foreach (array_chunk($courses,4) as $coursechunk):?>
        <?php foreach ($coursechunk as $course):?>
            <div class="col-md-3 col-sm-2">
                <?php partial('admin/course',['course'=>$course])?>
            </div>
        <?php endforeach;?>
    <?php endforeach;?>
</section>

<?php partial('admin/footer')?>


