<?php
/**
 * Created by PhpStorm.
 * User: michiel.goyvaerts
 * Date: 26/10/2017
 * Time: 15:05
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../WP2/Repository/ContactRepository.php';
include_once '../WP2/DAO/ContactDao.php';

// initialize object
$contactDao = new ContactDao();
$repo = new ContactRepository($contactDao);

// query contacts
$result = $repo->getAllContacts();

?>