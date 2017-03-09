<div class="container-fluid">

<div class="row">
	<form class="form-horizontal col-sm-offset-2 col-md-offset-1 col-sm-8"  action="/request/send" method="post">
  		<div class="form-group">
		    <label for="title">Title</label>
		    <input type="text" class="form-control" name="title" id="title" placeholder="Title ">
		</div>
		<div class="form-group">
		    <label for="description">You Request</label>
		    <textarea  type="text" class="form-control" name="description" id="description" placeholder="Your request"> </textarea>
		</div>
		<input type="submit" class="btn btn-primary" value="Request" name="request" />
	</form>
</div>


</div>