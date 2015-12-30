<?php
	/**
		IndexControllerTest Class
	**/

	class IndexControllerTest extends \PHPUnit_Framework_TestCase
	{
		public function testArrayEmpty()
		{
			$stack = array();
			$this->assertEmpty($stack);

			return $stack;
		}
	}