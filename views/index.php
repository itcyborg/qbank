<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ENLIGHTEN</title>

    <!-- Bootstrap Core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../assets/css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../assets/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>

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
                    <li>
                        <a href="generate.php?type=add&category=questions"><i class="fa fa-fw fa-question-circle"></i>Add Questions</a>
                    </li>
                    <li>
                        <a href="generate.php?type=view&category=questions"><i class="fa fa-fw fa-question-circle"></i>View Questions</a>
                    </li>
                    <li>
                        <a href="generate.php?type=add&category=answers"><i class="fa fa-fw fa-question-circle"></i>Provide Answers</a>
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
                    </div>
                </div>
                <!-- /.row -->

                <div class="row col-md-11">
                    <ul class="nav nav-tabs">
                      <li class="active"><a data-toggle="tab" href="#addQuestions">Add Questions</a></li>
                      <li><a data-toggle="tab" href="#viewQuestions">View Questions</a></li>
                    </ul>

                    <div class="tab-content">
                      <div id="addQuestions" class="tab-pane fade in active">
                          <div class="container col-md-12" style="margin-top:30px;">
                              <form action="request_generate.php" class="col-md-12" method="POST">
                                    <div class="form-group col-lg-12">
                                        <div class="col-md-4">
                                            <select class="form-control flat" id="level" name="level">
                                                <option value="">Select level</option>
                                                <option value="high">High School</option>
                                                <option value="primary">Primary School</option>
                                                <!--option value="university">University</option-->
                                            </select>
                                        </div>
                                        <!--select class="form-control" id="discipline" hidden="hidden">
                                        <option value="">Select Discipline</option>
                                    </select-->
                                    <div class="col-md-4">
                                        <select class="col-lg-4 form-control flat" id="unit" name="unit">
                                            <option value="">Select Unit/Subject</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-input col-lg-4 form-control flat" id="topic" name="topic">
                                            <option value="">Select Topic</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="class" id="class" placeholder="Class/Form">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="lmark" placeholder="Lowes Mark">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="hmark" placeholder="Highest Mark">
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <textarea name="question" rows="8" cols="80" class="form-control	" placeholder="Question"></textarea>
                                </div>
                                <input type="submit" name="postquestion" value="Submit" class="btn btn-primary">
                            </form>
                          </div>
                      </div>
                      <div id="viewQuestions" class="tab-pane fade">
                          <div class="container col-md-12" style="margin-top:30px;">
                              <form action="generate.php" class="col-md-12" method="POST">
                                    <div class="form-group col-lg-12">
                                        <div class="col-md-4">
                                            <select class="form-control flat" id="level1" name="level">
                                                <option value="">Select level</option>
                                                <option value="high">High School</option>
                                                <option value="primary">Primary School</option>
                                                <!--option value="university">University</option-->
                                            </select>
                                        </div>
                                        <!--select class="form-control" id="discipline" hidden="hidden">
                                        <option value="">Select Discipline</option>
                                    </select-->
                                    <div class="col-md-4">
                                        <select class="col-lg-4 form-control flat" id="unit1" name="unit">
                                            <option value="">Select Unit/Subject</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-input col-lg-4 form-control flat" id="topic1" name="topic">
                                            <option value="">Select Topic</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <div class="col-md-4">
                                        <select class="form-input col-lg-4 form-control flat" id="number1" name="number">
                                            <option value="">Select Number</option>
                                            <option value="10">5 Questions</option>
                                            <option value="25">25 Questions</option>
                                            <option value="50">50 Questions</option>
                                            <option value="75">75 Questions</option>
                                            <option value="100">100 Questions</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="class" id="class" placeholder="Class/Form">
                                    </div>
                                </div>
                                <input type="submit" name="viewquestions" value="Submit" class="btn btn-primary">
                            </form>
                          </div>
                      </div>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                    </div>
                    <div class="col-lg-3 col-md-6">
                    </div>
                    <div class="col-lg-3 col-md-6">
                    </div>
                    <div class="col-lg-3 col-md-6">
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../assets/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">
        $('#level').change(function(){
            var le=$('#level').val();
            $.ajax({
                url: '../functions/getpars.php',
                type:	'POST',
                data:{
                    'getunit'	: 	1,
                    'level'		:	le
                },
                dataType:'JSON',
                beforeSend:function(){
                },
                success:function(output){
                    console.log(output);
                    $('#unit').html("<option value=''>Select Unit/Subject</option>"+output);
                }
            });
        });
        $('#unit').change(function(){
            var le=$('#unit').val();
            $.ajax({
                url: '../functions/getpars.php',
                type:	'POST',
                data:{
                    'gettopic'	: 	1,
                    'unit'		:	le
                },
                dataType:'JSON',
                beforeSend:function(){
                },
                success:function(result){
                    console.log(result);
                    $('#topic').html("<option value=''>Select Topic</option>"+result);
                }
            });
        });
        $('#level1').change(function(){
            var le=$('#level1').val();
            $.ajax({
                url: '../functions/getpars.php',
                type:	'POST',
                data:{
                    'getunit'	: 	1,
                    'level'		:	le
                },
                dataType:'JSON',
                beforeSend:function(){
                },
                success:function(output){
                    console.log(output);
                    $('#unit1').html("<option value=''>Select Unit/Subject</option>"+output);
                }
            });
        });
        $('#unit1').change(function(){
            var le=$('#unit1').val();
            $.ajax({
                url: '../functions/getpars.php',
                type:	'POST',
                data:{
                    'gettopic'	: 	1,
                    'unit'		:	le
                },
                dataType:'JSON',
                beforeSend:function(){
                },
                success:function(result){
                    console.log(result);
                    $('#topic1').html("<option value=''>Select Topic</option>"+result);
                }
            });
        });
    </script>

    <!-- Morris Charts JavaScript -->
    <script src="../assets/js/plugins/morris/raphael.min.js"></script>
    <script src="../assets/js/plugins/morris/morris.min.js"></script>
    <script src="../assets/js/plugins/morris/morris-data.js"></script>
</body>

</html>
