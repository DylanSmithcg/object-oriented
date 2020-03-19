<?php

namespace DylanSmithcg\ObjectOriented;
require_once("autoload.php");
require_once(dirname(__DIR__) . "/vendor/autoload.php");
use Ramsey\Uuid\Uuid;


/**
 * Cross Section of a Reddit Account
 *
 * This is a Cross Section of What is Probably Stored About a Reddit User.
 *
 * Class author
 * @package DylanSmithcg\ObjectOriented
 */
class author implements \JsonSerializable {
	use ValidateDate;
	use ValidateUuid;
	/**
	 * id for this author; primary key
	 * @var Uuid $authorId
	 */
	private $authorId;
	/**
	 * token given to verify profile as valid and not bad
	 * @var $authorActivationToken
	 */
	private $authorActivationToken;
	/**
	 * cloudinary id for this author; this is a unique index
	 * @var string $authorUsername
	 */
	private $authorAvatarUrl;
	/**
	 * email for this author; this is a unique index
	 * @var  String $authorEmail
	 */
	private $authorEmail;
	/**
	 * hash for author password
	 * @var $authorHash
	 */
	private $authorHash;
	/**
	 * username for this author; this is a unique index
	 * @var string $authorUsername
	 */
	private $authorUsername;

	/**
	 * author constructor.
	 *
	 * @param string|Uuid $newAuthorId id of this author or null if a new author
	 * @param string $newAuthorActivationToken Token to protect agaisnt bad accounts
	 * @param string $newAuthorAvatarUrl string containing newAuthorUsername can be null
	 * @param string $newAuthorEmail string containing email
	 * @param string $newAuthorHash string containg password hash
	 * @param string $newAuthorUsername string containing newAuthorUsername
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if a data type violates a data hint
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 */
	public function __construct($newAuthorId, $newAuthorActivationToken, $newAuthorAvatarUrl, $newAuthorEmail, $newAuthorHash, $newAuthorUsername) {
		try {
					$this->
		}

}
