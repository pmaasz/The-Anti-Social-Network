<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Entry
 *
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="entry")
 */
class Entry
{
    /**
     * @var string
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string", length=190)
     */
    private $uuid;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $createDate;

    /**
     * @var User
     * @ORM\OneToOne(targetEntity="User")
     */
    private $author;

    /**
     * @var string
     * @ORM\Column(type=string, nullable=false)
     */
    private $body;

    /**
     * @var Media
     * @ORM\OneToOne(targetEntity="Media")
     */
    private $media;

    /**
     * @var Comment[]
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="entry")
     */
    private $comments;

    /**
     * @var Dislike[]
     * @ORM\OneToMany(targetEntity="Dislike", mappedBy="entry")
     */
    private $dislikes;

    /**
     * Entry constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->createDate = new \DateTime();
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate(): \DateTime
    {
        return $this->createDate;
    }

    /**
     * @param \DateTime $createDate
     */
    public function setCreateDate(\DateTime $createDate): void
    {
        $this->createDate = $createDate;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * @return Media
     */
    public function getMedia(): Media
    {
        return $this->media;
    }

    /**
     * @param Media $media
     */
    public function setMedia(Media $media): void
    {
        $this->media = $media;
    }

    /**
     * @return Comment[]
     */
    public function getComments(): array
    {
        return $this->comments;
    }

    /**
     * @param Comment[] $comments
     */
    public function setComments(array $comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @return Dislike[]
     */
    public function getDislikes(): array
    {
        return $this->dislikes;
    }

    /**
     * @param Dislike[] $dislikes
     */
    public function setDislikes(array $dislikes): void
    {
        $this->dislikes = $dislikes;
    }
}