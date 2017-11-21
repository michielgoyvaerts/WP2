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
        $this->contactDao->getAllContacts();
//        print(json_encode($contacts));
    }

    public function createContact($name, $email)
    {
        $this->contactDao->createContact($name, $email);
    }

    public function deleteContact($contactId)
    {
        $this->contactDao->deleteContact($contactId);
    }

    public function getContact($contactId)
    {
        $this->contactDao->getContact($contactId);
    }
}