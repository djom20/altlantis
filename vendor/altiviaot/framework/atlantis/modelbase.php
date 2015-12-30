<?php
	/**
	  ModelBase Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	// namespace altiviaot\atlantis;

	if(!class_exists('ModelBase'))
	{
		class ModelBase
		{
			protected $db;
			protected $table;
			protected $config;

			public function __construct($table)
			{
				$this->conn  = SPDO::init();
				$this->table = htmlentities($table);
			}

			public static function getKey()
			{
				// $result = $this->conn->prepare('SELECT id{$this->table} FROM {$this->table} WHERE {$field} = {$id};');
				// $result->execute($values);

				// return $result->fetchAll();
			}

			public function lastID()
			{
				return $this->conn->lastInsertId();
			}

			public static function query($query, $values = array())
			{
				$result = $this->conn->prepare($query);
				$result->execute($values);

				return $result->fetchAll();
			}

			public static function executeOnly($query, $values = array())
			{
				$result = $this->conn->prepare($query);
				$result->execute($values);

				return $result->rowCount();
			}

			public function select($where = array(), $last = "")
			{
				$table      = $this->table;
				$query1     = "DESC {$this->table}";
				$result1    = $this->conn->query($query1);
				$rows1      = $result1->fetchAll();
				$str1       = "";

				foreach ($rows1 as $row1) {
					if ($where[":{$row1[0]}"]) {
						$str1 .= "{$row1[0]} = :{$row1[0]} AND ";
					}
				}

				$str1       = (strlen($str1) > 0) ? substr($str1, 0, -5) : $str1;
				$query2     = "SELECT * FROM {$this->table}" . ((strlen($str1) > 0) ? " WHERE {$str1}" : "") . " $last;";
				$r    = $this->conn->prepare($query2);
				$r->execute($where);

				return $r->fetchAll();
			}

			public function count($where = array())
			{
				$table      = $this->table;
				$query1     = "DESC {$this->table}";
				$result1    = $this->conn->query($query1);
				$rows1      = $result1->fetchAll();
				$str1       = "";

				foreach ($rows1 as $row1) {
					if ($where[":{$row1[0]}"]) {
						$str1 .= "{$row1[0]} = :{$row1[0]} AND ";
					}
				}

				$str1       = (strlen($str1) > 0) ? substr($str1, 0, -5) : $str1;
				$query2     = "SELECT COUNT(*) FROM {$this->table}" . ((strlen($str1) > 0) ? " WHERE {$str1}" : "") . ";";
				$r    = $this->conn->prepare($query2);
				$r->execute($where);
				$array      = $r->fetchAll();

				return $array[0][0];
			}

			public function insert($values = array())
			{
				$table      = $this->table;
				$query1     = "DESC {$this->table}";
				$result1    = $this->conn->query($query1);
				$rows1      = $result1->fetchAll();
				$params     = array ();
				$tmp1       = "";
				$tmp2       = "";

				foreach ($rows1 as $row1) {
					if ($values[":{$row1[0]}"]) {
						$params[":{$row1[0]}"] = urldecode($values[":{$row1[0]}"]);
						$tmp1 .= "{$row1[0]}, ";
						$tmp2 .= ":{$row1[0]}, ";
					}
				}

				$str1   = (strlen($tmp1) > 0) ? substr($tmp1, 0, -2) : $tmp1;
				$str2   = (strlen($tmp2) > 0) ? substr($tmp2, 0, -2) : $tmp2;

				$query2     = "INSERT INTO {$this->table} ({$str1}) VALUES ({$str2});";
				$r    = $this->conn->prepare($query2);
				$r->execute($params);

				return $r->rowCount() > 0;
			}

			public function insertorupdate($values = array())
			{
				$table      = $this->table;
				$query1     = "DESC {$this->table}";
				$result1    = $this->conn->query($query1);
				$rows1      = $result1->fetchAll();
				$params     = array ();
				$tmp1       = "";
				$tmp2       = "";
				$tmp3       = "";

				foreach ($rows1 as $row1) {
					if (!empty($values[":{$row1[0]}"])) {
						$params[":{$row1[0]}"] = urldecode($values[":{$row1[0]}"]);
						$tmp3 .= "{$row1[0]} = :{$row1[0]}, ";
						$tmp2 .= ":{$row1[0]}, ";
						$tmp1 .= "{$row1[0]}, ";
					}
				}

				$str1 = (strlen($tmp1) > 0) ? substr($tmp1, 0, -2) : $tmp1;
				$str2 = (strlen($tmp2) > 0) ? substr($tmp2, 0, -2) : $tmp2;
				$str3 = (strlen($tmp3) > 0) ? substr($tmp3, 0, -2) : $tmp3;

				$query2     = "INSERT INTO {$this->table} ({$str1}) VALUES ({$str2}) ON DUPLICATE KEY UPDATE {$str3};";
				$r    = $this->conn->prepare($query2);
				$r->execute($params);
				return $r->rowCount() > 0;
			}

			public function update($id, $values = array())
			{
				$table      = $this->table;
				$query1     = "DESC {$this->table}";
				$result1    = $this->conn->query($query1);
				$rows1      = $result1->fetchAll();
				$params     = array ();
				$str1       = "";

				foreach ($rows1 as $row1) {
					if ($values[":{$row1[0]}"]) {
						$params[":{$row1[0]}"] = urldecode($values[":{$row1[0]}"]);
						$str1 .= "{$row1[0]} = :{$row1[0]}, ";
					}
				}

				$str1       = (strlen($str1) > 0) ? substr($str1, 0, -2) : $str1;
				$query2     = "UPDATE {$this->table} SET {$str1} WHERE id{$this->table} = {$id};";
				$r    = $this->conn->prepare($query2);
				$r->execute($params);

				return $r->fetchAll();
			}

			public function updateAtNull($id, $values = array())
			{
				$table      = $this->table;
				$query1     = "DESC {$this->table}";
				$result1    = $this->conn->query($query1);
				$rows1      = $result1->fetchAll();
				$params     = array ();
				$str1       = "";

				foreach ($rows1 as $row1) {
					if ($values[":{$row1[0]}"] == 'null') {
						$params[":{$row1[0]}"] = "NULL";
						$str1 .= "{$row1[0]} = NULL, ";
					}
				}

				$str1       = (strlen($str1) > 0) ? substr($str1, 0, -2) : $str1;
				$query2     = "UPDATE {$this->table} SET {$str1} WHERE id{$this->table} = {$id};";
				$r    = $this->conn->prepare($query2);
				$r->execute($params);

				return $r->fetchAll();
			}

			public function updateWithOutCode($id, $values = array())
			{
				$table      = $this->table;
				$query1     = "DESC {$this->table}";
				$result1    = $this->conn->query($query1);
				$rows1      = $result1->fetchAll();
				$params     = array ();
				$str1       = "";

				foreach ($rows1 as $row1) {
					if ($values[":{$row1[0]}"]) {
						$params[":{$row1[0]}"] = $values[":{$row1[0]}"];
						$str1 .= "{$row1[0]} = :{$row1[0]}, ";
					}
				}

				$str1       = (strlen($str1) > 0) ? substr($str1, 0, -2) : $str1;
				$query2     = "UPDATE {$this->table} SET {$str1} WHERE id{$this->table} = {$id};";
				$r    = $this->conn->prepare($query2);
				$r->execute($params);

				return $r->fetchAll();
			}

			public function updateWithNull($id, $values = array())
			{
				$r    		= $this->conn->query("DESC {$this->table}");
				$rows1      = $r->fetchAll();
				$params     = array();
				$str1       = "";

				foreach ($rows1 as $row1) {
					if ($values[":{$row1[0]}"] != null) {
						$params[":{$row1[0]}"] = urldecode($values[":{$row1[0]}"]);
						$str1 .= "{$row1[0]} = :{$row1[0]}, ";
					}else{
						$params[":{$row1[0]}"] = "NULL";
						$str1 .= "{$row1[0]} = NULL, ";
					}
				}

				$str1       = (strlen($str1) > 0) ? substr($str1, 0, -2) : $str1;
				$r = $this->conn->prepare("UPDATE {$this->table} SET {$str1} WHERE id{$this->table} = {$id};");
				$r->execute($params);
				return $r->fetchAll();
			}

			public function delete($id)
			{
				$r = $this->conn->query("DELETE FROM {$this->table} WHERE id = {$id};");
				return true;
			}

			public function reset()
			{
				$r = $this->conn->query("TRUNCATE TABLE {$this->table}");
				return $r->fetchAll();
			}

			public function deleteWhere($id, $field)
			{
				$r = $this->conn->query("DELETE FROM {$this->table} WHERE {$field} = {$id};");
				return $r->fetchAll();
			}

			public function max($field)
			{
				$r = $this->conn->query('SELECT max('.$field.') as max FROM '.$this->table);
				return Partial::arrayNames($r->fetchAll());
			}
		}
	}