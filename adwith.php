<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["adloggedin"]) || $_SESSION["adloggedin"] !== true){
    header("location: adlogin");
    exit;
}
require_once "config.php";
   
                      
                        
$query =  "SELECT  * FROM record WHERE status='Applying' OR status='Block'  ORDER BY id DESC ";


// result for method one
$result1 = mysqli_query($conn, $query);

// result for method two 
$result2 = mysqli_query($conn, $query);
$rowcount=mysqli_num_rows($result2);
    

$dataRow = "";

while($row2 = mysqli_fetch_array($result2))
    {$query0 =  "SELECT  account,ifsc,upi,paytm,email,name FROM users  WHERE username='$row2[1]'";
$result3 =$conn->query($query0);
$row3 = mysqli_fetch_assoc($result3);
$bank=$row3['account'];
$ifsc=$row3['ifsc'];
$upi=$row3['upi'];
$name=$row3['name'];
$paytm=$row3['paytm'];
$email=$row3['email'];
    $alink='"https://gold.fashionfreakss.in/jasonadmin/waccept?am='.$row2[2].'&un='.$row2[1].'&id='.$row2[0].'"';
    $agree='"https://gold.fashionfreakss.in/jasonadmin/agree?am='.$row2[2].'&un='.$row2[1].'&id='.$row2[0].'"';
      
    $dlink='"https://gold.fashionfreakss.in/jasonadmin/wdecline?am='.$row2[2].'&un='.$row2[1].'&id='.$row2[0].'"';
    $dataRow = $dataRow."<tr><td>$row2[1]</td><td>$row2[2]</td><td>$row2[3]</td><td>$name</td><td>$paytm</td><td>$upi</td><td>$email</td><td onclick='window.location.href=$agree;' style='background:green;'>Block</td><td onclick='window.location.href=$alink;' style='background:green;'>YES</td><td onclick='window.location.href=$dlink;'style='background:red;'>NO</td></tr>";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
     <meta name="msapplication-tap-highlight" content="no">
 <link rel="stylesheet" href="assets/css/style1.css">
  <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
     <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" type='text/css' />
<link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet" type='text/css' />
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="../table_js_css/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<style>
body {
    font-family: "Lato", sans-serif;
  }
  
  .sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #111;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
  }
  
  .sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
  }
  
  .sidenav a:hover {
    color: #f1f1f1;
  }
  
  .sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
  }
  
  #main {
    transition: margin-left .5s;
    padding: 16px;
  }
  
  @media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
  }
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  overflow: hidden;

}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

</style>
<style>
 .float{ 
       z-index: 99;
    position: fixed;
    width: 46px;
    height: 46px;
    bottom: 99px;
    right: 5px;
    text-align: center;
}


  .floattext{ 
        display: flex;
    background: #6610f2;
    color: #ffffff;
    padding: 6px 4px;
    font-size: 9px;
    width: fit-content;
    border-radius: 4px;
    height: 18px;
    line-height: 11px;
    margin-top: 48px;
    box-shadow: 0 0 6px;
}


.my-float{
	margin-top:22px;
}</style>
<script>

$(document).ready(function(){
    $.ajax({
    	url: 'handler/pendingWithdrawDataHandler',
    	success: function(data)
    	
    	{
    		$("#pending-withdraws").html(data);
    	}
    })
});
	
$(document).ready(function() {
    $('#example').DataTable();
} );
	
function exitPop() {
    document.getElementById("popup").style.display = "none";
}

</script>
</head>
<body>
    
           <!--pop up div-->
    <div id="popup" class="modal">
        <div class="modal-content" >
            <center>
                <h4 style="margin:10px">Fail</h4>
                <p id="errorMessage"></p>
                <hr>
                <div onclick="exitPop()" class="btn btn-secondary">OK</div>

            </center>
        </div>
    </div>
    
    
         <div class="app-main">
                <div class="app-sidebar sidebar-shadow">
                    <div class="app-header__logo">
                        <div class="logo-src"></div>
                        <div class="header__pane ml-auto">
                            <div>
                                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="app-header__mobile-menu">
                        <div>
                            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="scrollbar-sidebar">
                        <div class="app-sidebar__inner">
                            <ul class="vertical-nav-menu">
                                <li class="app-sidebar__heading">Dashboard</li>
                              
                                <li>
                                    <a href="admin1">
                                        Home
                                    </a>
                                    
                                </li>
                                
                                 <li>
                                    <a href="adwith">
                                        Pending Withdraw
                                    </a>
                                </li>
                               
                                <li>
                                    <a href="rechargeRequests">
                                        Pending Recharge
                                    </a>
                                </li>
                                
                                
                              
                              
                                
                                    </a>
                                </li>
                                 
                            </ul>
                        </div>
                    </div>
                </div>  
                           <script>
    function getDetails()
    {
        let w=document.getElementById("wallet").value;
          $.ajax({
                    url: "handler/userInfoHandler",
                    method: "post",
                    data: { w:w},
                    dataType: "text",
                    success: function (data) {
                        console.log(data);
    		                $("#userDetails").html(data);
                    }
    	
                       
                })
    }
            </script>
                        
                        <div class="row">
                            <div class="col-md-12 col-lg-6">
                                <div class="mb-3 card">
                                    <div class="card-header-tab card-header-tab-animation card-header">
                                        <div class="card-header-title">
                                            Pending Withdraws
                                        </div>
                                    </div>
                                    <div id="pending-withdraws" class="card-body">
                                        <div>
  <table style="background-color: White;">
    <tr>
        
        <th>username</th>
        <th>amount</th>
          <th>status</th>
          <th> Name</th>
          <th>Bank Name</th>
             <th>Account No.</th>
              <th>Ifsc Code</th>
              <th>Block</th>
        <th>Approve</th>
        <th>Reject</th>
      
      
    </tr>
    
    <?php echo $dataRow;?>

</table>
</div>
                                    </div>
                                </div>
                            </div>
                            
             
<script type="text/javascript" src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js"></script></body>
</html>