<?php

	/**
	  Schema Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	// namespace altiviaot\atlantis;

	if(!class_exists('Schema'))
	{
		class Schema
		{

			/**
			 * Create a new table on the schema.
			 *
			 * @param  string   $table
			 * @param  callback  $callback
			 * @return bool
			 */
			public function create($table, $callback){
				$builder = self::createBuilder($table);
				$builder->createTable();
				$callback($builder);
				self::build($builder);
				return true;
			}

			/**
			 * Drop a table from the schema.
			 *
			 * @param  string  $table
			 * @return bool
			 */
			public function drop($table){
				$builder = self::createBuilder($table);
				$builder->dropTable();
				self::build($builder);
				return true;
			}

			/**
			 * Drop a table from the schema if it exists.
			 *
			 * @param  string  $table
			 * @return bool
			 */
			public function dropIfExists($table, $callback){
				if(self::hasTable($table)){
					$builder = self::createBuilder($table);
					$builder->createDrop();
					$callback($builder);
					self::build($builder);
					return true;
				}

				return false;
			}

			/**
			 * Modify a table on the schema.
			 *
			 * @param  string   $table
			 * @param  callback  $callback
			 * @return bool
			 */
			public function table($table, $callback){
				self::build(self::createBuilder($table, $callback));
				return true;
			}

			/**
			 * Determine if the given table exists.
			 *
			 * @param  string  $table
			 * @return bool
			 */
			public function hasTable($table){
				$builder = self::createBuilder($table);
				return $builder->tableExists();
			}

			/**
			 * Determine if the given table has a given column.
			 *
			 * @param  string  $table
			 * @param  string  $column
			 * @return bool
			 */
			public function hasColumn($table, $column){
				if(self::hasTable($table)){
					$builder = self::createBuilder($table);
					return $builder->columnExists($table, $column);
				}
				return false;
			}

			/**
			 * Create a new command set with a Builder.
			 *
			 * @param  string   $table
			 * @param  callback  $callback
			 * @return Builder
			 */
			protected function createBuilder($table, $callback = null)
			{
				return new Builder($table, $callback);
			}

			/**
			 * Execute the Builder to build / modify the table.
			 *
			 * @param  Builder  $Builder
			 * @return bool
			 */
			protected function build(Builder $builder)
			{
				$builder->build();
				return true;
			}
		}
	}