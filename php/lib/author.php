<?php
require_once(dirname(__DIR__, 1) . "/Classes/Author.php");
//require_once(dirname(__DIR__) . "/Classes/autoload.php");

use DylanSmithcg\ObjectOriented\{Author};


function bar() {

	$authorId = "438f9fe1-7aa6-40bf-9c3c-7299d6a74ff3";
	$authorActivationToken = "438f9fe17aa640bf9c3c7299d6a74ff3";
	$authorAvatarUrl = "link.png";
	$authorEmail = "email@gmail.com";
	$authorHash = "stuff";
	$authorUsername = "something";
	echo "$authorEmail $authorActivationToken authorHash";

	$author = new Author($authorId, $authorActivationToken, $authorAvatarUrl, $authorEmail, $authorHash, $authorUsername);
	$author->update();
	echo var_dump($author);
	//echo getAuthorUsername();

	echo 'i work';
}
bar();