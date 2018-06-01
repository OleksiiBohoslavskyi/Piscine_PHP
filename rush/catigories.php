<?php
    require_once "create_databese.php";
    session_start();
    if (!isset($_SESSION['user']))
        {
            header("Location: ./login.php");
        }
    $link = mysqli_connect("localhost", "root", "123456", "Julizon");
    	$catigories = $_GET[catigories];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Beauty Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Krona+One" rel="stylesheet">
	<link rel="stylesheet" href=" css/slider.css">
    <link rel="stylesheet" href=" css/style.css"/>
</head>
<body>
<header class="header" id="header">
	<div class="our-logo">
		<a href="//www.unit.ua" class="dibridge-logo"><span>di</span><span>Rush_00</span></a>
	</div>
  <nav class="nav-bar">
       <div class="container-fluid">
           <div class="row row_revers">
               <a href="index.php" class="logo go_to">Julizon</a>
               <div class="nav-ba">
                   <ul class="nav-bar">
                        <li class="nav-bar__item">Hi, <?=$_SESSION['user']?></li>
                        <li class="nav-bar__item"><a href="index.php" class=" go_to nav-bar__link">Home</a></li>
                        <li class="nav-bar__item"><a href="catigories.php?catigories=underwear" class=" go_to nav-bar__link">Underwears</a></li>
                        <li class="nav-bar__item"><a href="catigories.php?catigories=socks" class=" go_to nav-bar__link">Socks</a></li>
                        <li class="nav-bar__item"><a href="edit.php" class=" go_to nav-bar__link">Edit profile</a></li>
                       <li class="nav-bar__item"><a href="logout.php" class=" go_to nav-bar__link">Log out</a></li>
                         <li class="nav-bar__item"><a href="basket.php" class=" go_to nav-bar__link">Basket</a></li>

                   </ul>
               </div>
           </div>
       </div>
   </nav>
</header>
<div class="catigories" id="catigories">
    <div class="container catigories-container">
        <h2 class="center title">Underwear</h2>
        <div class="row">
            <ul class="flex-container">
                    <?php 
                        $product = mysqli_query($link, SQL_SELECT_PRODUCTS); 
                        while ($row = mysqli_fetch_assoc($product)) : ?>
                        <?php if ($row['categories'] === $catigories) : ?>
                            <li class="flex-item">
                                <a href="product.php?id=<?=$row['id']?>">
                                    <div class="news__link modal__link">
                                        <div class="img" style="background: url('<?php echo $row[img]; ?>') no-repeat center; background-size: cover;"></div>
                                        <div class="price-text">
                                        <h3 class="news_h2 black"><?php echo $row['name']; ?></h3>
                                        <div class="news_price"><?php echo $row['price']; ?>$</div>
                                            
                                        </div>
                                    </div>
                                    <div class="news__description"><p><?php echo $row['description']; ?></div>
                                    <a href='product.php?id=<?=$row['id']?>' class="btn news_btn">Read more</a>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endwhile; ?>
            </ul>
        </div>
    </div>
</div>
<div class="footer" id="about">
     <div class="container">
      <div class="row revers">
         <div class="col">
             <ul class="footer__anchors">
                 <li class="footer__anchors-item">
                     <a href="tel:+38 096 30 777 19" title="+38 096 30 777 19" class="foot-but">
                         <i class="fa fa-phone"></i>+38 096 30 777 19
                     </a>
                 </li>
             
                 <li class="footer__anchors-item">
                     <a href="tel:+38 044 414 21 89" title="+38 044 414 21 89" class="foot-but">
                         <i class="fa fa-phone"></i>+38 044 414 21 89
                     </a>
                 </li>
             </ul>
         </div>
         <div class="col">
             <ul class="footer__anchors">                     
                 <li class="footer__anchors-item">
                     <a href="address:г. Киев, проспект Героев Сталинграда 49" title="г. Киев, проспект Героев Сталинграда 49}" class="foot-but">
                          <i class="fa fa-map-marker"></i>
                         Kiev, st. Stalingrada 49
                     </a>
                 </li>
                 <li class="footer__anchors-item">
                     <a href="mail:salon@julizon.com" title="salon@julizon.com}" class="foot-but">
                          <i class="fa fa-envelope"></i>
                         salon@julizon.com
                     </a>
                 </li>
             </ul>
         </div>
         </div>
     </div>
 </div>
<!-- <script src=" js/main.js"></script> -->
</body>
</html>