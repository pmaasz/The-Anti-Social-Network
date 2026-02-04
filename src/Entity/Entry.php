<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

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
     * @ORM\GeneratedValue(strategy="NONE")
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
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="uuid")
     */
    private $author;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $body;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $media;

    /**
     * @var Comment[]
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="entry")
     */
    private $comments;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $link;

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
        $this->uuid = uniqid('', true);
        $this->createDate = new \DateTime();
        $this->body = "";
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
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @param UserInterface $author
     */
    public function setAuthor(?UserInterface $author): void
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
     * @return string
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getMedia(): ?string
    {
        return $this->media;
    }

    /**
     * @param string $media
     */
    public function setMedia(string $media): void
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