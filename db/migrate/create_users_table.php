<?php
	class CreateUsersTable extends Migrator
	{
		/**
		* Run the migrations.
		*
		* @return void
		*/
		public function up()
		{
			Schema::create('users', function ($table) {
				$table->increments('id');
				$table->string('name')->nullable();
				$table->timestamps();
			});
		}

		/**
		* Reverse the migrations.
		*
		* @return void
		*/
		public function down()
		{
			Schema::drop('users');
		}
	}