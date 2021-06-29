<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Account</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,600;0,700;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href ="../css/style.css" >
</head>
<body id= "login">
    <form  action="register" method='POST'>
    <div id="divlog">
        <center>
        <img style = "display:block; margin-left: auto; margin-right: auto;" src="../images/iicslogo.png" width="80" height="85" >
        <h1 style="text-align:center; font-family:'Montserrat'" >IICS E-Services</h1>
        <h3 style="text-align:ce    nter; font-family:'Montserrat'" >Consultation, Student Appeal and Course Crediting</h3>
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

        <br><br>
    </form>
<br><br><br>
<a href="login">Log in</a>
</center>
</body>
</html>