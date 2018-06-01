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
    while ($row = mysqli_fetch_assoc($product)) {
    	if ($row['id'] == $_GET[id])
		    $res = $row;
    }
    if (!$_SESSION[arr_data]) {
           $_SESSION[arr_data] = array();
       }
       if ($_GET[submit] === "OK") {
           $tmp_arr = array($_GET[id_item], $_GET[quantity_item]);
           array_push($_SESSION[arr_data], $tmp_arr);
       }
       // unset($_SESSION[arr_data]);
       // var_dump($_SESSION[arr_data]);
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <title>Beauty Salon</title>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
     <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Krona+One" rel="stylesheet">
     <link rel="stylesheet" href="css/style.css">
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
                <div class="left">
                    <img src=<?php echo "$res[img]" ?> alt="">
                </div>
                <div class="right">
                    <div class="title-top">
                        <h2 class="name"><?php echo $res['name'] ?></h2>
                        <div class="price"><?php echo "$res[price]" ?>$</div>
                    </div>
                    <div class="description"><?php echo "$res[description]" ?> </div>
                    <form action="product.php?id=4>">
                        <div class="input-container">
                            <div class="">
                                <input type="text" value='<?=$_GET[id]?>' name="id" class="hidden">
                                <input type="text" value='OK' name="submit" class="hidden">
                                <input type="text" value='<?=$_GET[id]?>' name="id_item" class="hidden">
                                <br>
                                Quantity:
                                <input type="number" value='<?php print($res['quantity']); ?>' name="quantity_item" min="1" max="<?php print($res['quantity']); ?>">
                            </div>
                            <div class="size"><br>SIZE: <?php echo "$res[size]" ?></div>
                        </div>
                        <input type="submit" class="btn-basket" value="Add to basket">
                    </form>
                </div>
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