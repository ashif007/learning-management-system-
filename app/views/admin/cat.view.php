<?php partial('admin/header')?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Heading
        <small>description</small>
    </h1>
    breadcrumb
</section>
<!-- Main content -->
<section class="content">
    <h1>Hello</h1>
    <?php foreach ($cats as $cat):?>
        <?=$cat->name?>
    <?php endforeach;?>

</section>
<!-- /.content -->
<?php partial('admin/footer')?>


