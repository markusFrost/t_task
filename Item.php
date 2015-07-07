<?php
require_once('BaseEntity.php');

class Item extends BaseEntity
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
			
			//print_r($result->calc_result);
			
			return $result;
		}
	}