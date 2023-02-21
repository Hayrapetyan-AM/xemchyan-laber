<?php 

/**
 * Database class
 * 
 * This class is used to handle the database connection
 * It uses the singleton design pattern to ensure only one instance of the class exists
 * It also uses PDO to handle the database connection
 */

class Database
{
    private static $instance = null; // static variable to hold the single instance of the class
    private $pdo; // variable to hold the PDO object

    /**
     * constructor 
     * creating the PDO object and set the database connection parameters
     */
    private function __construct()
    {
        try {
            // fetching the config values
            $host = 'localhost';
            $dbname = 'lab-3';
            $username = 'root';
            $password = '';
            $port = 3306;
            // creating the PDO object
            $this->pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
            // setting the error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    /**
     * method to get the single instance of the class
     * creates a new instance if one does not already exist
     * @return self
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /**
     * method to return the PDO object
     * @return PDO
     */
    public function getConnection()
    {
        return $this->pdo;
    }
}
