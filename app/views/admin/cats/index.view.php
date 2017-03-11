<?php partial('admin/header')?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
          Category
        <small>List</small>
    </h1>
    breadcrumb
</section>
<!-- Main content -->
<section class="content">
    <?php foreach (array_chunk($cats,4) as $catschunk):?>
        <?php foreach ($catschunk as $cats):?>
            <div class="col-md-3 col-sm-2">
                <?php partial('admin/category',['cats'=>$cats])?>
            </div>
        <?php endforeach;?>
    <?php endforeach;?>
</section>

<?php partial('admin/footer')?>


