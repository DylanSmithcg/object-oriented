<?php
require_once (dirname(__DIR__, 1) . "\Classes\Author.php");
require_once(dirname(__DIR__) . "/Classes/autoload.php");



use DylanSmithcg\ObjectOriented\php\Classes\{Auhtor};

public function insert(\PDO $pdo) {
	$query = "INSERT INTO Author(authorId, authorActivationToken, authorAvatarUrl, authorEmail, authorHash, authorUsername) VALUES (:authorId, :authorAcivationToken, :authorAvatarUrl, :authorEmail, :authorHash, :authorUsername)";
	$statement = $pdo->prepare($query);

	$parameters = ["authorId" => $this->authorId->getBytes(), "authorActivationToken" => $this->authorActivationToken, "authorAvatarUrl" => $this->authorAvatarUrl, "authorEmail" => $this->authorEmail, "authorHash" => $this->authorHash, "authorUsername" => $this->authorUsername];
	$statement->execute($parameters);
}

public function delete(\PDO $pdo) {
	$query = "DELETE FROM Author WHERE authorId = :authorId";
	$statement = $pdo->prepare($query);

	$parameters = ["authorId" => $this->auhtorId->getBytes()];
	$statement->execute($parameters);
}

public function update(\PDO $pdo) {
	$query = "UPDATE Author SET authorActivationToken = :authorActivationToken, authorAvatarUrl = :authorAvatarUrl, authorEmail = :authorEmail, profileEmail = :profileEmail, authorHash = :authorHash, authorUsername = :authorUsername WHERE authorId = :authorId";
	$statement = $pdo->prepare($query);

	$parameters = ["authorId" => $this->authorId->getBytes(), "authorActivationToken" => $this->authorActivationToken, "authorAvatarUrl" => $this->authorAvatarUrl, "authorEmail" => $this->authorEmail, "authorHash" => $this->authorHash, "authorUsername" => $this->authorUsername];
	$statement->execute($parameters);
}

