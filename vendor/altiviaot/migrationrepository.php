<?php

	/**
	  MigrationRepository Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	if(!class_exists('MigrationRepository'))
	{
		class MigrationRepository {

			// protected $resolver;
			protected $table;
			protected $config;
			protected $model;
			protected $conn;

			/**
			 * Create a new database migration repository instance.
			 *
			 * @param  \Illuminate\Database\ConnectionResolverInterface  $resolver
			 * @return void
			 */
			public function __construct($conn, $table)
			{
				$this->table 	= htmlentities($table);
				$this->config   = Config::init();
				$this->conn 	= $conn;
			}

			/**
			 * Get the ran migrations.
			 *
			 * @return array
			 */
			public function getRan()
			{
				$a = array();
				$r = Partial::arrayNames($this->table()->select());
				foreach ($r as $key => $value) {
					$a[] = $value['migration'];
				}

				return $a;
			}

			/**
			 * Get the last migration batch.
			 *
			 * @return array
			 */
			public function getLast()
			{
				$select = array('batch' => $this->getLastBatchNumber());
				return Partial::arrayNames($this->table()->select($select, " ORDER BY migration desc"));
			}

			/**
			 * Log that a migration was run.
			 *
			 * @param  string  $file
			 * @param  int     $batch
			 * @return void
			 */
			public function log($file, $batch)
			{
				$record = Partial::prefix(array('migration' => $file, 'batch' => $batch), ':');
				$this->table()->insert($record);
			}

			/**
			 * Remove a migration from the log.
			 *
			 * @param  \StdClass  $migration
			 * @return void
			 */
			public function delete($__id)
			{
				$query = $this->table()->delete($__id);
			}

			/**
			 * Get the next migration batch number.
			 *
			 * @return int
			 */
			public function getNextBatchNumber()
			{
				return $this->getLastBatchNumber() + 1;
			}

			/**
			 * Get the last migration batch number.
			 *
			 * @return int
			 */
			public function getLastBatchNumber()
			{
				$r = $this->table()->max('batch');
				return (int) $r[0]['max'];
			}

			/**
			 * Create the migration repository data store.
			 *
			 * @return void
			 */
			public function createRepository()
			{
				//Deberia ser un new Builder
				$query = "CREATE TABLE $this->table (
					id int unsigned default null auto_increment,
					migration varchar(50) not null,
					batch int not null,
					PRIMARY KEY (id) );";

				$this->conn->query($query);
				$r = $this->conn->query("DESC $this->table");
				return $r->fetchAll() > 0;
			}

			/**
			 * Determine if the migration repository exists.
			 *
			 * @return bool
			 */
			public function repositoryExists()
			{
				$r = $this->conn->query("DESC $this->table");
				return !empty($r);
			}

			/**
			 * Get a query builder for the migration table.
			 *
			 * @return \Illuminate\Database\Query\Builder
			 */
			protected function table()
			{
				$modelName  = ucwords($this->table) . 'Model';
				$strmodel   = strtolower($this->table);
				$modelPath  = $this->config->get('modelsfolder') . $modelName . '.php';
				if (is_file($modelPath)) {
					require $modelPath;
					$modelObj = new $modelName($strmodel);
				} else {
					$result 	= $this->conn->query("SHOW TABLES;");
					$rows   	= $result->fetchAll();
					$sw     	= false;

					foreach ($rows as $row) {
						if (!$sw) {
							$sw = ($row[0] === $strmodel);
						}
					}

					if ($sw) {
						$modelObj = new ModelBase($strmodel);
					} else {
						die("<p><b>".str_replace(__DIR__.'/', '', __FILE__)."</b> at function <b>".__FUNCTION__."</b> line <b>".__LINE__."</b>: No se pudo encontrar {$modelName}.</p>");
					}
				}

				return $modelObj;
			}
		}
	}