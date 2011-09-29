<?php
/*
	This SQL query will create the table to store your object.

	CREATE TABLE `url` (
	`urlid` int(11) NOT NULL auto_increment,
	`originalurl` MEDIUMTEXT NOT NULL,
	`flagged` TINYINT NOT NULL, PRIMARY KEY  (`urlid`)) ENGINE=MyISAM;
*/

/**
* <b>url</b> class with integrated CRUD methods.
* @author Php Object Generator
* @version POG 3.0e / PHP5
* @copyright Free for personal & commercial use. (Offered under the BSD license)
* @link http://www.phpobjectgenerator.com/?language=php5&wrapper=pog&objectName=url&attributeList=array+%28%0A++0+%3D%3E+%27originalurl%27%2C%0A++1+%3D%3E+%27flagged%27%2C%0A%29&typeList=array+%28%0A++0+%3D%3E+%27MEDIUMTEXT%27%2C%0A++1+%3D%3E+%27TINYINT%27%2C%0A%29
*/
include_once('class.pog_base.php');
class url extends POG_Base
{
	public $urlId = '';

	/**
	 * @var MEDIUMTEXT
	 */
	public $originalurl;
	
	/**
	 * @var TINYINT
	 */
	public $flagged;
	
	public $pog_attribute_type = array(
		"urlId" => array('db_attributes' => array("NUMERIC", "INT")),
		"originalurl" => array('db_attributes' => array("TEXT", "MEDIUMTEXT")),
		"flagged" => array('db_attributes' => array("NUMERIC", "TINYINT")),
		);
	public $pog_query;
	
	
	/**
	* Getter for some private attributes
	* @return mixed $attribute
	*/
	public function __get($attribute)
	{
		if (isset($this->{"_".$attribute}))
		{
			return $this->{"_".$attribute};
		}
		else
		{
			return false;
		}
	}
	
	function url($originalurl='', $flagged='')
	{
		$this->originalurl = $originalurl;
		$this->flagged = $flagged;
	}
	
	
	/**
	* Gets object from database
	* @param integer $urlId 
	* @return object $url
	*/
	function Get($urlId)
	{
		$connection = Database::Connect();
		$this->pog_query = "select * from `url` where `urlid`='".intval($urlId)."' LIMIT 1";
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$this->urlId = $row['urlid'];
			$this->originalurl = $this->Unescape($row['originalurl']);
			$this->flagged = $this->Unescape($row['flagged']);
		}
		return $this;
	}
	
	
	/**
	* Returns a sorted array of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param string $sortBy 
	* @param boolean $ascending 
	* @param int limit 
	* @return array $urlList
	*/
	function GetList($fcv_array = array(), $sortBy='', $ascending=true, $limit='')
	{
		$connection = Database::Connect();
		$sqlLimit = ($limit != '' ? "LIMIT $limit" : '');
		$this->pog_query = "select * from `url` ";
		$urlList = Array();
		if (sizeof($fcv_array) > 0)
		{
			$this->pog_query .= " where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$this->pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) != 1)
					{
						$this->pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						if ($GLOBALS['configuration']['db_encoding'] == 1)
						{
							$value = POG_Base::IsColumn($fcv_array[$i][2]) ? "BASE64_DECODE(".$fcv_array[$i][2].")" : "'".$fcv_array[$i][2]."'";
							$this->pog_query .= "BASE64_DECODE(`".$fcv_array[$i][0]."`) ".$fcv_array[$i][1]." ".$value;
						}
						else
						{
							$value =  POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$this->Escape($fcv_array[$i][2])."'";
							$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
						}
					}
					else
					{
						$value = POG_Base::IsColumn($fcv_array[$i][2]) ? $fcv_array[$i][2] : "'".$fcv_array[$i][2]."'";
						$this->pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." ".$value;
					}
				}
			}
		}
		if ($sortBy != '')
		{
			if (isset($this->pog_attribute_type[$sortBy]['db_attributes']) && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$sortBy]['db_attributes'][0] != 'SET')
			{
				if ($GLOBALS['configuration']['db_encoding'] == 1)
				{
					$sortBy = "BASE64_DECODE($sortBy) ";
				}
				else
				{
					$sortBy = "$sortBy ";
				}
			}
			else
			{
				$sortBy = "$sortBy ";
			}
		}
		else
		{
			$sortBy = "urlid";
		}
		$this->pog_query .= " order by ".$sortBy." ".($ascending ? "asc" : "desc")." $sqlLimit";
		$thisObjectName = get_class($this);
		$cursor = Database::Reader($this->pog_query, $connection);
		while ($row = Database::Read($cursor))
		{
			$url = new $thisObjectName();
			$url->urlId = $row['urlid'];
			$url->originalurl = $this->Unescape($row['originalurl']);
			$url->flagged = $this->Unescape($row['flagged']);
			$urlList[] = $url;
		}
		return $urlList;
	}
	
	
	/**
	* Saves the object to the database
	* @return integer $urlId
	*/
	function Save()
	{
		$connection = Database::Connect();
		$this->pog_query = "select `urlid` from `url` where `urlid`='".$this->urlId."' LIMIT 1";
		$rows = Database::Query($this->pog_query, $connection);
		if ($rows > 0)
		{
			$this->pog_query = "update `url` set 
			`originalurl`='".$this->Escape($this->originalurl)."', 
			`flagged`='".$this->Escape($this->flagged)."' where `urlid`='".$this->urlId."'";
		}
		else
		{
			$this->pog_query = "insert into `url` (`originalurl`, `flagged` ) values (
			'".$this->Escape($this->originalurl)."', 
			'".$this->Escape($this->flagged)."' )";
		}
		$insertId = Database::InsertOrUpdate($this->pog_query, $connection);
		if ($this->urlId == "")
		{
			$this->urlId = $insertId;
		}
		return $this->urlId;
	}
	
	
	/**
	* Clones the object and saves it to the database
	* @return integer $urlId
	*/
	function SaveNew()
	{
		$this->urlId = '';
		return $this->Save();
	}
	
	
	/**
	* Deletes the object from the database
	* @return boolean
	*/
	function Delete()
	{
		$connection = Database::Connect();
		$this->pog_query = "delete from `url` where `urlid`='".$this->urlId."'";
		return Database::NonQuery($this->pog_query, $connection);
	}
	
	
	/**
	* Deletes a list of objects that match given conditions
	* @param multidimensional array {("field", "comparator", "value"), ("field", "comparator", "value"), ...} 
	* @param bool $deep 
	* @return 
	*/
	function DeleteList($fcv_array)
	{
		if (sizeof($fcv_array) > 0)
		{
			$connection = Database::Connect();
			$pog_query = "delete from `url` where ";
			for ($i=0, $c=sizeof($fcv_array); $i<$c; $i++)
			{
				if (sizeof($fcv_array[$i]) == 1)
				{
					$pog_query .= " ".$fcv_array[$i][0]." ";
					continue;
				}
				else
				{
					if ($i > 0 && sizeof($fcv_array[$i-1]) !== 1)
					{
						$pog_query .= " AND ";
					}
					if (isset($this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes']) && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'NUMERIC' && $this->pog_attribute_type[$fcv_array[$i][0]]['db_attributes'][0] != 'SET')
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$this->Escape($fcv_array[$i][2])."'";
					}
					else
					{
						$pog_query .= "`".$fcv_array[$i][0]."` ".$fcv_array[$i][1]." '".$fcv_array[$i][2]."'";
					}
				}
			}
			return Database::NonQuery($pog_query, $connection);
		}
	}
}
?>