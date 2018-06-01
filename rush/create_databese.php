<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   create_databese.php                                :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: dkosolap <dkosolap@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/01/21 11:16:43 by dkosolap          #+#    #+#             */
/*   Updated: 2018/01/21 20:57:30 by dkosolap         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

session_start();

const SQL_DROP_TABLE = '
    DROP TABLE IF EXISTS `user`, `products`, `prs`
';

const SQL_CREATE_TABLE_USER = '
    CREATE TABLE IF NOT EXISTS user (
      id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
      login VARCHAR(255) NOT NULL,
      fname VARCHAR(255),
      lname VARCHAR(255),
      mail VARCHAR(255),
      phone INT UNSIGNED,
      password VARCHAR(255) NOT NULL,
      root INT(10) NOT NULL
    )
';

const SQL_CREATE_TABLE_PRODUCTS = '
	CREATE TABLE IF NOT EXISTS products (
		id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
		name VARCHAR(255) NOT NULL,
		description VARCHAR(255),
		categories VARCHAR(255) NOT NULL,
		img VARCHAR(255) NOT NULL,
		price INT(10) NOT NULL,
		size INT(10) NOT NULL,
		quantity INT(10) NOT NULL
	)
';

 const SQL_PRS = '
    CREATE TABLE IF NOT EXISTS prs (
        id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
        id_item INT(10) NOT NULL,
        quantity INT(10) NOT NULL
    )
'; 

const SQL_SELECT_PRODUCTS = '
    SELECT * FROM products ORDER BY id DESC
';

const SQL_SELECT_USER = '
    SELECT * FROM user
';
