
 <div class="container-fluid">
 <section class="content-header">
    <h1>
        Requests
        <small>users</small>
    </h1>
     <small>breadcrumb code is here but implement the semantic</small>
<!--    <div class="ui breadcrumb">
    <a class="section">Request</a>
    <div class="divider"> / </div>
    <a class="section">Admin</a>
    <div class="divider"> / </div>
    <div class="active section">AllRequests</div>
  </div>-->
</section>
<!-- Main content -->
<section class="content">
    <?php foreach (array_chunk($user_requests,4) as $requests):?>
        <?php foreach ($requests as $userrequest): ?>
            <div class=" col-sm-offset-1 col-md-5 col-sm-10">
                <div class="panel panel-default">
                    <div class="panel-heading"><?=$userrequest->title ?></div>
                    <div class="panel-body">
                        <h4 class="left"><?=$userrequest->userid ?> has asked for : </h4>
                        <?=$userrequest->description?></div>
                </div>
            </div>
        <?php endforeach;?>
    <?php endforeach;?>
</section>
</div>