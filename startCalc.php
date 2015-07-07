<?php
	require_once('Item.php');
        require_once('DbHelper.php');
        require_once('Result.php');
	/*class BaseEntity
	{
		public $id;
	}*/
	
	/*class Item extends BaseEntity
	{
		public $name;
		public $calc_content;
		
		public function getCodes()
		{
			$result = new Result();
			$result-> name = $this->name;
			$result-> calc_content = $this->calc_content;
			$result->calc_result = array();
			
			
			$position = 0;
			$startSearchCode = false;
			$failSearchCode = false;
			$result_value = "";
			
			while ( $position < strlen($result-> calc_content))
			{
				$ch =  substr($result-> calc_content, $position, 1);
				$position++;
				//echo $ch.""."</br>";
				
				 if ( strcmp($ch, "{") == 0)
					{
						$startSearchCode = true;
						$failSearchCode = false;
						$result_value = "";
						//echo "startSearch".""."</br>";
					}
				 else if ( strcmp($ch, "}") == 0)
					{
						$startSearchCode = false;
						$failSearchCode = false;
						if ( strcmp($result_value, "") != 0) // if was found any result
						{
							$numb = intval($result_value);
							array_push($result->calc_result, $numb);						
							$result_value = "";							
						}
						//echo "endSearch".""."</br>";
					}
				else if ( $startSearchCode && !$failSearchCode) // if it is time to search code and until was not errors in search
					{
					    if ( 
						      is_numeric($ch) || 
							  ( strcmp($ch, "+") == 0 && strlen($result_value) == 0) ||
						      ( strcmp($ch, "-") == 0 && strlen($result_value) == 0) 
						 ) // if symbol is number or symbol is + or - -> it means it is first symbol after "{"
						{
							$result_value = $result_value.$ch."";
							//echo $result_value.""."</br>";
						}
						else
						{
							$failSearchCode = true; // we do not need search next numbers 
							$result_value = "";
						}
					}
				//echo $position."_";
			}
			
			print_r($result->calc_result);
			
			return $result;
		}
	}*/
	
	/*class Result extends Item
	{
		public $calc_result;
	}*/
	
	/*class DbHelper
	{
		public $sdb_name = "localhost";
		public $user_name = "root";
		public $user_password = "";
		public $db_name = "db_task";
		
		// table names
		public $tableCalculations = "table_calculations";
		public $tableCodes = "table_codes";
		
		// table fields
		public $id = "_id";
		public $calc_id = "calc_id";
		public $name = "name";
		public $content = "content";
		public $code = "code";
		
		public function __construct()
		{
			// connection and initialization
			$link = mysql_connect($this->sdb_name,$this->user_name,$this->user_password);
			if (!$link)
			{
				echo "<br/>�� ���� ����������� � �������� ��� ������.<br/>";
				exit();
			}
			
			if (!mysql_select_db($this->db_name,$link))
				{
					echo "<br/>I can not choose dateBase.<br/>";
					exit();
				}
				
			$query = "create table if not exists ".$this->tableCalculations." (".$this->id." INT NOT NULL AUTO_INCREMENT PRIMARY KEY, ".$this->name." varchar(80), ".$this->content." text);";
			if (!mysql_query($query,$link))
				{
					echo "<br/>�� ���� ������� �������".$this->tableCalculations."<br/>";
					echo $query."<br/>";
					exit();
				}
				
			$query = "create table if not exists ".$this->tableCodes." (".$this->id." INT NOT NULL AUTO_INCREMENT PRIMARY KEY, ".$this->calc_id." integer, ".$this->code." integer);";
			echo $query."<br/>";
			if (!mysql_query($query,$link))
				{
					echo "<br/>�� ���� ������� �������.$tableCodes.<br/>";
					echo $query."<br/>";
					exit();
				}

		}
		
		 public function __destruct()
		{
			mysql_close();
		}
		
		public function add ( $item)
		{
			$query = "Insert into "."$this->tableCalculations"." ( "."$this->name".", "."$this->content".") values ( "."'$item->name'".", "."'$item->calc_content'".")";
			
			$result = mysql_query($query);
			$res_id = mysql_insert_id();
			
			echo "</br>";
			foreach ($item->calc_result as &$value) 
			{
				$query = "Insert into "."$this->tableCodes"." ( "."$this->calc_id"." , "."$this->code".") values ( "."$res_id"." , "."$value".")";
				
				$result = mysql_query($query);
				
				if ( $result == true)
				{
				
				echo $query." - ".var_dump($result)."</br>";
				}
				else
				{
					echo $query."</br>";
					die('�������� ������: ' . mysql_error())."</br>";
				}
			}
			
			
		}
	}*/
	
	//http://localhost/Tools/phpMyAdmin/
	
	$item = new Item();
	$item->name =  $_POST['name'];
	$item->calc_content =  $_POST['calc_content'];
	
	
	
	
	
	$dbHelper = new DbHelper();
	
	$dbHelper->add($item->getCodes());
	
	/*
	   ������������ �������� ����� �������� � ������� ��������� � ������ ����
	*/
	
	
	
	/* $sdb_name = "localhost";
		 $user_name = "root";
		 $user_password = "";
		 $db_name = "db_task";
	
	$link = mysql_connect($sdb_name,$user_name,$user_password);
			if (!$link)
			{
				echo "<br/>�� ���� ����������� � �������� ��� ������.<br/>";
				exit();
			}
			
			if (!mysql_select_db($db_name,$link))
				{
					echo "<br/>I can not choose dateBase.<br/>";
					exit();
				}*/
	

	
	
	
    
	//echo "id = ".mysql_insert_id();
	/*if ($result) 
	{
		$response["success"] = 1;
		$response["message"] = "Succes";
	
		echo json_encode($response);
	} else
	{
		$response["success"] = 0;
		$response["message"] = "Oops! An error occurred.";
	
		echo json_encode($response);
	}*/
	
	


?>