<?php
    session_start();
    if (!isset($_SESSION['user']))
        {
            header("Location: ./login.php");
        }
    require_once "create_databese.php";
    $link = mysqli_connect("localhost", "root", "123456", "Julizon");
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
    <style>
        .img {
            width: 100%;
            height: 400px;
        }
        .news_price {
            text-align: right;
            font-size: 22px;
            color: crimson;
            margin: 10px;
        }
        .price-text {
            display: flex;
            justify-content: space-between;
        }
    </style>
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
    <div class="container-fluid" style="position: relative;">
		<div class="item">
			<div class="slide">
                <div class="slide__img"  style="background: url('https://farm8.staticflickr.com/7325/16297072247_e61fccdea5_b.jpg') no-repeat center center; background-size: cover;"></div>
                <div class="slide__text">
                    <div class="slide__text-container slider-right">
                        <h1 class="slide__h1"><span>THE BEST SALE</span></h1>
                        <a href="product.php?id=1" class="slide__readmore">watch now</a>
                    </div>
                </div>
            </div>
		</div>
    </div>
</header>
<div class="news" id="news">
    <div class="container news-container">
        <h2 class="center title">Underwear</h2>
        <div class="row">
            <ul class="flex-container">
                    <?php 
                        $product = mysqli_query($link, SQL_SELECT_PRODUCTS); 

                        while ($row = mysqli_fetch_assoc($product)) : ?>
                        <?php if ($row['categories'] === "underwear") : ?>
                            <?php if (++$count == 4)
                                    break ;
                             ?>
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
        <h2 class="center title">Socks</h2>
        <div class="row">
            <ul class="flex-container">
                   <?php 
                      $product = mysqli_query($link, SQL_SELECT_PRODUCTS); 
                      $count = 0;
                      while ($row = mysqli_fetch_assoc($product)) : ?>
                        <?php if ($row['categories'] === "socks") : ?>
                            <?php if (++$count == 4)
                                    break ;
                             ?>
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