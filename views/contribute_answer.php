<?php
	session_start();
	include '../system/conn.php';
	if(isset($_GET['qid'])){
		$id=$_GET['qid'];
		$search_query=$_GET['query'];
	}
	if(isset($_POST['submit_answer'])){
		$id=$_POST['id'];
		$author_id=$_POST['author_id'];
		$answer=$_POST['answer'];
		$references=$_POST['references'];

		$idkeyspace='1234567890';
		$length=3;
		$idstr=array();
		$max=strlen($idkeyspace)-1;
		for ($i=0; $i<$length ; ++$i) { 
			$n=rand(0,$max);
			$idstr[]=$idkeyspace[$n];
		}

		$aid=implode($idstr);
		$sql="INSERT INTO answers_tbl 
		(AnswerID, QuestionID, AuthorID, Upvote, DownVote, Subject, Topic, Level, AcessLevel, ReferenceList, Timestamp, Answer) VALUES 
		('".$aid."','".$id."','1','1','1','1','1','1','1','".$references."','1','".$answer."')";
		$conn->query($sql);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ENLIGHTEN KENYA</title>
	<link href="../assets/dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../assets/dist/css/flat-ui.css">
</head>
<style type="text/css">
	.output{
		padding: 10px;
		margin: 10px;
	}
	.wrapper{
		top:50px;
		position: relative;
	}
</style>
<body>
	<div>
		<nav class="navbar navbar-default" role="navigation">
		  <div class="navbar-header">
		    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
		      <span class="sr-only">Menu</span>
		    </button>
		    <a class="navbar-brand" href="../">ENLIGHTEN</a>
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
	<div class="col-md-offset-3 col-md-6">
		<form id="search" action="../index.php" method="POST">
			<div class="input-group">
			  	<input type="text" class="form-control" placeholder="Search" name="search_box" id="search-query-3">
			  	<span class="input-group-btn">
			    	<button type="submit" name="search" class="btn"><span class="fui-search"></span></button>
			  	</span>
			</div>
		</form>
	</div>

	<div class="wrapper">
		<div class="container">
			<div class="col-md-12">
				<form action="contribute_answer.php" method="POST">
					<input type="text" name="id" value="<?php echo $id ?>" class="form-control"><br>
					<input type="text" placeholder="Author ID" name="author_id" class="form-control"><br>
					<textarea name="answer" placeholder="Answer" class="form-control"></textarea><br>
					<textarea name="references" placeholder="References" class="form-control"></textarea><br>
					<button name="submit_answer" class="btn btn-primary">Submit</button>
				</form>
			</div>
		</div>
	</div>

	<!--Add scripts-->
	<script type="text/javascript" src="../assets/dist/js/vendor/jquery.min.js"></script>
	<script type="text/javascript" src="../	assets/dist/js/flat-ui.js"></script>
</body>
</html>