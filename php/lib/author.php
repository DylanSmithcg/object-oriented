<?php
require_once(dirname(__DIR__, 1) . "/Classes/Author.php");
require_once(dirname(__DIR__) . "/Classes/autoload.php");

use DylanSmithcg\ObjectOriented\{Author};


function bar() {

	$authorId = "uuid4";
	$authorActivationToken = "numbers";
	$authorAvatarUrl = "link.png";
	$authorEmail = "email@gmail.com";
	$authorHash = "stuff";
	$authorUsername = "something";
	echo "$authorEmail $authorActivationToken authorHash";

	$author = new Author($authorId, $authorActivationToken, $authorAvatarUrl, $authorEmail, $authorHash, $authorUsername);
	echo var_dump($author);
	//echo getAuthorUsername();

	echo 'i work';
}
bar();