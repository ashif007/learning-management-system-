<?php partial('admin/header',['title'=>$req->title])?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= $req->title?>
        <small>Added At: <?= $req->created_at?></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/requests"><i class="fa fa-inbox"></i>Requests</a></li>
        <li><a href="/requests/<?=$req->id?>"><i class="fa fa-inbox"></i><?=$req->title?></a></li>
    </ol>
</section>
<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title"><?= $req->title?></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                    <i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <?= $req->body?>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            Last update: <?= $req->updated_at?>
        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.row -->
</section>
<?php partial('admin/footer')?>

