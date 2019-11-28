<?php
	session_start();
//    include "install.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>ENLIGHTEN KENYA</title>
	<link href="assets/dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="assets/dist/css/flat-ui.css">
</head>
<body>
	<div>
		<nav class="navbar navbar-default" role="navigation">
		  <div class="navbar-header">
		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
		      <span class="sr-only">Menu</span>
		    </button>
		    <a class="navbar-brand" href="#">ENLIGHTEN</a>
		  </div>
		  <div class="collapse navbar-collapse" id="navbar-collapse-01">
		    <ul class="nav navbar-nav navbar-right">
		      <li class="active"><a href="">Home</a></li>
		      <li><a href="#login">Login</a></li>
		      <li><a href="#register">Register</a></li>
		    </ul>
		  </div><!-- /.navbar-collapse -->
		</nav><!-- /navbar -->
	</div>
	<div style="margin-top:10%;" class="col-md-offset-3 col-md-6">
		<form id="search" action="index.php" method="POST">
			<div class="input-group">
			  	<input type="text" class="form-control" placeholder="Search" name="search_box" id="search-query-3">
			  	<span class="input-group-btn">
			    	<button type="submit" name="search" class="btn"><span class="fui-search"></span></button>
			  	</span>
			</div>
		</form>
	</div>

	<div class="row" style="bottom: 100px;position:absolute;">
		<div class="container" style="padding: 30px;">
			<h4>News</h4>
			<div id="news"></div>
		</div>
	</div>

	<!--Add scripts-->
	<script type="text/javascript" src="assets/dist/js/vendor/jquery.min.js"></script>
	<script type="text/javascript" src="assets/dist/js/flat-ui.js"></script>
</body>
</html>

<?php
	if(isset($_POST['search']) && isset($_POST['search_box'])){
		$searchq=trim($_POST['search_box']);
		$searchq=stripcslashes($searchq);
		header('location:search/?search_query='.$searchq);
	}
?>