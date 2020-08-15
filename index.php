
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Document</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- <link rel="shortcut icon" type="image/x-icon" href="img/m.png"> -->
  <link rel="stylesheet" href="css/all.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/navbar-fixed.css">
  <link rel="stylesheet" href="css/style.css"> 
  <script src="js/jquery.min.js"></script>

</head>

<body>

<div class="container">
  <div class="row">
    <br>
    <h1 class="display-3 m-auto text-danger font-weight-bold ">C . R . U . D</h1>
  </div>
  <div class="row">
    <div class="col-md-12">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#exampleModalCenter">
    Insert Data
    </button>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-dark">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Enter Data </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <input class="form-control" type="text" id="fname" placeholder="Enter first name">
            </div>
            <div class="form-group">
              <input class="form-control" type="text" id="lname" placeholder="Enter last name">
            </div>
            <div class="form-group">
              <input class="form-control" type="text" id="age" placeholder="Enter age">
            </div>
            <div class="form-group">
              <input class="form-control" type="text" id="desig" placeholder="Enter designation">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="adata();"> Save </button>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div> 

    <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-dark">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Enter Data </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <input class="form-control" type="text" id="ufname" placeholder="Enter first name">
            </div>
            <div class="form-group">
              <input class="form-control" type="text" id="ulname" placeholder="Enter last name">
            </div>
            <div class="form-group">
              <input class="form-control" type="text" id="uage" placeholder="Enter age">
            </div>
            <div class="form-group">
              <input class="form-control" type="text" id="udesig" placeholder="Enter designation">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="updateData();"> Update </button>
            <input type="hidden" id="hidden_userid">
          </div>
        </div>
      </div>
    </div>

  <div class="row">
  	<div class="col-md-12">
  		<h3>All records</h3>
  		<div id="records">
  			
  		</div>
  	</div>
  </div> 
</div>


<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


  <script src="js/anime.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/navbar-fixed.js"></script>

 <script type="text/javascript">

      function adata(){
      var fname=$("#fname").val();
      var lname=$("#lname").val();
      var age=$("#age").val();
      var desig=$("#desig").val();
      if(fname==""||lname==""||age==""||desig==""){
        alert("all fields are required");
      }else{
        $.ajax({
          url:"process.php",
          type:"post",
          data:{fname:fname,
                lname:lname,
                age:age,
                desig:desig},
          success:function(data,status){
            alert("data inserted");
            readRecords();           
            $("#exampleModalCenter input").val("");
            $("#exampleModalCenter").modal("hide");
          }
        });
      }
    };  

    function readRecords(){
    	var rd="rd";
    	$.ajax({
    		url:"process.php",
    		type:"post",
    		data:{rd:rd},
    		success:function(data,status){
    			$("#records").html(data);
    		}
    	});

    }

    function DelData(user_id){
    	var conf=confirm("Are you sure ?");
    	if (conf=true){
    		$.ajax({
    			url:"process.php",
    			type:"post",
    			data:{user_id:user_id},
    			success:function () {
    				readRecords();
    			}
    		});
    	}
    }

    function GetData(User_id){

    	$("#hidden_userid").val(User_id);

    	$.ajax({
    		url:"process.php",
    		type:"post",
    		data:{User_id:User_id},
    		success:function(data,status){
       			var user=JSON.parse(data);
       			$("#ufname").val(user.fname);
       			$("#ulname").val(user.lname);
       			$("#uage").val(user.age);
       			$("#udesig").val(user.desig);
    		}
    	});

    	$("#update").modal('show');
    }

    function updateData(){
    	var ufname=$("#ufname").val();
    	var ulname=$("#ulname").val();
    	var uage=$("#uage").val();
    	var udesig=$("#udesig").val();
    	var hidden_userid=$("#hidden_userid").val();
    	if(ufname=="" || ulname=="" || uage=="" || udesig==""){
    		alert("All fields required");
    	}else{
    		$.ajax({
    			url:"process.php",
    			type:"post",
    			data:{hidden_userid:hidden_userid,ufname:ufname,ulname:ulname,uage:uage,udesig:udesig},
    			success:function(data,status){
    				$("#update").modal('hide');
    				readRecords();
    			}
    		});
    	}
    }

$(document).ready(function () {
   readRecords();
});
  </script> 

</body>
</html>