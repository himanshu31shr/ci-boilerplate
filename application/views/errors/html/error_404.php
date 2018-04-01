<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="CoreUI Bootstrap 4 Admin Template">
	<meta name="author" content="Lukasz Holeczek">
	<meta name="keyword" content="CoreUI Bootstrap 4 Admin Template">

	<title><?php echo $heading; ?></title>

	<link href="/node_modules/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
  	<link href="/node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	  <link href="/node_modules/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
	  <link href="/node_modules/toastr/build/toastr.min.css" rel="stylesheet">

	  <!-- Main styles for this application -->
	  <link href="/public/backend/css/style.css" rel="stylesheet">
	  <link href="/public/backend/css/custom.css" rel="stylesheet">
	  <!-- Styles required by this views -->

	<link href="css/style.css" rel="stylesheet">
</head>
<body class="app flex-row align-items-center">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="clearfix">
					<h1 class="float-left display-3 mr-4"><?php echo $heading; ?></h1>
					<h4 class="pt-3">Oops! You're lost.</h4>
					<p class="text-muted"><?php echo $message; ?></p>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="/node_modules/jquery/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.min.js"></script>
  <script src="/node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="/node_modules/pace-progress/pace.min.js"></script>
  <script src="/node_modules/toastr/build/toastr.min.js"></script>

  <!-- Plugins and scripts required by all views -->
  <script src="/node_modules/chart.js/dist/Chart.min.js"></script>

  <!-- CoreUI main scripts -->
  <script src="/public/backend/js/global.js"></script>
  <script src="/public/backend/js/app.js"></script>

  <!-- Plugins and scripts required by this views -->
  <!-- Custom scripts required by this view -->
  <script src="/public/backend//public/backend/js/views/main.js"></script>

</body>
</html>