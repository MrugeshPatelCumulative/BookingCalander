<?php
include 'dataBase.php';

function select_all($table)
{
	$arr_results=[];
	$select_all_query = "SELECT * FROM ".$table;
	$stmt = $GLOBALS['connection']->prepare($select_all_query);
	$stmt->execute();
	$meta = $stmt->result_metadata();
    while ( $rows = $meta->fetch_field() ) {
     $parameters[] = &$row[$rows->name]; 
    }
   call_user_func_array(array($stmt, 'bind_result'), $parameters);
   while ( $stmt->fetch() ) 
   {
      $x = array();
      foreach( $row as $key => $val ) 
      { 
        $x[$key] = htmlspecialchars_decode($val);
      }
      $arr_results[] = $x;
   }
   return $arr_results; 
}
function select_where($table,$where)
{
	$arr_results=[];
	$select_query = "SELECT * FROM ".$table." WHERE ";
	if($where)
	{
		foreach ($where as $key => $value)
		{
			$select_query.= trim($key)."=?,";
		}
		$select_query=rtrim($select_query,",");
		$stmt = $GLOBALS['connection']->prepare($select_query);
		$params = "";
		foreach ($where as $key => $value)
		{
			$param="s";
			if(gettype($value)=="integer")
			{
				$param="i";
			}
			if(gettype($value)=="double")
			{
				$param="d";
			}
			$params.=$param;
		}
		$bind_names[] = $params;
		$i=0;
		foreach ($where as $key => $value)
		{
			$bind_name = 'bind' . $i;
			$$bind_name = trim($value);
			$bind_names[] = &$$bind_name;
			$i++;
		}
		$return = call_user_func_array(array($stmt,'bind_param'),$bind_names);
		if($return==1)
		{
			$stmt->execute();
			$meta = $stmt->result_metadata();
			while ( $rows = $meta->fetch_field() )
			{
				$parameters[] = &$row[$rows->name];
			}
			call_user_func_array(array($stmt, 'bind_result'), $parameters);
			while ( $stmt->fetch() )
			{
				$x = array();
				foreach( $row as $key => $val )
				{
					$x[$key] = htmlspecialchars_decode($val);
				}
				$arr_results[] = $x;
			}
			return $arr_results;
		}
	}
	return $arr_results;
}
function select_where_and($table,$where)
{
	$arr_results=[];
	$select_query = "SELECT * FROM ".$table." WHERE ";
	if($where)
	{
		foreach ($where as $key => $value) 
		{
			if(is_array($value))
			{
				foreach ($value as $colum) 
				{
					$select_query.= trim($key)." = ? AND ";
				}		
			}
			else
			{
				$select_query.= trim($key)." = ? AND ";
			}
		}
		$select_query=rtrim($select_query,"AND ");
		$stmt = $GLOBALS['connection']->prepare($select_query);
		$params = "";
		foreach ($where as $key => $value) 
		{
			$param="s";
			if(gettype($value)=="integer")
			{
				$param="i";
			}
			if(gettype($value)=="double")
			{
				$param="d";
			}
			if(is_array($value))
			{
				$param = "";
				foreach ($value as $colum) 
				{
					$param.="s";
				}		
			}
			$params.=$param;
		}
		$bind_names[] = $params;
		$i=0;
        foreach ($where as $key => $value) 
        {
        	if(is_array($value))
			{		
				foreach ($value as $colum) 
				{
					$bind_name = 'bind' . $i;
		            $$bind_name = trim($colum);
		            $bind_names[] = &$$bind_name;
		            $i++;
				}		
			}
			else
			{
	            $bind_name = 'bind' . $i;
	            $$bind_name = trim($value);
	            $bind_names[] = &$$bind_name;
	            $i++;
        	}
        }
        $return = call_user_func_array(array($stmt,'bind_param'),$bind_names);
        if($return==1)
        {
        	$stmt->execute();
        	$meta = $stmt->result_metadata();
		    while ( $rows = $meta->fetch_field() ) 
		    {
		     $parameters[] = &$row[$rows->name]; 
		    }
		   call_user_func_array(array($stmt, 'bind_result'), $parameters);
		   while ( $stmt->fetch() ) 
		   {
		      $x = array();
		      foreach( $row as $key => $val ) 
		      {
		         $x[$key] = $val;
		      }
		      $arr_results[] = $x;
		   }
		   return $arr_results;
        }
	}
	return $arr_results;
}
function db_update($table,$set,$where)
{
	$update_query = "UPDATE ".$table." SET ";
	if($set && $where)
	{ 
		$values.="?";
		foreach ($set as $key => $value) 
	    {
			$update_query.= trim($key)."=".$values.",";
		}
		$update_query=rtrim($update_query,",");
		$valuexss=[];
		foreach ($set as $key => $value) 
		{
			$value=htmlspecialchars($value,ENT_QUOTES | ENT_IGNORE,"UTF-8");
			array_push($valuexss, $value);
		}
		foreach ($set as $key => $value) 
		{
			$param="s";
			if(gettype($value)=="integer")
			{
				$param="i";
			}
			if(gettype($value)=="double")
			{
				$param="d";
			}
			if(gettype($value)=="BLOB")
			{
				$param="b";
			}	
			$params.=$param;
		}
		foreach ($where as $key => $value) 
		{
			$param="s";
			if(gettype($value)=="integer")
			{
				$param="i";
			}
			if(gettype($value)=="double")
			{
				$param="d";
			}
			if(gettype($value)=="BLOB")
			{
				$param="b";
			}	
			$params.=$param;
		}
		$bind_names[] = $params;
		$i=0;
        foreach ($valuexss as $key => $value) 
        {
            $bind_name = 'bind' . $i;
            $$bind_name = trim($value);
            $bind_names[] = &$$bind_name;
            $i++;
        }
    	$update_query.=" WHERE ";
		$values="=";
	    foreach ($where as $key => $value) 
	    {
			$update_query.= trim($key).",";
			$values.="?,";
		}
		$update_query=rtrim($update_query,",");
		$values = rtrim($values,",");
		$update_query.=$values;
        foreach ($where as $key => $value) 
        {
            $bind_name = 'bind' . $i;
            $$bind_name = trim($value);
            $bind_names[] = &$$bind_name;
            $i++;
        }
        $stmt = $GLOBALS['connection']->prepare($update_query);
      	$return = call_user_func_array(array($stmt,'bind_param'),$bind_names);
       	if($return==1)
	        {
	        	$stmt->execute();
	        	return true;	
	        }
    }
    return false;
}
function db_insert($table,$table_data)
{

	$insert_query = "INSERT INTO ".$table." (";
	if($table_data)
	{
		$values = "VALUES (";
		foreach ($table_data as $key => $value) 
		{
			$insert_query.= trim($key).",";
			$values.="?,";
		}
		$insert_query=rtrim($insert_query,",");
		$values = rtrim($values,",");
		$insert_query.=") ";
		$values.=")";
		$insert_query.=$values;
		$stmt = $GLOBALS['connection']->prepare($insert_query);
		$valuexss=[];
		foreach ($table_data as $key => $value) 
		{
			$value=htmlspecialchars($value,ENT_QUOTES | ENT_IGNORE,"UTF-8");
			array_push($valuexss, $value);
		}
		$params = "";
		foreach ($table_data as $key => $value) 
		{
			
			$param="s";
			if(gettype($value)=="integer")
			{
				$param="i";
			}
			if(gettype($value)=="double")
			{
				$param="d";
			}
			if(gettype($value)=="BLOB")
			{
				$param="b";
			}	
			$params.=$param;
		}
		$bind_names[] = $params;
		
		$i=0;
        foreach ($valuexss as $key => $value) 
        {
            $bind_name = 'bind' . $i;
            $$bind_name = trim($value);
            $bind_names[] = &$$bind_name;
            $i++;
        }
        $return = call_user_func_array(array($stmt,'bind_param'),$bind_names);
        if($return==1)
        {
        	$stmt->execute();
        	return true;	
        }
	}
	return false;
}
?>