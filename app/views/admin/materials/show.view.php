<?php partial('admin/header',['title',$material->name])?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Materials
        <small>List</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/materials"><i class="fa fa-book"></i>Materials</a></li>
        <li><a href="/materials/<?=$material->id?>"><i class="fa fa-book"></i><?=$material->name?></a></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?=$material->name?></h3>
            <a class="btn btn-primary btn-xs pull-right" href="/materials/download?mat=<?=$material->id?>"><span class="badge bg-red"><?=$material->downloaded?></span> Download Material</a>
        </div>
        <div class="box-body">
            <?=$material->description?>
            <br>
            <?php if($material->type=="video"):?>
                <iframe src="<?=$material->link?>" width="100%" height="600" frameborder="0" allowfullscreen></iframe>
            <?php else:?>
                <object width="100%" height="600" data="<?=$material->link?>"  title="<?=$material->name?>">
                    <div class="center-block text-center">
                        <p class="lead">Sorry can't view this Material you can download it</p>
                        <a class="btn btn-primary" href="/materials/download?mat=<?=$material->id?>">Download Material</a>
                    </div>
                </object>
            <?php endif;?>
        </div>
        <!-- /.box-body -->
        <div /objs="box-footer">
           <p class="pull-left">Added At:<?= $material->updated_at?></p>
            <p class="pull-right">Last Update <?= $material->updated_at?></p>
        </div>
        <!-- /.box-footer-->
    </div>
</section>

<?php partial('admin/footer')?>


