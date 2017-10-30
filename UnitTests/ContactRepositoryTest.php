<?php
/**
 * Created by PhpStorm.
 * User: michiel.goyvaerts
 * Date: 30/10/2017
 * Time: 14:07
 */


class ContactRepositoryTest extends TestCase
{
    public function setUp(){
        $this->mockContactDao = $this->getMockBuilder('\DAO\ContactDao')
            ->disableOroginalConstructor()
            ->getMock();
    }

    public function tearDown(){
        $this->mockContactDao = null;
    }

    public function testGetAllContacts(){

    }

    public function testCreateContact(){

    }

    public function testDeleteContact(){

    }
}
