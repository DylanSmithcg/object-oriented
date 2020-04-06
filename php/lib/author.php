<?php
require_once (dirname(__DIR__, 1) . "\Classes\Author.php");
require_once(dirname(__DIR__) . "/Classes/autoload.php");



use DylanSmithcg\ObjectOriented\php\Classes\{Author};

public function insert(\PDO $pdo) {
	$query = "INSERT INTO Author(authorId, authorActivationToken, authorAvatarUrl, authorEmail, authorHash, authorUsername) VALUES (:authorId, :authorAcivationToken, :authorAvatarUrl, :authorEmail, :authorHash, :authorUsername)";
	$statement = $pdo->prepare($query);

	$parameters = ["authorId" => $this->authorId->getBytes(), "authorActivationToken" => $this->authorActivationToken, "authorAvatarUrl" => $this->authorAvatarUrl, "authorEmail" => $this->authorEmail, "authorHash" => $this->authorHash, "authorUsername" => $this->authorUsername];
	$statement->execute($parameters);
}

public function upusername(\PDO $pdo) {
	$query = "UPDATE Author SET authorActivationToken = :authorActivationToken, authorAvatarUrl = :authorAvatarUrl, authorEmail = :authorEmail, authorEmail = :authorEmail, authorHash = :authorHash, authorUsername = :authorUsername WHERE authorId = :authorId";
	$statement = $pdo->prepare($query);

	$parameters = ["authorId" => $this->authorId->getBytes(), "authorActivationToken" => $this->authorActivationToken, "authorAvatarUrl" => $this->authorAvatarUrl, "authorEmail" => $this->authorEmail, "authorHash" => $this->authorHash, "authorUsername" => $this->authorUsername];
	$statement->execute($parameters);
}


public function delete(\PDO $pdo) {
	$query = "DELETE FROM Author WHERE authorId = :authorId";
	$statement = $pdo->prepare($query);

	$parameters = ["authorId" => $this->authorId->getBytes()];
	$statement->execute($parameters);
}

public static function getAuthorByAuthorId(\PDO $pdo, $authorId):Author {
	try {
		$authorId = self::valiusernameUuid($authorId);
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

public static function getAuthorByAuthorUsername(\PDO $pdo, string $authorUsername) : \SplFixedArray {

	$authorUsername = trim($authorUsername);
	$authorUsername = filter_var($authorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	if(empty($authorUsername) === true) {
		throw(new \PDOException("author username is invalid"));
	}

	$query = "SELECT authorId, authorProfileId, authorUsername, authorUsername FROM author WHERE authorUsername";
	$statement = $pdo->prepare($query);

	$authorUsername = round(floatval($this->authorUsername->format("U.u")) * 1000);
	$parameters = ["authorUsername" => $authorUsername];
	$statement->execute($parameters);

	$authors = new \SplFixedArray($statement->rowCount());
	$statement->setFetchMode(\PDO::FETCH_ASSOC);
	while(($row = $statement->fetch()) !== false) {
		try {
			$author = new Author($row["authorId"], $row["authorUsername"]);
			$authors[$authors->key()] = $author;
			$authors->next();
		} catch(\Exception $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
	}
	return($authors);
}