<?php partial('admin/header')?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Request
        <small>List</small>
    </h1>
    breadcrumb
</section>
<!-- Main content -->
<section class="content">
    <?php foreach ($reqs as $req):?>
        <?php partial('admin/request',['req'=>$req])?>
    <?php endforeach;?>
</section>

<?php partial('admin/footer')?>

