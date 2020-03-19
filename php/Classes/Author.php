<?php
namespace DylanSmithcg\ObjectOriented;

require_once("autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

class author {
	use ValidateDate;
	use ValidateUuid;

	private $authorId;
	private $authorActivationToken;
	private $authorAvatarUrl;
	private $authorEmail;
	private $authorHash;
	private $authorUsername;

	public function getAuthorId(): Uuid {
		return ($this->authorId);
	}
	public function getAuthorActivationToken(): Void {
		return $this->authorActivationToken;
	}
	public function
}

