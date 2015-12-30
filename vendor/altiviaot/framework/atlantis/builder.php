<?php
	/**
	  Builder Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	// namespace altiviaot\atlantis;

	if(!class_exists('Builder'))
	{
		class Builder
		{
			protected $conn;
			protected $table;
			protected $sql;
			protected $querys;

			public function __construct($__table, $__callback){
				$this->conn 	= SPDO::init();
				$this->table 	= htmlentities($__table);
				$this->querys 	= array();
			}

			private function addSQL($__sql)
			{
				$this->sql = $__sql;
				array_push($this->querys, $__sql);
				return $this;
			}

			public function _addTable($tableName){
				// Almacenando el query para crear tablas
				return $this->addSQL("CREATE TABLE $tableName ( id INT NOT NULL PRIMARY KEY AUTO_INCREMENT );");
			}

			public function createTable()
			{
				// Creando la tabla
				return $this->_addTable($this->table);
			}

			public function getTable($tableName)
			{
				// Obteniendo el schema u objeto de la tabla
				return true;
			}

			public function dropTable()
			{
				// Drop Table
				return $this->addSQL("DROP TABLE $this->table");
			}

			public function increments($column, $autoIncrement = false)
			{
				$this->integer($column, $autoIncrement, true);
			}

			public function integer($column, $autoIncrement = false, $unsigned = false)
			{
				return $this->addSQL("ALTER TABLE $this->table ADD $column INT ".(($unsigned) ? 'UNSIGNED ' : null)."NOT NULL".(($autoIncrement) ? ' AUTO_INCREMENT' : null)."; ");
			}

			public function string($column, $length = 255)
			{
				return $this->addSQL("ALTER TABLE $this->table ADD $column VARCHAR( $length ); ");
			}

			public function text($column, $length = 255)
			{
				// Almacenando el query para crear tablas
				return $this->addSQL("ALTER TABLE $this->table ADD $column text; ");
			}

			public function renameTable($oldTableName, $newTableName)
			{
				// Rename Table
				return $this->addSQL("RENAME TABLE $oldTableName TO $newTableName;");
			}

			public function renameColumn($oldColumnName, $newColumnName)
			{
				// Rename Column
				return $this->addSQL("ALTER TABLE $this->table CHANGE $oldColumnName $newColumnName INT;");
			}

			public function decimal($column, $total, $decimal)
			{
				return $this->addSQL("ALTER TABLE $this->table ADD $column decimal($total, $decimal); ");
			}

			public function double($column, $total, $decimal)
			{
				return $this->addSQL("ALTER TABLE $this->table ADD $column decimal($total, $decimal); ");
			}

			public function float($column, $total, $decimal)
			{
				return $this->addSQL("ALTER TABLE $this->table ADD $column float($total, $decimal); ");
			}

			public function boolean($column)
			{
				return self::addSQL("ALTER TABLE $this->table ADD $column boolean; ");
			}

			public function enum($column)
			{
				return $this->addSQL("ALTER TABLE $this->table ADD $column ENUM(''); ");
			}

			public function date($column)
			{
				return $this->addSQL("ALTER TABLE $this->table ADD $column date; ");
			}

			public function datetime($column)
			{
				return $this->addSQL("ALTER TABLE $this->table ADD $column datetime; ");
			}

			public function time($column)
			{
				return $this->addSQL("ALTER TABLE $this->table ADD $column time; ");
			}

			public function timestamp($column)
			{
				return $this->addSQL("ALTER TABLE $this->table ADD $column timestamp; ");
			}

			public function timestamps()
			{
				$this->addSQL("ALTER TABLE $this->table ADD created_at timestamp; ");
				return $this->addSQL("ALTER TABLE $this->table ADD updated_at timestamp; ");
			}

			public function foreign($column)
			{
				$this->sql = "ALTER TABLE $this->table ADD CONSTRAINT foreingkey_$column FOREIGN KEY ($columns) REFERENCES :foreignTable (:foreignColumn) ";
				return $this;
			}

			public function foreignDrop($column)
			{
				return $this->indexDrop($column);
			}

			public function reference($foreignColumn)
			{
				$this->sql = str_replace(':foreignColumn', $foreignColumn, $this->sql);
				return $this;
			}

			public function on($foreignTable)
			{
				return $this->addSQL(str_replace(':foreignTable', $foreignTable, $this->sql));
			}

			public function primary($column)
			{
				return $this->addSQL("ALTER TABLE $this->table ADD CONSTRAINT pk_$column PRIMARY KEY ($column);");
			}

			public function primaryDrop()
			{
				return $this->addSQL("ALTER TABLE $this->table DROP PRIMARY KEY;");
			}

			public function unique($column)
			{
				return $this->addSQL("ALTER TABLE $this->table ADD UNIQUE ($column);");
			}

			public function uniqueDrop($column)
			{
				return $this->indexDrop($column);
			}

			public function index($column)
			{
				return $this->addSQL("ALTER TABLE $this->table ADD INDEX ($column);");
			}

			public function indexDrop($column)
			{
				return $this->addSQL("ALTER TABLE $this->table DROP INDEX ($column);");
			}

			public function nullable()
			{
				return true;
			}

			public function tableExists($table)
			{
				$r = $this->conn->query("DESC $table;");
				return $r->fetchAll() > 0;
			}

			public function columnExists($table, $column)
			{
				$r = $this->conn->query("SELECT $column FROM $table;");
				return $r->fetchAll() > 0;
			}

			public function build(){
				// Accediendo a la base de datos y ejecutando los query de la migracion
				try {
					foreach ($this->querys as $key => $sql) {
						$this->conn->query($sql);
					}
				} catch (Exception $e) {
					die('Error: '.$e->getMessage());
				}

				return true;
			}
		}
	}