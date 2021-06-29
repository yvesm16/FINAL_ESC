<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IICS E - Services</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,600;0,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
</head>



<body id= "login">
    <div id="divlog" >
        <center>
        <img style = "display:block; margin-left: auto; margin-right: auto;" src="../images/iicslogo.png" width="80" height="85" >
        <h1 style="text-align:center; font-family:'Montserrat'" >IICS E-Services</h1>
        <h3 style="text-align:center; font-family:'Montserrat'" >Consultation, Student Appeal and Course Crediting</h3>
        <form id="loginform" action='forgotpassword' method='post'>
            @csrf
            @if(session()->has('message'))
                <div class="alert-danger" style="color:#FF0000;">
                    {{ session()->get('message') }}
                </div>
            @endif
            @if(session()->has('emessage'))
                <div class="alert-danger" style="color:#00FF00;">
                    {{ session()->get('emessage') }}
                </div>
            @endif
            <p style="text-align:center; font-family:'Montserrat'">Fill in your email and create new password</p>
            <label id= "loginlabel" for="email"><p style="font-family:'Montserrat'; font-size: 15px; text-align: right;">Email:</p></label>
             <input id="logininput" type="text" id="email" name="email" placeholder="ex. juan.delacuz.iics@ust.edu.ph">
             <label id= "loginlabel" for="newpassword">  <p style="font-family:'Montserrat'; font-size: 15px; text-align: left;"> New Password:   </p></label>
             <input id="logininput" type="text" id="password" name="password" placeholder="********">
             <label id= "loginlabel" for="rtnewpassword">  <p style="font-family:'Montserrat'; font-size: 15px; text-align: left;"> Re-Type<br> New Password:   </p></label>
             <input id="logininput" type="text" id="rtpass" name="rtpass" placeholder="********"><br><br>
             <button  style="text-align:center"type="submit" class="login-btn"> <a id="loginbutton" href="">Send</a> </button>
        </form> 
        </center>
        </div>
</body>

</html>
