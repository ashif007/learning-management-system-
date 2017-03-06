<?php partial('admin/header')?>
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
    <?php foreach (array_chunk($users,4) as $userchunk):?>
        <?php foreach ($userchunk as $user):?>
            <div class="col-md-3 col-sm-2">
                <?php partial('admin/user',['user'=>$user])?>
            </div>
        <?php endforeach;?>
    <?php endforeach;?>
</section>

<?php partial('admin/footer')?>

