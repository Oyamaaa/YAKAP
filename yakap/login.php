<?php

session_start();

$error = "";

if(isset($_SESSION['login_error'])){

    $error = $_SESSION['login_error'];

    unset($_SESSION['login_error']);

}

?>

<!DOCTYPE html>

<html>

<head>

<title>
YAKAP Login
</title>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<link rel="icon"
type="image/png"
href="yama.png">

<link rel="stylesheet"
href="style.css">

<style>

body{

margin:0;

padding:0;

font-family:'Segoe UI', sans-serif;

background:
linear-gradient(
135deg,
#0f172a,
#1e3a8a,
#2563eb
);

height:100vh;

display:flex;

justify-content:center;

align-items:center;

overflow:hidden;

}

/* LOGIN CARD */

.login{

width:100%;

max-width:400px;

background:white;

padding:40px;

border-radius:25px;

box-shadow:
0 20px 40px
rgba(
0,
0,
0,
.25
);

animation:fadeIn .6s ease;

position:relative;

}

/* LOGO */

.login-logo{

display:flex;

justify-content:center;

margin-bottom:20px;

}

.login-logo img{

width:80px;

height:80px;

object-fit:contain;

}

/* TITLE */

.login h2{

text-align:center;

margin-bottom:10px;

color:#0f172a;

font-size:30px;

}

.login p{

text-align:center;

color:#64748b;

margin-bottom:30px;

font-size:14px;

}

/* FORM */

.login form{

display:flex;

flex-direction:column;

gap:18px;

}

/* INPUT */

.login input{

padding:14px 16px;

border:1px solid #cbd5e1;

border-radius:12px;

font-size:15px;

outline:none;

transition:.3s;

background:#f8fafc;

}

.login input:focus{

border-color:#2563eb;

background:white;

box-shadow:
0 0 0 4px
rgba(
37,
99,
235,
.15
);

}

/* BUTTON */

.login button{

padding:14px;

border:none;

border-radius:12px;

background:#2563eb;

color:white;

font-size:16px;

font-weight:600;

cursor:pointer;

transition:.3s;

}

.login button:hover{

background:#1d4ed8;

transform:translateY(-2px);

box-shadow:
0 10px 20px
rgba(
37,
99,
235,
.3
);

}

/* FOOTER */

.login-footer{

margin-top:25px;

text-align:center;

font-size:13px;

color:#64748b;

}

/* POPUP ALERT */

.popup{

position:fixed;

top:30px;

right:30px;

background:#dc2626;

color:white;

padding:15px 20px;

border-radius:12px;

box-shadow:
0 10px 25px
rgba(
0,
0,
0,
.2
);

font-weight:600;

z-index:9999;

animation:slideIn .4s ease;

}

/* ANIMATION */

@keyframes fadeIn{

from{

opacity:0;

transform:translateY(20px);

}

to{

opacity:1;

transform:translateY(0);

}

}

@keyframes slideIn{

from{

opacity:0;

transform:translateX(100px);

}

to{

opacity:1;

transform:translateX(0);

}

}

/* MOBILE */

@media(max-width:500px){

.login{

margin:20px;

padding:30px 25px;

}

.login h2{

font-size:25px;

}

.popup{

left:20px;

right:20px;

top:20px;

text-align:center;

}

}

</style>

</head>

<body>

<?php if($error!=""){ ?>

<div class="popup" id="popup">

    <?= $error ?>

</div>

<?php } ?>

<div class="login">

    <div class="login-logo">

        <img src="yama.png" alt="logo">

    </div>

    <h2>

        YAKAP LOGIN

    </h2>

    <p>

        Mutual Care Agreement System

    </p>

    <form
    action="authenticate.php"
    method="POST">

        <input
        type="text"
        name="username"
        placeholder="Enter Username"
        required>

        <input
        type="password"
        name="password"
        placeholder="Enter Password"
        required>

        <button type="submit">

            LOGIN

        </button>

    </form>

    <div class="login-footer">

        Developed by
        <strong>
            Joehaness John S. Ramos
        </strong>

    </div>

</div>

<script>

setTimeout(function(){

    let popup =
    document.getElementById("popup");

    if(popup){

        popup.style.display = "none";

    }

}, 3000);

</script>

</body>

</html>