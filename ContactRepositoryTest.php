<?php
namespace repository;

require_once 'src/Model/Contact.php';
require_once 'src/DAO/ContactDao.php';
use DAO\ContactDao;
use Model\Contact;
use Repository\ContactRepository;
use PHPUnit\Framework\TestCase;

class ContactRepositoryTest extends TestCase
{
    private $mockContactDao;

    public function setUp()
    {
        $this->mockContactDao = $this->getMockBuilder('\DAO\ContactDao')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function tearDown()
    {
        $this->mockContactDao = null;
    }

    public function testGetAllContacts()
    {
        /*$contactDao = new ContactDao();
        $contactRepository = new ContactRepository($contactDao);
        $this->assertCount(5, $contactRepository->getAllContacts());*/

        $contact1 = new Contact(1,"name1","name1@email.com");
        $contact2 = new Contact(2,"name2","name2@email.com");
        $contact3 = new Contact(3,"name3","name3@email.com");

        $contacts = array($contact1, $contact2, $contact3);

        $this->mockContactDao->expects($this->atLeastOnce())
            ->method('getAllContacts')
            ->will($this->returnValue($contacts));
        $contactRepository = new ContactRepository($this->mockContactDao);
        $actualContact = $contactRepository->getAllContacts();
        $this->assertEquals($contacts, $actualContact);
    }

    public function testCreateContact()
    {
        /*$bool = true;
        $this->assertTrue($bool);*/

        $contact = new Contact(4,"name4","name4@email.com");

        $this->mockContactDao->expects($this->atLeastOnce())
            ->method('createContact')
            ->with($this->equalTo("name4"))
            ->will($this->returnValue($contact));
        $contactRepository = new ContactRepository($this->mockContactDao);
        $actualContact = $contactRepository->createContact("name4", "name4@email.com");
        $this->assertEquals($contact, $actualContact);
    }

    public function testDeleteContact()
    {
        /*$bool = false;
        $this->assertTrue($bool);*/

        $contact1 = new Contact(1,"name1","name1@email.com");
        $contact2 = new Contact(2,"name2","name2@email.com");
        $contact3 = new Contact(3,"name3","name3@email.com");

        $contacts = array($contact1, $contact2);

        $this->mockContactDao->expects($this->atLeastOnce())
            ->method('deleteContact')
            ->with($this->equalTo(3))
            ->will($this->returnValue($contacts));
        $contactRepository = new ContactRepository($this->mockContactDao);
        $actualContact = $contactRepository->deleteContact(3);
        $this->assertEquals($contacts, $actualContact);
    }

    public function testGetContact_idExists_contactObject()
    {
        $contact = array('id'=>'1', 'name'=>'test', 'email'=>'test@test.be');
        $this->mockContactDao->expects($this->atLeastOnce())
            ->method('getContact')
            ->with($this->equalTo(1))
            ->will($this->returnValue($contact));
        $contactRepository = new ContactRepository($this->mockContactDao);
        $actualContact = $contactRepository->getContact(1);
        $this->assertEquals($contact, $actualContact);
    }
}
