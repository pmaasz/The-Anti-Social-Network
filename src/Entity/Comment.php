<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Comment
 *
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="comment")
 */
class Comment
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="uuid")
     */
    private $author;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $media;

    /**
     * @var Entry
     * @ORM\ManyToOne(targetEntity="Entry")
     * @ORM\JoinColumn(name="entry_id", referencedColumnName="uuid")
     */
    private $entry;

    /**
     * @var Dislike[]
     * @ORM\OneToMany(targetEntity="Dislike", mappedBy="comment")
     */
    private $dislikes;

    /**
     * Comment constructor.
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
     * @return Entry
     */
    public function getEntry(): Entry
    {
        return $this->entry;
    }

    /**
     * @param Entry $entry
     */
    public function setEntry(Entry $entry): void
    {
        $this->entry = $entry;
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