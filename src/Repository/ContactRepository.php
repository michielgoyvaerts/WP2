<?php
namespace repository;

use dao\ContactDao;

/**
 * Created by PhpStorm.
 * User: michiel.goyvaerts
 * Date: 26/10/2017
 * Time: 13:59
 */
class ContactRepository
{
    private $contactDao = null;

    public function __construct(ContactDao $contactDao)
    {
        $this->contactDao = $contactDao;
    }

    public function getAllContacts()
    {
//        $contacts = $this->contactDao->getAllContacts();
        $result = $this->contactDao->getAllContacts();
        return $result;
//        print(json_encode($contacts));
    }

    public function createContact($name, $email)
    {
        $result = $this->contactDao->createContact($name, $email);
        return $result;
    }

    public function deleteContact($contactId)
    {
        $result = $this->contactDao->deleteContact($contactId);
        return $result;
    }

    public function getContact($contactId)
    {
        $result = $this->contactDao->getContact($contactId);
        return $result;
    }
}