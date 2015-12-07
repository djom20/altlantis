<?php
	class CreateUsersTable extends Migration
	{
		/**
		* Run the migrations.
		*
		* @return void
		*/
		public function up()
		{
			echo 'Up Table';
			// Schema::create('users', function (Blueprint $table) {
			// 	$table->increments('id');
			// 	$table->string('name');
			// 	$table->timestamps();
			// });
		}

		/**
		* Reverse the migrations.
		*
		* @return void
		*/
		public function down()
		{
			echo 'Down Table';
			// Schema::drop('users');
		}
	}