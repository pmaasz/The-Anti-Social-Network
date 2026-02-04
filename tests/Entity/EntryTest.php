<?php

namespace App\Tests\Entity;

use App\Entity\Entry;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class EntryTest extends TestCase
{
    public function testEntryCreation()
    {
        $entry = new Entry();
        $this->assertInstanceOf(Entry::class, $entry);
    }

    public function testEntryDefaultCreateDate()
    {
        $entry = new Entry();
        $this->assertInstanceOf(\DateTime::class, $entry->getCreateDate());
    }

    public function testEntryDefaultBody()
    {
        $entry = new Entry();
        $this->assertEquals("", $entry->getBody());
    }

    public function testSetAndGetBody()
    {
        $entry = new Entry();
        $body = "This is a test entry body";
        
        $entry->setBody($body);
        $this->assertEquals($body, $entry->getBody());
    }

    public function testSetAndGetAuthor()
    {
        $entry = new Entry();
        $user = $this->createMock(User::class);
        
        $entry->setAuthor($user);
        $this->assertEquals($user, $entry->getAuthor());
    }

    public function testSetAndGetMedia()
    {
        $entry = new Entry();
        $media = '/uploads/test-image.jpg';
        
        $entry->setMedia($media);
        $this->assertEquals($media, $entry->getMedia());
    }

    public function testSetAndGetLink()
    {
        $entry = new Entry();
        $link = 'dQw4w9WgXcQ';
        
        $entry->setLink($link);
        $this->assertEquals($link, $entry->getLink());
    }

    public function testSetAndGetComments()
    {
        $entry = new Entry();
        $comments = [];
        
        $entry->setComments($comments);
        $this->assertEquals($comments, $entry->getComments());
    }

    public function testSetAndGetDislikes()
    {
        $entry = new Entry();
        $dislikes = [];
        
        $entry->setDislikes($dislikes);
        $this->assertEquals($dislikes, $entry->getDislikes());
    }

    public function testSetAndGetCreateDate()
    {
        $entry = new Entry();
        $date = new \DateTime('2026-01-01 12:00:00');
        
        $entry->setCreateDate($date);
        $this->assertEquals($date, $entry->getCreateDate());
    }
}
