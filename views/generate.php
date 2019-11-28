<?php
session_start();

//check if session is valid
include '../system/conn.php';
$output="";

//check if request is to generate for which level
if(isset($_POST['generate_pdf'])){

	$level=$_POST['level'];

	$totalmarks=$_POST['total'];

	$number=$_POST['number'];

	$subject=$_POST['subject'];

	$topic=$_POST['topic'];

}

if(isset($_POST['viewquestions'])){
    $level=$_POST['level'];
    $unit=$_POST['unit'];
    $topic=$_POST['topic'];
    $number=$_POST['number'];
    $class=$_POST['class'];
    $table="";
    $tclass="";
    if($level=="high"){
        $table="exam_q_secondary";
        $tclass="Form";
    }else{
        $table="exam_q_primary";
        $tclass="Class";
    }
    $sql="SELECT * FROM ".$table." WHERE ".$tclass." = ".$class." AND Subject=".$unit;
    $array=array();
    if($result=$conn->query($sql)){
        while($row=$result->fetch_assoc()){
            $array[]=array('ID'=>$row['ID'],'QID'=>$row['QID'],'Question'=>$row['Question'],'LowMarks'=>$row['LowestMark'],'HighMarks'=>$row['HighestMark']);
        }
    }
    //var_dump($array);
    $tablehead="
    <thead>
    	<tr>
    		<th>ID</th>
    		<th>QID</th>
    		<th>Question</th>
    		<th>Lowest Mark</th>
    		<th>Highest Mark</th>
    		<th>Pick</th>
    	</tr>
    </thead>
    ";
    $tablerows="";
    foreach($array as $key){
    	$tablerows.="
    		<tr>
    			<td>".$key['ID']."</td>
    			<td>".$key['QID']."</td>
    			<td>".$key['Question']."</td>
    			<td>".$key['LowMarks']."</td>
    			<td>".$key['HighMarks']."</td>
    			<td class='pbm'>
		          <div class=\"bootstrap-switch-square\">
		            <input onchange='check(".$key['ID'].")' id='".$key['ID']."' name='question' type=\"checkbox\"/>
		          </div>
    			</td>
    		</tr>
    	";
    }
    $output= "
        <form id='form1'>
    	   <table style='font-size:12px;' class='table table-condensed table-striped table-hover table-bordered'>
                ".$tablehead.$tablerows."<br>
            </table>
            <input type='text' id='level' value='".$level."' hidden>
            <input type='number' class=form-control placeholder='Enter Total Marks' id='total'/>
            <br>
            <button name='generatepdf1' id='submit1' class='btn btn-primary'>Submit</button>
    	</form>
    ";
}
?>
<!DOCTYPE html>
	<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>ENLIGHTEN</title>

        <!-- Bootstrap Core CSS -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="../assets/dist/css/flat-ui.css">

        <!-- Custom CSS -->
        <link href="../assets/css/sb-admin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="../assets/css/plugins/morris.css" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
<body>
	<div class="wrapper">
		<!--Navigation-->
		         <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">ENLIGHTEN</a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                        <ul class="dropdown-menu message-dropdown">
                            <li class="message-preview">
                                <a href="#">
                                    <div class="media">
                                        <span class="pull-left">
                                            <img class="media-object" src="http://placehold.it/50x50" alt="">
                                        </span>
                                        <div class="media-body">
                                            <h5 class="media-heading"><strong>John Smith</strong>
                                            </h5>
                                            <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="message-footer">
                                <a href="#">Read All New Messages</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                        <ul class="dropdown-menu alert-dropdown">
                            <li>
                                <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">View All</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>user<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li class="active">
                            <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>

            <div id="page-wrapper">

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Dashboard <small>Statistics Overview</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li class="active">
                                    <i class="fa fa-dashboard"></i> Dashboard
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->

                    <div class="row">
                    	<div class="col-md-12">
                    		<?php echo $output; ?>
                    	</div>
                	</div><br>
                <hr>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div>Designed by Itcyborg Solutions</div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                    </div>
                    <div class="col-lg-3 col-md-6">
                    </div>
                    <div class="col-lg-3 col-md-6">
                        Copyright <?php echo date('Y'); ?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	</div>
    <script src="../assets/dist/js/vendor/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
    <script type="text/javascript">
        var selectedquestions=[];
        $('#form1').submit(function(e){
            e.preventDefault();
            $.ajax({
                url:'request_generate.php',
                data:{
                    'generate_pdf':1,
                    'level':$('#level').val(),
                    'array':selectedquestions,
                    'total':$('#total').val()
                },
                type:'post',
                beforeSend:function(){},
                success: function(data){
                }
            });
        });

        function check(key){
            if($('#'+key).is(":checked")){
                selectedquestions.push(key);
            }else{
                var index=selectedquestions.indexOf(key);
                selectedquestions.splice(index,1);
            }
        }
    </script>
    <script src="../assets/dist/js/flat-ui.js"></script>
</body>
</html>
