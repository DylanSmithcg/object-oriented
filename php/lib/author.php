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

public function update(\PDO $pdo) {
	$query = "UPDATE Author SET authorActivationToken = :authorActivationToken, authorAvatarUrl = :authorAvatarUrl, authorEmail = :authorEmail, authorEmail = :authorEmail, authorHash = :authorHash, authorUsername = :authorUsername WHERE authorId = :authorId";
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

public static function getAuthorByAuthorId(\PDO $pdo, $authorId):Author {
	try {
		$authorId = self::validateUuid($authorId);
	} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		throw(new \PDOException($exception->getMessage(), 0, $exception));
	}
	
	$query = "SELECT authorId, authorActivationToken, authorAvatarUrl, authorEmail, authorHash, authorUsername FROM author WHERE authorId = :authorId";
	$statement = $pdo->prepare($query);
	
	$parameters = ["authorId" => $authorId->getBytes()];
	$statement->execute($parameters);
	
	try {
		$author = null;
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		$row = $statement->fetch();
		if($row !== false) {

			$author = new Author($row["authorId"], $row["authorActivationToken"], $row["authorAvatarUrl"],$row["authorEmail"], $row["authorHash"], $row["authorUsername"]);
		}
	} catch(\Exception $exception) {
		throw(new \PDOException($exception->getMessage(), 0, $exception));
	}
	return ($author);
}

