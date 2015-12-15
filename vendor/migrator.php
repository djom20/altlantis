<?php

	/**
	  Migrator Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	if(!class_exists('Migrator'))
	{
		class Migrator
		{
			protected $conn;
			protected $notes;
			protected $repository;
			protected $path;

			public function __construct()
			{
				$this->path 		= 'db/migrate';
				$this->notes 		= array();
				$this->conn 		= SPDO::init();
				$this->repository 	= new MigrationRepository($this->conn, 'migrations');
			}

			/**
			 * Run the outstanding migrations at a given path.
			 *
			 * @param  string  $path
			 * @param  bool    $pretend
			 * @return void
			 */
			public function run()
			{
				if(!$this->repository->repositoryExists()){
					// Si no existe la base datos
					$this->repository->createRepository();
				}
				$this->note("<info>Run migration</info>");

				// Runner a mirgation
				// require_once __DIR__.'/'.strtolower(__CLASS__).'.php';
				$this->requireFiles($this->path);
				$files 	= $this->getMigrationFiles($this->path);
				$ran 	= $this->repository->getRan();

				$migrations = array_diff($files, $ran);
				$this->runMigrationList($migrations);
			}

			/**
			 * Resolve a migration instance from a file.
			 *
			 * @param  string  $file
			 * @return object
			 */
			public function resolve($filename)
			{
				$class = $this->studly_case($filename);
				return new $class;
			}

			/**
			 * Convert a value to studly caps case.
			 *
			 * @param  string  $value
			 * @return string
			 */
			public function studly_case($filename)
			{
				$filename = ucwords(str_replace(array('-', '_'), ' ', $filename));
				return str_replace(' ', '', $filename);
			}

			/**
			 * Find path names matching a given pattern.
			 *
			 * @param  string  $pattern
			 * @param  int     $flags
			 * @return array
			 */
			public function glob($pattern, $flags = 0)
			{
				return glob($pattern, $flags);
			}

			/**
			 * Run "down" a migration instance.
			 *
			 * @param  \StdClass  $migration
			 * @param  bool  $pretend
			 * @return void
			 */
			protected function runDown($migration, $pretend)
			{
				$file = $migration->migration;

				// First we will get the file name of the migration so we can resolve out an
				// instance of the migration. Once we get an instance we can either run a
				// pretend execution of the migration or we can run the real migration.
				$instance = $this->resolve($file);

				if ($pretend)
				{
					return $this->pretendToRun($instance, 'down');
				}

				$instance->down();

				// Once we have successfully run the migration "down" we will remove it from
				// the migration repository so it will be considered to have not been run
				// by the application then will be able to fire by any later operation.
				$this->repository->delete($migration);

				$this->note("<info>Rolled back:</info> $file");
			}

			/**
			 * Rollback the last migration operation.
			 *
			 * @param  bool   $pretend
			 * @return int
			 */
			public function rollback($pretend = false)
			{
				$this->notes = array();

				// We want to pull in the last batch of migrations that ran on the previous
				// migration operation. We'll then reverse those migrations and run each
				// of them "down" to reverse the last migration "operation" which ran.
				// $migrations = $this->repository->getLast();

				// if (count($migrations) == 0)
				// {
				// 	$this->note('<info>Nothing to rollback.</info>');

				// 	return count($migrations);
				// }

				// // We need to reverse these migrations so that they are "downed" in reverse
				// // to what they run on "up". It lets us backtrack through the migrations
				// // and properly reverse the entire database schema operation that ran.
				// foreach ($migrations as $migration)
				// {
				// 	$this->runDown((object) $migration, $pretend);
				// }

				// return count($migrations);
			}

			/**
			 * Get all of the migration files in a given path.
			 *
			 * @param  string  $path
			 * @return array
			 */
			public function getMigrationFiles($path)
			{
				$files = $this->glob($path.'/*_*.php');

				// Once we have the array of files in the directory we will just remove the
				// extension and take the basename of the file which is all we need when
				// finding the migrations that haven't been run against the databases.
				if ($files === false) return array();

				$files = array_map(function($file)
				{
					return str_replace('.php', '', basename($file));

				}, $files);

				// Once we have all of the formatted file names we will sort them and since
				// they all start with a timestamp this should give us the migrations in
				// the order they were actually created by the application developers.
				sort($files);

				return $files;
			}

			/**
			 * Raise a note event for the migrator.
			 *
			 * @param  string  $message
			 * @return void
			 */
			protected function note($message)
			{
				$this->notes[] = $message;
			}

			/**
			 * Get the notes for the last operation.
			 *
			 * @return array
			 */
			public function getNotes()
			{
				return $this->notes;
			}

			private function requireFiles($path){
				$this->note("<info>Importando los archivos de migraciones</info>");
				Files::requireOnce($path);
			}

			/**
			 * Run an array of migrations.
			 *
			 * @param  array   $migrations
			 * @param  bool    $pretend
			 * @return void
			 */
			public function runMigrationList($migrations)
			{
				// First we will just make sure that there are any migrations to run. If there
				// aren't, we will just make a note of it to the developer so they're aware
				// that all of the migrations have been run against this database system.
				if (count($migrations) == 0)
				{
					$this->note('<info>Nothing to migrate.</info>');

					return;
				}

				$batch = $this->repository->getNextBatchNumber();

				// Once we have the array of migrations, we will spin through them and run the
				// migrations "up" so the changes are made to the databases. We'll then log
				// that the migration was run so we don't repeat it next time we execute.
				foreach ($migrations as $file)
				{
					$this->runUp($file, $batch);
				}
			}

			/**
			 * Run "up" a migration instance.
			 *
			 * @param  string  $file
			 * @param  int     $batch
			 * @param  bool    $pretend
			 * @return void
			 */
			protected function runUp($file, $batch)
			{
				// First we will resolve a "real" instance of the migration class from this
				// migration file name. Once we have the instances we can run the actual
				// command such as "up" or "down", or we can just simulate the action.
				$migration = $this->resolve($file); exit();

				// if ($pretend)
				// {
				// 	return $this->pretendToRun($migration, 'up');
				// }

				$migration->up();

				// Once we have run a migrations class, we will log that it was run in this
				// repository so that we don't try to run it next time we do a migration
				// in the application. A migration repository keeps the migrate order.
				$this->repository->log($file, $batch);

				$this->note("<info>Migrated:</info> $file");
			}
		}
	}