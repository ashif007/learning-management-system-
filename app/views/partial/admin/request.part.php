<div class="box box-widget">
    <div class="box-header with-border">
        <div class="user-block">
            <img class="img-circle" src="<?= $req->user()->image?>" alt="User Image">
            <span class="username"><a href="/users/<?= $req->user()->id?>"><?= $req->user()->username?></a></span>
            <span class="description"><?= $req->updated_at?></span>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <!-- post text -->
        <p><?= $req->body?></p>
        <span class="pull-right text-muted"><?=count($req->comments())?></span>
    </div>
    <!-- /.box-body -->
    <div class="box-footer box-comments">
        <?php foreach ($req->comments() as $comment):?>
        <div class="box-comment">
            <!-- User image -->
            <img class="img-circle img-sm" src="<?=$comment->user()->image?>" alt="User Image">

            <div class="comment-text">
                      <span class="username">
                        <?= $comment->user()->username?>
                        <span class="text-muted pull-right"><?= $comment->updated_at?></span>
                      </span><!-- /.username -->
               <?= $comment->body?>
            </div>
            <!-- /.comment-text -->
        </div>
        <!-- /.box-comment -->
        <?php endforeach;?>
    </div>
    <!-- /.box-footer -->
    <div class="box-footer">
        <?php start_form('post','/comments/')?>
        <form class="form-horizontal">
            <input type="hidden" name="uid" value="<?= \App\Core\Session::getLoginUser()->id?>">
            <input type="hidden" name="mid" value="Request">
            <input type="hidden" name="mname" value="<?= $req->id?>">
            <div class="form-group margin-bottom-none">
                <div class="col-sm-9">
                    <input class="form-control input-sm" placeholder="Comment" name="body">
                </div>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-danger pull-right btn-block btn-sm">Comment</button>
                </div>
            </div>
        </form>
        <?php close_form()?>
    </div>
    <!-- /.box-footer -->
</div>