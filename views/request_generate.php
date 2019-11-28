    <?php
        session_start();
        include '../system/conn.php';

    //check if session is valid

    //check if request is to generate for which level
    if(isset($_POST['generate_pdf'])){
      include '../functions/fpdf.php';
        $level=$_POST['level'];
        $array=$_POST['array'];
        $total=$_POST['total'];
        $table="";
        if($level=="high"){
            $table="exam_q_secondary";
        }else{
            $table="exam_q_primary";
        }
        $sql="SELECT * FROM ".$table;
        $arrayName = array();
        if($result=$conn->query($sql)){
            $count=1;
            $min=1;
            $max=$total/sizeof($array);
            while($row=$result->fetch_assoc()){
                if(in_array($row['ID'],$array)){
                    $arrayName[]=array('Count'=>$count,'Question'=>htmlspecialchars_decode($row['Question']),'Marks'=>mt_rand($min,$max));
                    $count++;
                }
            }
          $pdf = new FPDF('P','mm','A4');
          $pdf->SetMargins(15,15,15);
          $pdf->AddPage();
          $pdf->SetFont('Arial','',12);
          foreach ($arrayName as $key) {
            $pdf->Cell(150,10,$key['Count']." .".$key['Question'],0,0);
            $pdf->Cell(40,10,"(Marks: ".$key['Marks'].")");
            $pdf->Ln();
          }
        $idkeyspace='ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $length=6;
        $idstr=array();
        $max=strlen($idkeyspace)-1;
        for ($i=0; $i<$length ; ++$i) {
            $n=rand(0,$max);
            $idstr[]=$idkeyspace[$n];
        }

        $aid=implode($idstr);
          $pdf->Output("F","../generated/docs/".$aid.".pdf");
        }

    }
    $status="";
    if(isset($_POST['postquestion'])){
        $subject=$_POST['unit'];
        $topic=$_POST['topic'];
        $level=$_POST['level'];
        $class=$_POST['class'];
        $lowmark=$_POST['lmark'];
        $highmark=$_POST['hmark'];
        $question=$_POST['question'];
        $table="";
        if($level=="high"){
            $table="exam_q_secondary";
            $values="QID,Question,Topic,Subject,Form,LowestMark,HighestMark,Author";
        }else{
            $table="exam_q_primary";
            $values="QID,Question,Topic,Subject,Class,LowestMark,HighestMark,Author";
        }
        $idkeyspace='ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $length=6;
        $idstr=array();
        $max=strlen($idkeyspace)-1;
        for ($i=0; $i<$length ; ++$i) {
            $n=rand(0,$max);
            $idstr[]=$idkeyspace[$n];
        }

        $aid=implode($idstr);
        $sql="INSERT INTO ".$table." (".$values.") VALUES ('".$aid."','".$question."','".$topic."','".$subject."','".$class."','".$lowmark."','".$highmark."','isaac')";
        if($result=$conn->query($sql)){
            $status="Success";
        }else{
            $status="Failed";
        }
    }
    if(isset($_POST['generatepdf1'])){
        $questions=$_POST['questions'];
        /*foreach ($questions as $key) {
            echo $key."<br>";
        }*/
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <body>

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
    </script>

    <!-- Morris Charts JavaScript -->
    <script src="../assets/js/plugins/morris/raphael.min.js"></script>
    <script src="../assets/js/plugins/morris/morris.min.js"></script>
    <script src="../assets/js/plugins/morris/morris-data.js"></script>
    <script type="text/javascript" src="../	assets/dist/js/flat-ui.js"></script>
    </body>

    </html>
