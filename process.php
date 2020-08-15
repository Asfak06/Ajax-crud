<?php
include("dbcon.php");

extract($_POST);

if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['age']) && isset($_POST['desig'])){
	$query="insert into crud (fname,lname,age,desig) values('$fname','$lname','$age','$desig')";
	mysqli_query($conn,$query);
}

if(isset($_POST['rd'])){
	$data="<table class='table table-bordered'>
			<tr>
			<th>SL.</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Age</th>
			<th>Designation</th>
			<th>Operations</th>
			</tr>";
	$query="select * from crud";
	$run=mysqli_query($conn,$query);
	if(mysqli_num_rows($run)>0){
		$num=1;
		while($row=mysqli_fetch_array($run)){
			$data.="<tr>
					<td>".$num."</td>
					<td>".$row['fname']."</td>
					<td>".$row['lname']."</td>
					<td>".$row['age']."</td>
					<td>".$row['desig']."</td>
					<td>
					<button class='btn btn-primary' onclick='GetData($row[id])'>Edit</button>
					<button class='btn btn-danger' onclick='DelData($row[id])'>Delete</button>
					</td>
					</tr>";
					$num=$num+1;
		}
	}
	$data.="</table>";
	echo $data;			
}

if(isset($_POST['user_id'])){
	$id=$_POST['user_id'];
	$query="delete from crud where id ='$id' ";
	mysqli_query($conn,$query);
}

if(isset($_POST['User_id']) && isset($_POST['User_id'])!=""){
	$User_id=$_POST['User_id'];
	$query="select * from crud where id ='$User_id' ";
	$run=mysqli_query($conn,$query);
	if(!$run){
		exit(mysqli_error());
	}
	$arr=array();
	if(mysqli_num_rows($run)>0){
		while($row=mysqli_fetch_assoc($run)){
			$arr=$row;
		}
		echo json_encode($arr);
	}
	else{
		$arr['response']=200;
		$arr['message']="Invalid request";

	}
}
else{
		$arr['response']=200;
		$arr['message']="Invalid request";

	}

if(isset($_POST['hidden_userid'])){
	$ufname=$_POST['ufname'];
	$ulname=$_POST['ulname'];
	$uage=$_POST['uage'];
	$udesig=$_POST['udesig'];
	$id=$_POST['hidden_userid'];
$query="update crud set fname= '$ufname', lname= '$ulname', age= '$uage', desig= '$udesig' where id='$id' ";
    mysqli_query($conn,$query);
}
?>