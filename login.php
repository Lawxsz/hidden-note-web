<!DOCTYPE html>
<html>
<head>
	<title>Login Hidden</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
@import url(http://weloveiconfonts.com/api/?family=entypo);
@import url(https://fonts.googleapis.com/css?family=Roboto);

/* zocial */
[class*="entypo-"]:before {
  font-family: 'entypo', sans-serif;
}

*,
*:before,
*:after {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box; 
}


h2 {
  color:rgba(255,255,255,.8);
  margin-left:12px;
}

body {
  background: #1A1818;
  font-family: 'Roboto', sans-serif;
  
}

form {
  position:relative;
  margin: 50px auto;
  width: 380px;
  height: auto;
}

input {
  padding: 16px;
  border-radius:7px;
  border:0px;
  background: rgba(255,255,255,.2);
  display: block;
  margin: 15px;
  width: 300px;  
  color:white;
  font-size:18px;
  height: 54px;
}

input:focus {
  outline-color: rgba(0,0,0,0);
  background: rgba(255,255,255,.95);
  color: #e74c3c;
}

button {
  float:right;
  height: 121px;
  width: 50px;
  border: 0px;
  background: #e74c3c;
  border-radius:7px;
  padding: 10px;
  color:white;
  font-size:22px;
}

.inputUserIcon {
  position:absolute;
  top:68px;
  right: 80px;
  color:white;
}

.inputPassIcon {
  position:absolute;
  top:136px;
  right: 80px;
  color:white;
}
.passxd{
    position: absolute;
}

input::-webkit-input-placeholder {
  color: white;
}

input:focus::-webkit-input-placeholder {
  color: #e74c3c;
}

	</style>
</head>

</body>
</html>

</head>
<?php
session_start();

$authorized_users = array(
    'root' => '123',
    'usuario2' => 'contraseña2',
    'usuario3' => 'contraseña3'
);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (array_key_exists($username, $authorized_users) && $authorized_users[$username] == $password) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit;
    } else {
        echo "<div class='passxd'>Username or password incorrect</div>.";
    }
}

if (!isset($_SESSION['username'])) {
    echo '
<form method="post" action="">
  <h2><span class="entypo-login"><i class="fa fa-sign-in"></i></span> Login</h2>
  <button class="submit"><span class="entypo-lock"><i class="fa fa-lock"></i></span></button>
  <span class="entypo-user inputUserIcon">
     <i class="fa fa-user"></i>
   </span>
  <input type="text" name="username" id="username" class="user" placeholder="Username"/>
  <span class="entypo-key inputPassIcon">
     <i class="fa fa-key"></i>
   </span>
  <input type="password" name="password" id="password class="pass" placeholder="Password"/>
</form>
    ';
    exit;
}
?>
