<html>
<head>
	<title>Upload Form</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<br>	
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-lg-offset-3">
				<?php if ($this->session->userdata('email') != '') { ?>
				<?php foreach ($images as $image) { ?>

					<form method="post" action="<?php echo base_url()?>download/<?php echo $this->security->get_csrf_hash();?>">
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
						<input type="hidden" name="product_id" value="<?php echo $image->id ?>">
						<input type="hidden" name="	expiry_date" value="<?php echo $image->expiry_date ?>">
						<input type="hidden" name="user_id" value="<?php echo $this->session->userdata('id') ?>">
						<input type="submit" name="submit" value="Download" class="btn btn-info btn-sm">
					</form> 
			<?php } ?>
			<?php } ?>
				<a href="<?php echo base_url('home')?>" class="btn-success btn btn-sm">Upload another one</a> 
			</div>
		</div>
	</div>
</body>
</html>