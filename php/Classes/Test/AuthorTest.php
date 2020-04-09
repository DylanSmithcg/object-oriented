<?php
namespace DylanSmithcg\ObjectOriented\Test;

use DylanSmithcg\ObjectOriented\{Author};

//TODO remember to add hack to test class
//hack
require_once(dirname(__DIR__) . "/Test/DataDesignTest.php");

// grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

// grab the uuid generator
require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

class AuthorTest extends DataDesignTest {

	private $VALID_ACTIVATION_TOKEN;
	private $VALID_AVATAR_URL = "link.png";
	private $VALID_AUTHOR_EMAIL = "Dylansmithcg@gmail.com";
	private $VALID_AUTHOR_HASH;
	private $VALID_USERNAME = "Dsmith265";

	public function setUp() : void {
		parent::setUp();

		$password = "password";
		$this->VALID_AUTHOR_HASH = password_hash($password, PASSWORD_ARGON2I, ["time_cost" => 45]);
		$this->VALID_ACTIVATION_TOKEN = bin2hex(random_bytes (16));
	}

	public function testInsertValidAuthor() : void {

	}

	public function testUpdateValidAuthor() : void {

	}

	public function testDeleteValidAuthor() : void {

	}

	public function testGetValidAuthorByAuthorId() : void {

	}

	public function testGetValidAuthors() : void {

	}



}