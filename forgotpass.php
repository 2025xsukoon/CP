<?php
//This script will handle login
session_start();

require_once "conn.php";
$un=trim($_POST["username"]);
$otp=trim($_POST["otp"]);
$query0 =  "SELECT  username FROM verify  WHERE otp='$otp'";
$result3 =$conn->query($query0);
$row3 = mysqli_fetch_assoc($result3);
$verun=$row3['username'];
if($un==$verun){
    

// Define variables and initialize with empty values
$username = $password =  "";
$username_err = $password_err =  "";


// Processing form data when form is submitted

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['newpassword'])))
    {
        $err = "Please enter username + password";
        echo($err);
    }
    else{
        $username = trim($_POST['username']);
        $newpassword = trim($_POST['newpassword']);
    }


if(empty($err))
{
   
$sql = "UPDATE users SET password='$newpassword' WHERE username='$username'";


if ($conn->query($sql)) {
      echo "<script>
     document.addEventListener('DOMContentLoaded', function(event) { 
     
                 document.getElementById('snackbar').innerHTML='Password change success';
          document.getElementById('snackbar').style.display= '';
        setTimeout(function () { document.getElementById('snackbar').style.display= 'none'; }, 3000);
 
});
                
     
                </script>";
                    header("location: login#");
} else {
     echo "<script>
     document.addEventListener('DOMContentLoaded', function(event) { 
     
                 document.getElementById('snackbar').innerHTML='Somthing went wrong try again';
          document.getElementById('snackbar').style.display= '';
        setTimeout(function () { document.getElementById('snackbar').style.display= 'none'; }, 3000);
 
});
                
     
                </script>";
}
   


}
}

}else{
     echo "<script>
     document.addEventListener('DOMContentLoaded', function(event) { 
     
                 document.getElementById('snackbar').innerHTML='Incorrect OTP';
          document.getElementById('snackbar').style.display= '';
        setTimeout(function () { document.getElementById('snackbar').style.display= 'none'; }, 3000);
 
});
                
     
                </script>";
}

?>

 <script>
     setInterval(function () { 
  if(document.getElementById("pass").value.length>5 && document.getElementById("num").value.length==10 && document.getElementById("otp").value.length>3){
      document.getElementById("btn").className="btn-main sign act";
  }else{
      document.getElementById("btn").className="btn-main sign";
       
  }
     }, 300);
     
       let timerOn = true;

function timer(remaining) {
  var m = Math.floor(remaining / 60);
  var s = remaining % 60;
  
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  document.getElementById('otpbtn').innerHTML = m + ':' + s;
  remaining -= 1;
  
  if(remaining >= 0 && timerOn) {
    setTimeout(function() {
        timer(remaining);
    }, 1000);
    return;
  }

  if(!timerOn) {
    // Do validate stuff here
    return;
  }
  
  // Do timeout stuff here
  document.getElementById('otpbtn').innerHTML="RESEND"
   document.getElementById("otpbtn").onclick = sendcode();
}


      
     function sendcode(){
         var number=document.getElementById("num").value;
         if(number!=null && number.length==10){
             var xmlhttp = new XMLHttpRequest();
             xmlhttp.open("GET", "otp?num=" + number , true);
             xmlhttp.send();
             timer(60);
             document.getElementById('otpbtn').removeAttribute("onclick");
             document.getElementById("snackbar").innerHTML="OTP SENT ";
               document.getElementById("snackbar").style.display= "";
        setTimeout(function () { document.getElementById("snackbar").style.display= "none"; }, 3000);
     
  
         }else{
                 document.getElementById("snackbar").innerHTML="Mobile Number is required";
          document.getElementById("snackbar").style.display= "";
        setTimeout(function () { document.getElementById("snackbar").style.display= "none"; }, 3000);
     
  
         }
         
     }
     
   
      
  </script>
  <script type='text/JavaScript'>



function sub() {
      document.getElementById('createuser').submit();      
}

</script>
 
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">
  <meta http-equiv="pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
  <meta http-equiv="expires" content="1">
  <meta name="google" value="notranslate">
  <meta name="msapplication-TileColor" content="#fff">
  <meta name="theme-color" content="#fff">
  <meta name="msapplication-navbutton-color" content="#fff">
  <meta name="apple-mobile-web-app-status-bar-style" content="#fff">
  <meta name="description" content="Make money with us.">
  <link rel="shortcut icon" href="fevicon.png" type="image/x-icon">
  <link rel="stylesheet" href="akshay/css/bootstrap.min.css">
  <link rel="stylesheet" href="akshay/css/light.css">
  <link rel="stylesheet" href="akshay/css/dropzone.css">
<?php include 'akshay.php';?>
  <style>
      .van-toast {
    position: fixed;
    top: 50%;
    left: 50%;
    display: -webkit-box;
    display: -webkit-flex;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -webkit-flex-direction: column;
    flex-direction: column;
    -webkit-box-align: center;
    -webkit-align-items: center;
    align-items: center;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    justify-content: center;
    box-sizing: content-box;
    width: 88px;
    max-width: 70%;
    min-height: 88px;
    padding: 16px;
    color: #fff;
    font-size: 14px;
    line-height: 20px;
    white-space: pre-wrap;
    text-align: center;
    word-wrap: break-word;
    background-color: rgba(50, 50, 51, .88);
    border-radius: 8px;
    -webkit-transform: translate3d(-50%, -50%, 0);
    transform: translate3d(-50%, -50%, 0);
}
.van-toast--html, .van-toast--text {
    width: -webkit-fit-content;
    width: fit-content;
    min-width: 96px;
    min-height: 0;
    padding: 8px 12px;
}.nav-back.wt {
    background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAHgAAAB4CAYAAAA5ZDbSAAAACXBIWXMAAA7EAAAOxAGVKw4bAAAEa2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSfvu78nIGlkPSdXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQnPz4KPHg6eG1wbWV0YSB4bWxuczp4PSdhZG9iZTpuczptZXRhLyc+CjxyZGY6UkRGIHhtbG5zOnJkZj0naHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyc+CgogPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9JycKICB4bWxuczpBdHRyaWI9J2h0dHA6Ly9ucy5hdHRyaWJ1dGlvbi5jb20vYWRzLzEuMC8nPgogIDxBdHRyaWI6QWRzPgogICA8cmRmOlNlcT4KICAgIDxyZGY6bGkgcmRmOnBhcnNlVHlwZT0nUmVzb3VyY2UnPgogICAgIDxBdHRyaWI6Q3JlYXRlZD4yMDIyLTA1LTIwPC9BdHRyaWI6Q3JlYXRlZD4KICAgICA8QXR0cmliOkV4dElkPmRiYzY3YjJlLWY5YzMtNDdiYi05MmZkLTM0ZTZjMmNiOWRhNDwvQXR0cmliOkV4dElkPgogICAgIDxBdHRyaWI6RmJJZD41MjUyNjU5MTQxNzk1ODA8L0F0dHJpYjpGYklkPgogICAgIDxBdHRyaWI6VG91Y2hUeXBlPjI8L0F0dHJpYjpUb3VjaFR5cGU+CiAgICA8L3JkZjpsaT4KICAgPC9yZGY6U2VxPgogIDwvQXR0cmliOkFkcz4KIDwvcmRmOkRlc2NyaXB0aW9uPgoKIDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PScnCiAgeG1sbnM6ZGM9J2h0dHA6Ly9wdXJsLm9yZy9kYy9lbGVtZW50cy8xLjEvJz4KICA8ZGM6dGl0bGU+CiAgIDxyZGY6QWx0PgogICAgPHJkZjpsaSB4bWw6bGFuZz0neC1kZWZhdWx0Jz5JY29uKEwpLTEyMHgxMjA8L3JkZjpsaT4KICAgPC9yZGY6QWx0PgogIDwvZGM6dGl0bGU+CiA8L3JkZjpEZXNjcmlwdGlvbj4KCiA8cmRmOkRlc2NyaXB0aW9uIHJk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) no-repeat 50%;
    background-size: contain;
}
  </style>
</head>

<body>
  <section class="container-fluid">
    <div class="row mcas">
      <div class="col-md-6 col-lg-4 main lr">
        <div class="row nav-top">
          <div class="col-1 xtl"><span class="nav-back wt ghlg6j" style="padding-top: 45px;"></span></div>
          <div class="tfw-5 tf-18" onclick="window.location.href='https://squidgamez.com/#/login';" id="navt" style="color:white;">&nbsp;Forgot Password?</div>
        </div>
        <div class="row">
          <div class="col-12 pt-2">
              <br>
            <img src="https://squidgamez.com/img/logo.70ac9228.png" height="100">

          </div>
          <div class="col-12 vrgj89b">
            <div class="row">
              <div class="col-12">
                <div class="col-12">
                    <form action="" id="createuser" method="POST" >
                  <div class="row ma-10">
                       
                    <div class="col-12 inpbcx mt-2 mb-2"><span class="xicon tfw-6 tf-18">+91</span><input id="num" type="tel"
                        class="xbox nmob" name="username" maxlength="10" placeholder="Mobile Number" autocomplete="off"></div>
                    <div class="col-12 inpbcx mt-2 mb-2"><span class="xicon lock"></span><input id="pass" name="newpassword" type="text"
                        class="xbox pin npas" maxlength="21" placeholder="New Password (&ge;6 characters)" autocomplete="off">
                    </div>
                    <div class="col-8 inpbcx mt-2 mb-2"><input type="tel" name="otp" id="otp" class="xbox nop" maxlength="6"
                        placeholder="Verification Code" autocomplete="off"></div>
                    <div class="col-4 pa-0 mt-2 mb-2">
                      <div onclick="sendcode()" id="otpbtn" class="GROTP">OTP</div>
                    </div>
              
                    <div class="col-12 pa-0 mt-2 mb-2">
                      <div id="btn" onclick="sub()" class="btn-main newuser">Reset</div>
                    </div>
                      </form>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
         <div id="snackbar" class="van-toast van-toast--middle van-toast--text" style="z-index: 2009;display:none "><div class="van-toast__text">OTP Sent</div></div>
        <div class="row dta_ref"></div>
      </div>
    </div>
  </section>
  

</body>

</html>