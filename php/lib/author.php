<?php
require_once (dirname(__DIR__, 1) . "\Classes\Author.php");
require_once(dirname(__DIR__) . "/Classes/autoload.php");



use DylanSmithcg\ObjectOriented\{author};



	public function bar() {

	$authorId = "uuid4";
	$authorActivationToken = "numbers";
	$authorAvatarUrl = "link.png";
	$authorEmail = "email@gmail.com";
	$authorHash = "stuff";
	$authorUsername = "something";
	echo "$authorEmail $authorActivationToken authorHash";

	$author = new author(authorId, $authorActivationToken, $authorAvatarUrl, authorEmail, author, $authorUsername);
	echo var_dump($author);
	echo getAuthorUsername();

	echo 'i work';
}