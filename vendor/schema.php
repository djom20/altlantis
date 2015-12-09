<?php

	/**
	  Schema Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	if(!class_exists('Schema'))
	{
		class Schema
		{
			public static function create($table, $callback){
				$builder = $this->createBuilder($table);
				$builder->createTable();
				$callback($builder);
				$this->build($builder);
				return true;
			}

			public static function drop($table, $callback){
				$builder = $this->createBuilder($table);
				$builder->dropTable();
				$callback($builder);
				$this->build($builder);
				return true;
			}

			public static function dropIfExists($table, $callback){
				if($this->hasTable($table)){
					$builder = $this->createBuilder($table);
					$builder->createDrop();
					$callback($builder);
					$this->build($builder);
					return true;
				}

				return false;
			}

			public static function table($table, $callback){
				$this->build($this->createBuilder($table, $callback));
				return true;
			}

			public static function hasTable($table){
				$builder = $this->createBuilder($table);
				return $builder->tableExists();
			}

			public static function hasColumn($table, $column){
				if($this->hasTable($table)){
					$builder = $this->createBuilder($table);
					return $builder->columnExists($table, $column);
				}
				return false;
			}

			protected function createBuilder($table, $callback = null)
			{
				return new Builder($table, $callback);
			}

			protected function build(Builder $builder)
			{
				$builder->build();
				return true;
			}
		}
	}