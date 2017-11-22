<?php
namespace dao;

use PDO;
use PDOException;

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
    public $contactId;
    public $name;
    public $email;

    // constructor with $db as database connection
    public function __construct()
    {
    }

    // read contacts
    public function getAllContacts()
    {
        $statement = null;
        try {
            $pdo = $this->openConnection();
            if ($pdo != null) {
                $statement = $pdo->query('SELECT id, name, email FROM contact');
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                $result = $statement->fetchAll();
                print(json_encode($result));
                return $result;
            }
        } catch (PDOException $e) {
            print 'Exception!: ' . $e->getMessage();
        }
        //return $statement != null ? $statement->fetchAll(MYSQLI_ASSOC) : array();
    }

    public function createContact($name, $email)
    {
        $statement = null;
        try {
            $pdo = $this->openConnection();
            if ($pdo != null) {
                $statement = $pdo->prepare('INSERT INTO contact (name, email) VALUES (:name, :email)');
                $statement->bindParam(':name', $name, PDO::PARAM_STR);
                $statement->bindParam(':email', $email, PDO::PARAM_STR);
                $statement->execute();
                $this->getContact($pdo->lastInsertId());
            }
        } catch (PDOException $e) {
            print 'Exception!: ' . $e->getMessage();
        }
    }

    public function deleteContact($contactId)
    {
        $statement = null;
        try {
            $pdo = $this->openConnection();
            if ($pdo != null) {
                $statement = $pdo->prepare('DELETE FROM contact WHERE id = :contactId');
                $statement->bindParam(":contactId", $contactId, PDO::PARAM_INT);
                $numberRows = $statement->execute();
                print("$numberRows ​rows​ ​modified");
            }
        } catch (PDOException $e) {
            print 'Exception!: ' . $e->getMessage();
        }
    }

    public function getContact($contactId)
    {
        $statement = null;
        try {
            $pdo = $this->openConnection();
            if ($pdo != null) {
                $statement = $pdo->prepare('SELECT id, name, email FROM contact WHERE id = :contactId');
                $statement->bindParam(":contactId", $contactId, PDO::PARAM_INT);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                //$contact = [$result['id'], $result['name'], $result['email']];
//                print("$numberRows ​rows​ ​modified");
//                print(json_encode($result));
                print(json_encode($result));
                return $result;
            }
        } catch (PDOException $e) {
            print 'Exception!: ' . $e->getMessage();
        }
        return "Contact does not exist";
    }

    private function openConnection()
    {
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