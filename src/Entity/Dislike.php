<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Dislike
 *
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="dislike")
 */
class Dislike
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="dislikes")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="uuid")
     */
    private $user;

    /**
     * @var Entry
     * @ORM\ManyToOne(targetEntity="Entry", inversedBy="dislikes")
     * @ORM\JoinColumn(name="entry_id", referencedColumnName="uuid")
     */
    private $entry;

    /**
     * Dislike constructor.
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
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
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
}