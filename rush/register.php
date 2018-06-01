<h1><?php
function mySqlErr(){
        echo "Connection to database FAILED!<br />\n";
        echo mysqli_connect_error()."<br />\n";
        exit;
	}
    session_start();
    $mysql = mysqli_connect("localhost", "root", "123456", "Julizon");
    if (!$mysql)
        mySqlErr();
	if ($_GET['submit'] && $_GET['submit'] == "Signup")
	{
		if ($_GET['login'] && $_GET['passwd'] && $_GET['passwd_1'] && $_GET['phone'])
		{
			$req = mysqli_query($mysql, "SELECT * FROM user");
			if ($req === false)
				mySqlErr();
			$chk = 0;
 			do {
    			$data = mysqli_fetch_assoc($req);
       	     	if ($_GET['login'] === $data['login'])
       	     		$chk = 1;
				} while (!$chk && $data);
			if (!$chk)
			{
				if ($_GET['passwd'] == $_GET['passwd_1'] && $_GET['phone'])
				{
					$passwd = hash("whirlpool", $_GET['passwd']);
					$put_data = "INSERT INTO user (login, phone, password, root) VALUES ('".$_GET['login']."', '".$_GET['phone']."', '$passwd', 0)";

					if ($_GET['fname'])
						mysqli_query($mysql, "INSERT INTO user(fname) VALUES ('".$_GET['fname']."')");
					if ($_GET['lname'])
						mysqli_query($mysql, "INSERT INTO user(lname) VALUES ('".$_GET['lname']."')");
					if ($_GET['mail'])
						mysqli_query($mysql, "INSERT INTO user(mail) VALUES ('".$_GET['mail']."')");
					if(mysqli_query($mysql, $put_data))
					{
						$_SESSION['user'] = $_GET['login'];
						header ("Location: ./index.php");
               			exit;
					}
					else
						mySqlErr();
 				}
				else
					echo "Password mismatch! Or phone not numeric!";
			}
			else
				echo "User with login {$_GET['login']} alreqdy exist!<br />\n";
		}
		else 
			echo "Fill rows tagged with (!).";
	}
?></h1>

<!DOCTYPE html>
<html>
<head>
	<title>Registration form</title>
		<link rel="stylesheet" href=" css/slider.css">
	    <link rel="stylesheet" href=" css/style.css"/>
	<style>
	    .container-center {
	        display: -webkit-flex;
	        display: -moz-flex;
	        display: -ms-flex;
	        display: -o-flex;
	        display: flex;
	        width: 100%;
	        height: 70vh;
	    }
	    .block-center {
	        margin: auto;
	        background: #c72626;
	        width: 40%;
	        padding: 40px;
	        text-align: center;
	        border-radius: 5px;
	        display: flex;
	    }

	    .login-form {
	        margin: auto;
	        color: white;
	    }
	    .login-form h1 {
	        margin-bottom: 20px;
	    }

	    .login-form input {
	        background: rgba(0, 0, 0, 0.32);
	        font-size: 14px;
	        padding: 10px 21px;
	        color: white;
	        border-radius: 25px;
	        display: block;
	        margin: 5px auto;
	        width: 100%;
	    }

	    ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
	      color: white;
	    }
	</style>

</head>
<body>
	<section class="login">
	    <div class="container">
	        <div class="container-center">
	            <div class="block-center">
					 <form action="register.php" class="login-form" method="get">
					 	<h1>Please enter your data</h1>
					 	<p>	Login*:		<input type="text" name="login" value="<?=$_GET['login']?>"><br />
					 		First name:		<input type="text" name="fname" value=""><br />
					 		Last name:		<input type="text" name="lname" value=""><br />
					 		e-mail:			<input type="text" name="mail" value=""><br />
					 		Phone*:		<input type="number" name="phone" value=""><br />
					 		Password*:	<input type="password" name="passwd" value=""><br />
					 		Re-password*:	<input type="password" name="passwd_1" value=""><br />
				    	</p>
				        <input type="submit" name="submit" class="btn" value="Signup">
			        </form>
	            </div>
	        </div>
	    </div>
	</section>
</body>
</html>