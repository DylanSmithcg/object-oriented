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
class Author implements \vendor\JsonSerializable {
	use php\Classes\ValidateUuid;
	/**
	 * id for this author; primary key
	 * @var Uuid $authorId
	 */
	private $authorId;
	/**
	 * token given to verify author as valid and not bad
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
	 * author constructor
	 *
	 * @param string|Uuid $newAuthorId id of this author or null if a new author
	 * @param string $newAuthorActivationToken Token to protect against bad accounts
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
	public function __construct($newAuthorId, string $newAuthorActivationToken, string $newAuthorAvatarUrl, string $newAuthorEmail, string $newAuthorHash, string $newAuthorUsername) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUsername($newAuthorUsername);
		}
		catch(\InvalidArgumentException \RangeException \TypeError \Exception $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * accessor method for author id
	 * @return Uuid value of author id; or null if new author
	 */
	public function getAuthorId(): Uuid {
		return ($this->authorId);
	}
	/**
	 * mutator method for author id
	 * @param  Uuid| string $newAuthorId value of new author id
	 * @throws \RangeException if $newAuthorId is not positive
	 * @throws \TypeError if the author Id is not
	 */
	public function setAuthorId($newAuthorId) {
		try {
			$uuid = self::validateUuid($newAuthorId);
		} catch(\InvalidArgumentException \RangeException \Exception \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		// convert and store the author id
		$this->authorId = $uuid;
	}
	/**
	 * accessor method for account activation token
	 * @return string value of the activation token
	 */
	public function getAuthorActivationToken() : string {
		return ($this->authorActivationToken);
	}
	/**
	 * mutator method for account activation token
	 * @param string $newAuthorActivationToken
	 * @throws \InvalidArgumentException  if the token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if the activation token is not a string
	 */
	public function setAuthorActivationToken(string $newAuthorActivationToken) {
		if($newAuthorActivationToken === null) {
			$this->AuthorActivationToken = null;
			return;
		}
		$newAuthorActivationToken = strtolower(trim($newAuthorActivationToken));
		if(ctype_xdigit($newAuthorActivationToken) === false) {
			throw(new\RangeException("user activation is not valid"));
		}
		//make sure user activation token is only 32 characters
		if(strlen($newAuthorActivationToken) !== 32) {
			throw(new\RangeException("user activation token has to be 32"));
		}
		$this->authorActivationToken = $newAuthorActivationToken;
	}
	/**
	 * accessor method for author avatar url
	 * @return string value of the activation token
	 */
	public function getAuthorAvatarUrl() : string {
		return($this->authorAvatarUrl);
	}
	/**
	 * mutator method for author avatar url
	 * @param string $newAuthorAvatarUrl new value of author avatar URL
	 * @throws \InvalidArgumentException if $newAuthorAvatarUrl is not a string or insecure
	 * @throws \RangeException if $newAuthorAvatarUrl is > 255 characters
	 * @throws \TypeError if $newAuthorAvatarUrl is not a string
	 */
	public function setAuthorAvatarUrl(string $newAuthorAvatarUrl) {
		$newAuthorAvatarUrl = trim($newAuthorAvatarUrl);
		$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		// verify the avatar Url will fit in the database
		if(strlen($newAuthorAvatarUrl) > 255) {
			throw(new \RangeException("image cloudinary content too large"));
		}
		// store the image cloudinary content
		$this->authorAvatarUrl = $newAuthorAvatarUrl;
	}
	/**
	 * accessor method for email
	 * @return string value of email
	 */
	public function getAuthorEmail(): string {
		return $this->authorEmail;
	}
	/**
	 * mutator method for email
	 * @param string $newAuthorEmail new value of email
	 * @throws \InvalidArgumentException if $newAuthorEmail is not a valid email or insecure
	 * @throws \RangeException if $newAuthorEmail is > 128 characters
	 * @throws \TypeError if $newAuthorEmail is not a string
	 */
	public function setAuthorEmail(string $newAuthorEmail) {
		// verify the email is secure
		$newAuthorEmail = trim($newAuthorEmail);
		$newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newAuthorEmail) === true) {
			throw(new \InvalidArgumentException("author email is empty or insecure"));
		}
		// verify the email will fit in the database
		if(strlen($newAuthorEmail) > 128) {
			throw(new \RangeException("author email is too large"));
		}
		// store the email
		$this->authorEmail = $newAuthorEmail;
	}
	/**
	 * accessor method for authorHash
	 * @return string value of hash
	 */
	public function getAuthorHash(): string {
		return $this->authorHash;
	}
	/**
	 * mutator method for author hash password
	 * @param string $newAuthorHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 97 characters
	 * @throws \TypeError if author hash is not a string
	 */
	public function setAuthorHash(string $newAuthorHash) {
		//enforce that the hash is properly formatted
		$newAuthorHash = trim($newAuthorHash);
		if(empty($newAuthorHash) === true) {
			throw(new \InvalidArgumentException("author password hash empty or insecure"));
		}
		//enforce the hash is really an Argon hash
		$authorHashInfo = password_get_info($newAuthorHash);
		if($authorHashInfo["algoName"] !== "argon2i")
			throw(new \InvalidArgumentException("author hash is not a valid hash"));
		}
		/*
		//enforce that the hash is exactly 97 characters.
		if(strlen($newAuthorHash) !== 97) {
			throw(new\RangeException("author hash has to be 97"));
		//store the hash
		$this->authorHash = $newAuthorHash;
		}
		*/
	/**
	 * accessor method for username
	 * @return string value of username
	 */
	public function getAuthorUsername(): string {
		return ($this->authorUsername);
	}
	/**
	 * mutator method for username
	 * @param string $newAuthorUsername new value of username
	 * @throws \InvalidArgumentException if $newAuthorUsername is not a string or insecure
	 * @throws \RangeException if $newAuthorUsername is > 32 characters
	 * @throws \TypeError if $newAuthorUsername is not a string
	 */
	public function setAuthorUsername(string $newAuthorUsername) {
		// verify the username is secure
		$newAuthorUsername = trim($newAuthorUsername);
		$newAuthorUsername = filter_var($newAuthorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorUsername) === true) {
			throw(new \InvalidArgumentException("author username is empty or insecure"));
		}
		// verify the username will fit in the database
		if(strlen($newAuthorUsername) > 32) {
			throw(new \RangeException("author username is too large"));
		}
		// store the username
		$this->authorUsername = $newAuthorUsername;
	}

}
