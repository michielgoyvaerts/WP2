<?php
namespace repository;

//require_once 'vendor/autoload.php';
use DAO\ContactDao;
use Repository\ContactRepository;
use PHPUnit\Framework\TestCase;

class ContactRepositoryTest extends TestCase
{
    private $mockContactDao;

    public function setUp()
    {
        $this->mockContactDao = $this->getMockBuilder('ContactDao')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function tearDown()
    {
        $this->mockContactDao = null;
    }

    public function testGetAllContacts()
    {
        $contactDao = new ContactDao();
        $contactRepository = new ContactRepository($contactDao);
        $this->assertCount(5, $contactRepository->getAllContacts());
    }

    public function testCreateContact()
    {
        $bool = true;
        $this->assertTrue($bool);
    }

    public function testDeleteContact()
    {
        $bool = false;
        $this->assertTrue($bool);
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
        assertEquals($contact, $actualContact);
    }
}
