<?php partial('admin/header',['title','All Requests'])?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Request
        <small>List</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/requests"><i class="fa fa-inbox"></i>All Requests</a></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <?php foreach ($reqs as $req):?>
        <?php partial('admin/request',['req'=>$req])?>
    <?php endforeach;?>
</section>

<?php partial('admin/footer')?>

