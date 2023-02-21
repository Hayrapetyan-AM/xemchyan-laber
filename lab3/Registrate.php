<?php 
require_once('Database.php');
/**
 * 
 */
class Registrate 
{
	public $email;
	public $phone;
	public $password;
	public $repeatPassword;
	public $errors;
	public $profile_endpoint = 'profile.php';

	function __construct($email, $phone, $password, $repeatPassword)
	{
		$this->email = $email;	
		$this->phone = $phone;	
		$this->password = $password;	
		$this->repeatPassword = $repeatPassword;	
	}

	public function validate()
	{
		$emailRegex = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
		$phoneNumberRegex = '/^\+374\d{8}$/';

		if (empty($this->email) || empty($this->phone) || empty($this->password) || empty($this->repeatPassword)) {
		    $this->errors = 'Please fill in all fields.';
		    return false;
		}

		if (!preg_match($emailRegex, $this->email)) {
		    $this->errors = 'Please enter a valid email address.';
		    return false;
		}

		if (!preg_match($phoneNumberRegex, $this->phone)) {
		    $this->errors = 'Please enter a valid phone number in the format +374XXXXXXXX.';
		    return false;
		}

		if ($this->password !== $this->repeatPassword) {
		    $this->errors = 'Passwords do not match.';
		    return false;
		}

		if (strlen($this->password) < 8) {
		    $this->errors = 'Password must be at least 8 characters long.';
		    return false;
		}

		if (!preg_match('/[A-Z]/', $this->password)) {
		    $this->errors = 'Password must contain at least one uppercase letter.';
		    return false;
		}

		if (!preg_match('/[a-z]/', $this->password)) {
		    $this->errors = 'Password must contain at least one lowercase letter.';
		    return false;
		}

		if (!preg_match('/\d/', $this->password)) {
		    $this->errors = 'Password must contain at least one number.';
		    return false;
		}

		if (!preg_match('/[-!$%^&*()_+|~=`{}\[\]:";\'<>?,.\/]/', $this->password)) {
		    $this->errors = 'Password must contain at least one special character.';
		    return false;
		}

		return true;
	}

	public function phoneDublicate()
	{
		$Database = Database::getInstance();
		$pdo = $Database->getConnection();
		$stmt = $pdo->prepare('SELECT phone FROM users WHERE phone = :phone');

		$stmt->bindParam(':phone', $this->phone);
		$stmt->execute();

		if ($phone = $stmt->fetchColumn()) 
		{
			$this->errors = "Double entry for field - phone";
			return false;
		}

		return true;
	}

	public function emailDublicate()
	{
		$Database = Database::getInstance();
		$pdo = $Database->getConnection();
		$stmt = $pdo->prepare('SELECT email FROM users WHERE email = :email');

		$stmt->bindParam(':email', $this->email);
		$stmt->execute();

		if ($email = $stmt->fetchColumn()) 
		{
			$this->errors = "Double entry for field - email";
			return false;
		}

		return true;
	}

	public function registrate()
	{
		$Database = Database::getInstance();
		$pdo = $Database->getConnection();
		// Prepare the statement with placeholders
		$stmt = $pdo->prepare("INSERT INTO users (email, phone, password) VALUES (:email, :phone, :password)");

		// Bind the values to the placeholders
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':phone', $this->phone);
		$stmt->bindParam(':password', password_hash($this->password, PASSWORD_DEFAULT));

		$stmt->execute() ? $result = true : $result = false; 
		return $result;

	}
}

$email 			= trim(stripcslashes(htmlspecialchars($_POST['email'])));
$phone 			= trim(stripcslashes(htmlspecialchars($_POST['phone'])));
$password 		= trim(stripcslashes(htmlspecialchars($_POST['password'])));
$repeatPassword = trim(stripcslashes(htmlspecialchars($_POST['password2'])));

$user = new Registrate($email, $phone, $password, $repeatPassword);
if($user->validate() && $user->phoneDublicate() && $user->emailDublicate())
{
	$user->registrate() ? header('Location: ' . $user->profile_endpoint) : '';
}else{
	echo $user->errors;
}
