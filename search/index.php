<?php
session_start();
// error_reporting(0);

$output=[];

include '../system/conn.php';

$error=false;

if(isset($_GET['search_query'])){
	
	$search_query=$_GET['search_query'];
	
	$query="SELECT * FROM question_tbl WHERE Question LIKE '%".$search_query."%'";
	
	$searchwiki=str_replace(" ", "+", $search_query);

    if(@$wiki=file_get_contents("http://en.wikipedia.org/w/api.php?action=query&list=search&srsearch=".$searchwiki."&format=json")){
        $wiki=json_decode($wiki);
    }
    else{
        $error=false;
    }
    if(@$archive=file_get_contents("https://archive.org/advancedsearch.php?q=".$searchwiki."~&description&title&source&output=json&rows=20")){
        $archive=json_decode($archive);
        $error=true;
    }else{
        $error=false;
    }
	
	if($res=$conn->query($query)){
		
		$count=$res->num_rows;
		
		if($count>1){
			
			$output.="<br>".$count." results found from local<hr>";
			
		}
		else{
			
			$output.="<br>".$count." result found from local<hr>";
			
		}
		
		$no=1;
		
		$start="";
		
		$end="";
		
		$ans=false;
		
		while ($row=$res->fetch_assoc()) {
			
			$query1="SELECT * FROM answers_tbl WHERE QuestionID='".$row['QID']."'";
			
			$answercount=0;
			
			$answer="";
			
			/*if($rs=$conn->query($query1)){
				
				$lim=3;
				
				$answercount=$rs->num_rows;
				
				while ($res1=$rs->fetch_assoc()) {
					
					$answer="
							".substr($res1['Answer'], 0,100)."<br>	
						";
					
					$ans=true;
					
				}
				
				if($answercount<1){
					
					$answer="No answers found. <small><a href='../views/contribute_answer.php?qid=".$row['QID']."&query=".$search_query."'>Contribute answer</a></small><br>";
					
					$ans=false;
					
				}
				
			}
			else{
				
				$answer="No answers found.<br>";
				
				$ans=false;
				
			}*/
			
			
			/**
				 *	
				 */
			
			if($ans){
				
				$start.="
						<u><h6><a href='index.php?result=".$row['QID']."&term=".$search_query."'>".$row['Question']."</a></h6></u>
						<small><i>Source: local</i></small>
						<small><i><small> Possible answers </i>".$answercount."</small></small><br>
						<small><small><i>Subject: ".$row['Subject']."; Topic: ".$row['Topic'].";</i></small></small><br>
						".$answer."
					";
				
			}
			else{
				
				$end.="
						<u><h6><a href='index.php?result=".$row['QID']."&term=".$search_query."'>".$row['Question']."</a></h6></u>
						<small><i>Source: local</i></small>
						<small><i><small> Possible answers </i>".$answercount."</small></small><br>
						<small><small><i>Subject: ".$row['Subject']."; Topic: ".$row['Topic'].";</i></small></small><br>
						".$answer."<br>
					";
				
			}
			
			$no++;
			
		}
		
		
		$output.=$start.$end;
		
	}
	else{
		
//		$output[]="<div class='output alert alert-info text-center'>No results found from Local</div>";
		
	}
    foreach ($wiki->query->search as $key => $value) {
        $output[] = (object)array(
            'link' => "http://en.wikipedia.org/wiki/" . $value->title,
            'title' => $value->title,
            'source' => "Wikipedia.org",
            'snippet' => substr($value->snippet, 0, 200)
        );
    }
//    die(var_dump($archive));
    foreach ($archive->response->docs as $doc) {
        if (isset($doc->description)) {
            $snippet = $doc->description;
        } else {
            $snippet = "";
        }
        if (is_array($snippet)) {
            $snippet = $snippet[0];
        }
        $output[] = (object)array(
            'link' => "https://www.archive.org/details/" . $doc->identifier,
            'title' => $doc->title,
            'source' => "Archive.org",
            'snippet' => substr($snippet, 0, 250) . "..."
        );
    }
	
}
else{
	
	$search_query="";
	
}


if(isset($_GET['result'])){
	
	$id=$_GET['result'];
	
	$term=$_GET['term'];
	
	$output="<br><br><u>Showing results for: <i>".$term."</i></u><br><hr>";
	
	$query="SELECT * FROM answers_tbl WHERE QuestionID='".$id."' ORDER BY Upvote DESC";
	
	if($res=$conn->query($query)){
		
		$num=$res->num_rows;
		
		while($row=$res->fetch_assoc()){
			
			$output.="
					".$row['Answer']."<br><hr>
				";
			
		}
		
		if($num<1){
			
			$output.="No anwsers found";
			
		}
		
	}
	
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
			  	<input type="text" class="form-control" placeholder="Search" value="<?php echo $search_query;
?>" name="search_box" id="search-query-3">
			  	<span class="input-group-btn">
			    	<button type="submit" name="search" class="btn"><span class="fui-search"></span></button>
			  	</span>
			</div>
		</form>
	</div>

	<div class="wrapper">
		<div class="container">
			<div class="col-md-12">
				<?php

?>
				<hr>
				<?php if(isset($_GET['search_query']) && $error){
	?>
				<p><i>More results from other sources</i></p>
				<?php
//                    $wiki=json_decode($wiki);
                    foreach ($output as $item) {
                        $title=$item->title;
                        $link=$item->link;
                        $snippet=$item->snippet;
                        $source=$item->source;
                        echo "<h6><a href='$link' target='_blank'>$title</a></h6><br> Source:<small><i>$source</i></small><p>$snippet</p>";

                    }

?>
				<?php
}
?>
			</div>
		</div>
	</div>

	<!--Add scripts-->
	<script type="text/javascript" src="../assets/dist/js/vendor/jquery.min.js"></script>
	<script type="text/javascript" src="../	assets/dist/js/flat-ui.js"></script>
</body>
</html>