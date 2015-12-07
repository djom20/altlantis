<?php
	/**
	  User Model
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	class User extends ModelBase {

		protected $id 	 = 'users';
		protected $table = 'users';
		const CREATED_AT = 'created_at';
		const UPDATED_AT = 'updated_at';
		const DELETED_AT = 'deleted_at';

		public function __construct()
		{
			// return $this->select()->lastID();
		}

		public function getCurrent($__id)
		{
			return $this->current($_id);
		}
	}