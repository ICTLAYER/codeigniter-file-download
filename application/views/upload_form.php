
<html>
<head>
	<title>Upload Form</title>
	<!-- Latest compiled and minified CSS -->
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

			<?php  echo $this->session->userdata('email'); ?>
			<a href="<?php echo base_url()?>logout" class="btn btn-info btn-sm">Logout</a>
			<div class="col-lg-4 col-lg-offset-3">
				<?php echo $error;?>

				<?php echo form_open_multipart('upload/do_upload');?>

				<input type="file" class="form-control" name="userfile" size="20" / >
          
				<br /><br />

				<input type="submit" name="submit" class="btn btn-success btn-sm" value="Upload File" />

			</form>
			<a href="<?php echo base_url()?>show-image" class="btn btn-info btn-sm">Show Files</a>
		</div>
	</div>
</div>
</body>
</html>