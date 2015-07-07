<?php
	require_once('Item.php');
        require_once('DbHelper.php');
        require_once('Result.php');
	 mysql_query("set names utf-8");
	
	
	
	$item = new Item();
	$item->name =   iconv('UTF-8', 'windows-1251', $_POST['name']);
	$item->calc_content =   iconv('UTF-8', 'windows-1251', $_POST['calc_content']);
	
	
	
	
	
	$dbHelper = new DbHelper();
	
	$dbHelper->add($item->getCodes());
	


?>