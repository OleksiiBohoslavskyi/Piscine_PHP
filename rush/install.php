<?php
	$h1 = "fail";
	require_once "create_databese.php";
	session_start();
	$link = mysqli_connect("localhost", "root", "123456");
	if (!$link) {
		$h1 = "Fail";
		die("Connection failed: " . mysqli_connect_error());
	}

	mysqli_query($link, "CREATE DATABASE IF NOT EXISTS Julizon");
	$link = mysqli_connect("localhost", "root", "123456", "Julizon");
	// mysql_query($link, "DROP TABLE IF EXISTS *");
	mysqli_query($link, SQL_DROP_TABLE);
	session_unset();
	mysqli_query($link, SQL_CREATE_TABLE_USER);
	mysqli_query($link, SQL_CREATE_TABLE_PRODUCTS);
    mysqli_query($link, SQL_PRS);
	
	$res = mysqli_query($link, SQL_SELECT_USER);
	if (mysqli_num_rows($res) === 0) {
	$h1 = "Success";

		$passwd = hash('whirlpool' ,"admin");
		mysqli_query($link, "INSERT INTO user (login, password, root) VALUES ('admin', '$passwd', 1)");
		mysqli_query($link, "INSERT INTO products (`name`, `description`, `categories`, `img`, `price` , `size`, `quantity`) VALUES
		    ('Sport SMPL', 'Мягкая эластичная ткань Трусики-хипстеры Посадка на бедрах Состав: 95% хлопок, 5% эластан Уход: стирка в деликатном режиме при температуре в 30°', 'underwear','http://trendon.com.ua/files/goods/h-w-02-olivka-2.jpg', 300, 40, 5),
		    ('SMPL', 'Легкий дышащий материал Трусики-танго Черный ободок Состав: 95% хлопок, 5% эластан Уход: стирка в деликатном режиме при температуре в 30°', 'underwear','http://trendon.com.ua/files/goods/tg-w-01-blakitni.jpg', 290, 40, 40),
		    ('Alboa Sammy Icon', 'Состав: 80% хлопок, 17% полиамид, 3% эластан', 'socks','http://trendon.com.ua/files/goods/alboa-440x440.jpg', 40, 36, 32),
		    ('Silvester Sammy Icon', 'огонек', 'socks','http://trendon.com.ua/files/goods/silvester-440x440.png', 85, 36, 10),
		    ('Боди SHA Odessa', 'Материал средней плотности Облегающий по фигуре Круглый вырез Длинный узкий рукав Состав: 75% вискоза, 25% полиэстер  Уход: стирка в деликатном режиме при температуре в 30°С', 'underwear','http://trendon.com.ua/files/goods/bodi-korichnevyy-1-16-04823.png', 470, 36, 8),
		    ('Vanille Reine Rouge', 'Легкий дышащий материал На тонких бретельках Отделка кружевом Завышенная талия Пояс на резинке Состав: 97% шёлк, 3% эластан Уход: Ручная стирка ', 'underwear','http://trendon.com.ua/files/goods/rr170028-2.jpg', 1200, 36, 10),
		    ('Namito Sammy Icon', 'На большинство индейских паттернв Семми вдохновил визит в племя Хиваро. Став известным на весь мир, Семми не только не забыл про них, а и решил отблагодарить, посвятив им носки. Состав: 80% хлопок, 17% полиамид, 3% эластан', 'socks','http://trendon.com.ua/files/goods/namito.jpg', 85, 36, 5),
		    ('Wapi Sammy Icon', 'На большинство индейских паттернв Семми вдохновил визит в племя Хиваро. Став известным на весь мир, Семми не только не забыл про них, а и решил отблагодарить, посвятив им носки. Состав: 80% хлопок, 17% полиамид, 3% эластан', 'socks','http://trendon.com.ua/files/goods/wapi.jpg', 85, 36, 5),
		    ('Marty Sammy Icon', 'На рынке города Марракеш Сэмми наконец нашел качественную черную краску. Состав: 80% хлопок, 17% полиамид, 3% эластан', 'socks','http://trendon.com.ua/files/goods/marty1-440x440.png', 85, 36, 5),
		    ('Trinidad Sammy Icon', 'Состав: 80% хлопок, 17% полиамид, 3% эластан', 'socks','http://trendon.com.ua/files/goods/trinidad-440x440.png', 85, 36, 5),
		    ('Боди Grishko Design', 'На рынке города Марракеш Сэмми наконец нашел качественную черную краску. Состав: 80% хлопок, 17% полиамид, 3% эластан', 'underwear','http://trendon.com.ua/files/goods/dsc-6442-copy.jpg', 760, 36, 5),
		    ('BERG UNDIE', 'Мягкий трикотаж Лиф топом Трусики-бикини На широкой резинке Состав: 95% хлопок, 5% эластан', 'underwear','http://trendon.com.ua/files/goods/berg-undie.jpg', 400, 40, 0)");
		    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>strart page</title>
	<link type="text/css" href="style/custom.css"/>
</head>
<body>
	<h1><?php echo "$h1"; ?></h1>
	<?php if ($h1 == 'Success') : ?>
		<a href="index.php">Home</a>
	<?php endif ?>
</body>
</html>
