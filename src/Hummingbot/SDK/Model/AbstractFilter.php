<?php

namespace Hummingbot\SDK\Model;

abstract class AbstractFilter
{
	public $container = [];

    public function filter($condition)
    {
		$items = array();

		foreach($this->container as $item)
		{
			$find = 1;
			foreach($condition as $key => $value)
			{
				if(is_array($value)
					&& isset($value[0]) 
					&& in_array($value[0], ['==', '!=', '>', '<', '>=', '<=', 'LIKE', 'NOT LIKE' ])) {						
					switch($value[0]) {
						case '==':
							$find = $find && isset($item[$key]) && $value[1] == $item[$key];
							break;
						case '!=':
							$find = $find && isset($item[$key]) && $value[1] != $item[$key];
							break;
						case '>':
							$find = $find && isset($item[$key]) && is_numeric($item[$key]) && is_numeric($value[1]) && $item[$key] > $value[1];
							break;
						case '<':
							$find = $find && isset($item[$key]) && is_numeric($item[$key]) && is_numeric($value[1]) && $item[$key] < $value[1];
							break;
						case '>=':
							$find = $find && isset($item[$key]) && is_numeric($item[$key]) && is_numeric($value[1]) && $item[$key] >= $value[1];
							break;
						case '<=':
							$find = $find && isset($item[$key]) && is_numeric($item[$key]) && is_numeric($value[1]) && $item[$key] <= $value[1];
							break;
						case 'LIKE':
							$pattern = str_replace('%', '.*', preg_quote($value[1], '/'));
							$find = $find && isset($item[$key]) && (bool) preg_match("/^{$pattern}$/i", $item[$key]);							
							break;
						case 'NOT LIKE':
							$pattern = str_replace('%', '.*', preg_quote($value[1], '/'));
							$find = $find && isset($item[$key]) && !(bool) preg_match("/^{$pattern}$/i", $item[$key]);	
							break;
					}					
				} else {
					$find = $find && isset($item[$key]) && $item[$key] == $value;

				}
			}
			if($find)
			{
				array_push($items, $item);
			}
		}
		return $items;
    }
}
