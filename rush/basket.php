<?php 
    require_once "create_databese.php";
    $res;
    session_start();
    if (!isset($_SESSION['user']))
        {
            header("Location: ./login.php");
        }
    $link = mysqli_connect("localhost", "root", "123456", "Julizon");
    $product = mysqli_query($link, SQL_SELECT_PRODUCTS);
    $total = 0;
    if ($_SESSION[arr_data]) {
        
        $busket = $_SESSION[arr_data];
        if ($_GET[BUY] === 'BUY') {
            $count = count($busket);
            while ($count-- != 0) {
                mysqli_query($link, "INSERT INTO prs (id_item, quantity) VALUES (".$busket[$count][0].", ".$busket[$count][0].")");
            }
            unset($_SESSION[arr_data]);
            $busket = $_SESSION[arr_data];
        }
        
    }
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <title>Beauty Salon</title>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
     <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Krona+One" rel="stylesheet">
     <link rel="stylesheet" href="css/style.css">
     <style>
         .basket-flex-container {
             display: -webkit-box;
             display: -moz-box;
             display: -ms-flexbox;
             display: -webkit-flex;
             display: flex;
             -webkit-flex-flow: row wrap;
             justify-content: space-around;
             width: 100%;
             position: relative;
         }
         li.busket-item {
             display: flex;
             flex-direction: row;
             width: 100%;
             justify-content: space-between;
             border: 1px solid lightgrey;
             padding: 10px;
             align-items: center;
         }
         .busket-img {
             width: 220px;
             height: 160px;
         }
         h3.busket-news_h2.black {
             width: 30%;
         }
     </style>
 </head>
 <body>
    <?php  if ($_GET[submit] === "OK") : ?>
        <h1>Product was addit</h1>
    <?php endif ?>
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
 <div class="product">
     <div class="container">
         <div class="row">
            <div class="card">
               <ul class="basket-flex-container">
                <?php if ($_SESSION[arr_data]) : ?>
                       <?php 
                           $count = count($busket);
                           echo "$count";
                           while ($count-- != 0) : ?>
                           <?php 
                               $query = "SELECT * FROM `products` where id='".$busket[$count][0]."'";
                               $product = mysqli_query($link, $query);
                               $row = mysqli_fetch_assoc($product);
                               $total += $busket[$count][1] * $row['price'];
                            ?>
                               <li class="busket-item">
                                   <div class="busket-img" style="background: url('<?php echo $row[img]; ?>') no-repeat center; background-size: cover;"></div>
                                   <h3 class="busket-news_h2 black"><?php echo $row['name']; ?></h3>
                                   <div class="busket-news_price"><?php echo $busket[$count][1]; ?></div>
                                   <h3 class="busket-news_price"><?php echo $row['price']; ?>$</h3>
                               </li>
                       <?php endwhile; ?>
                       <li class="busket-item">
                        <br>
                        total: <?php echo $total ?>$
                       </li>

                   <form action="basket.php">
                        <input type="submit" class="btn-basket" name="BUY" value="BUY">
                   </form>
                <?php endif ?>
                <?php if (!$_SESSION[arr_data] && !$_GET[BUY]) : ?>
                    <h1>Прости, но твоя корзина пуста</h1>
                <?php endif ?>
                <?php if ($_GET[BUY]) : ?>
                    <h1>Ваш заказ оформлен</h1>
                <?php endif ?>

               </ul>
            </div>
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
 <script src=" js/main.js"></script>
 </body>
 </html>
