<?php
/**
 * Created by PhpStorm.
 * User: michiel.goyvaerts
 * Date: 26/10/2017
 * Time: 14:00
 */

class ContactDao
{
    // database connection and table name
    private $database = "WP1";
    private $user = "root";
    private $password = "root";

    // object properties
    public $id;
    public $name;
    public $email;

    // constructor with $db as database connection
    public function __construct(){
    }

    // read contacts
    public function getAllContacts(){
        try{
            $pdo = $this->openConnection();
            $statement = null;
            if ($pdo != null) {
                $statement = $pdo->query('SELECT * FROM contact');
                $statement->setFetchMode(PDO::FETCH_ASSOC);
            }
        }catch(PDOException $e){
            print 'Exception!: ' . $e->getMessage();
        }
        return $statement != null ? $statement->fetchAll() : array();
    }

    public function createContact($name, $email){
        try{
            $pdo = $this->openConnection();
            $statement = null;
            if($pdo != null){
                $statement = $pdo->prepare('INSERT INTO contact ' . '(name, email) VALUES (?,?);' );
                $statement->bindParam(':name',$name,PDO::PARAM_STR);
                $statement->bindParam(':email',$email,PDO::PARAM_STR);
                $numberRows = $statement->execute();
                ​print("$numberRows ​rows​ ​modified");
            }
        }catch(PDOException $e){
            print 'Exception!: ' . $e->getMessage();
        }
    }

    public function deleteContact($contactId){
        try{
            $pdo = $this->openConnection();
            $statement = null;
            if($pdo != null){
                $statement = $pdo->query('DELETE FROM contact WHERE id = $contactId');
                $numberRows = $statement->execute();
                ​print("$numberRows ​rows​ ​modified");
            }
        }catch(PDOException $e){
            print 'Exception!: ' . $e->getMessage();
        }
    }

    private function openConnection(){
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=".$this->database, $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            print 'Exception!: ' . $e->getMessage();
            return null;
        }
    }
}