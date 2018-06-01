<?php
function mySqlErr(){
        echo "Connection to database FAILED!<br />\n";
        echo mysqli_connect_error()."<br />\n";
        exit;
}
    session_start();
    $mysql = mysqli_connect("localhost", "root", "123456", "Julizon");
    if (!$mysql)
        mySqlErr();
    if (isset($_GET['submit']))
    {
        if ($_GET['submit'] == 'Signup')
            {
                    header("Location: ./register.php");
                    exit;
            }
        if ($_GET['submit'] == 'Signin' && $_GET['login'] && $_GET['passwd'])
        {

            $req = mysqli_query($mysql, "SELECT * FROM user");
            if ($req === false)
                    mySqlErr();
            do {
                $data = mysqli_fetch_assoc($req);
                    if ($_GET['login'] == $data['login'] && hash("whirlpool", $_GET['passwd']) == $data['password'])
                    {
                        $_SESSION['user'] = $data['login'];
                        header("Location: ./index.php");
                        exit;
                    }
            } while ($data);
            echo "NO SUCH USER<br />\n";
        }

    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Beauty Salon</title>
    <meta charset="UTF-8">
    <meta name="keywords"  content="">
    <meta name="description" content="">
    <meta name="author" content="dibridge.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Krona+One" rel="stylesheet">
    <link rel="stylesheet" href=" css/font/css/font-awesome.min.css">
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
            height: 70%;
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
                <form action="login.php" class="login-form" method="get">
                <h1>You must login!</h1>
                    <input type="text" name="login" placeholder="Login" id="login-input" value="">
                    <input type="password" name="passwd" placeholder="password" id="passwd" value="">
                    <input type="submit" name="submit" class="btn" value="Signin">
                    or
                    <input type="submit" name="submit" class="btn" value="Signup">
                </form>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script src=" js/owl.carousel.min.js"></script>
<script src=" js/main.js"></script>
<script>
$(document).ready(function() {
 
	$("#owl-carousel").owlCarousel({
 
		// navigation : true, // показывать кнопки next и prev 

		items : 1, 
		itemsDesktop : false,
		itemsDesktopSmall : false,
		itemsTablet: false,
		itemsMobile : false,
		animateOut: 'fadeOut',

		loop:true,
		autoplay:true,
		autoplayTimeout:8000,
		autoplayHoverPause:false,
	    smartSpeed:450
 	});
 	// $('.play').on('click',function(){
 	//     owl.trigger('play.owl.autoplay',[5000])
 	// })
 	// $('.stop').on('click',function(){
 	//     owl.trigger('stop.owl.autoplay')
 	// })
});
</script>
</body>
</html>