<?php
  session_start();
  include '../system/conn.php';
	if(isset($_POST['getunit'])){
		$level=$_POST['level'];
    $table="subjects";
    $output="";
    if($level=="university"){
      $table="courses";
      $sql="SELECT * FROM ".$table."";
      if($result=$conn->query($sql)){
        while($row=$result->fetch_assoc()){
          $output=array('ID' => $row['ID'],'Discipline'=>$row['Discipline']);
        }
      }
    }else{
      $table="subjects";
      $sql="SELECT * FROM ".$table."";
      if($result=$conn->query($sql)){
        while($row=$result->fetch_assoc()){
          $output.="
            <option value='".$row['ID']."'>".$row['Subject']."</option>
          ";
        }
      }
    }
		echo json_encode($output);
	}

  if(isset($_POST['gettopic'])){
    $unit=$_POST['unit'];
    $output="";
    $sql="SELECT * FROM topics WHERE ParentID='".$unit."'";
    $result=$conn->query($sql);
    while($row=$result->fetch_assoc()){
      $output.="
        <option value='".$row['ID']."'>".$row['TopicName']."</option>
      ";
    }
    echo json_encode($output);
  }
?>
