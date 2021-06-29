<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IICS E - Services</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,600;0,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
    <link href = {{ asset("bootstrap/css/bootstrap.css") }} rel="stylesheet" />

    
</head>



<body id= "login">


    <div id="divlog">
        <center>
        <img style = "display:block; margin-left: auto; margin-right: auto;" src="{{ url('images/iicslogo.png') }}" width="80" height="85" >
        <h1 style="text-align:center; font-family:'Montserrat'" >IICS E-Services</h1>
        <h3 style="text-align:center; font-family:'Montserrat'" >Consultation, Student Appeal and Course Crediting</h3>
    
        <form id="loginform" method="POST" action="register">
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
            <label id= "loginlabel" for="email">  <p style="font-family:'Montserrat'; font-size: 15px; text-align: right;">Email:</p>  </label>
                <input id="logininput" type="text" id="email" name="email" placeholder="ex. juan.delacuz.iics@ust.edu.ph"><br>
            <label id= "loginlabel" for="newpassword">  <p style="font-family:'Montserrat'; font-size: 15px; text-align: right;"> New Password:  </p></label>
                <input id="logininput" type="text" id="password" name="password" placeholder="********">
             <!--<p style="font-family:'Montserrat'; font-size: 15px; color:red">***Your password is weak</p> -->
             <br>
             <label id= "loginlabel" for="rtnewpassword"><p style="font-family:'Montserrat'; font-size: 15px; text-align: right;" > Re-Type New Password: </p></label>
                <input id="logininput" type="text" id="rtpass" name="rtpass" placeholder="********">
            <br><br><br>
             <button id="regbutton" style="text-align:center"type="submit" class="login-btn" name='register'>Register</button>
        </form> 
        



        </center>
        </div>

</body>
</html>


