<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 *
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="user")
 */
class User implements UserInterface
{
    /**
     * @var string
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string", length= 191)
     */
    private $uuid;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $username;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $plainPassword;

    /**
     * @var Dislike[]
     * @ORM\OneToMany(targetEntity="Dislike", mappedBy="user")
     */
    private $dislikes;

    /**
     * @var Comment[]
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="author")
     */
    private $comments;

    /**
     * @var Entry[]
     * @ORM\OneToMany(targetEntity="Entry", mappedBy="author")
     */
    private $entries;

    /**
     * @var array
     * @ORM\Column(type="json", nullable=false)
     */
    private $roles;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->roles = ['ROLE_USER'];
    }

    /**
     * @return string
     */
    public function getUuId()
    {
        return $this->uuid;
    }

    /**
     * @param string $id
     */
    public function setUuId(string $id)
    {
        $this->uuid = $id;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * @param array $roles
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @return string|null
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->getPlainPassword();
    }

    /**
     * @return string|null
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     */
    public function setPlainPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return Dislike[]
     */
    public function getDislikes(): ?array
    {
        return $this->dislikes;
    }

    /**
     * @param array $dislikes
     */
    public function setDislikes(Array $dislikes): void
    {
        $this->dislikes = $dislikes;
    }

    /**
     * @return array
     */
    public function getComments(): ?array
    {
        return $this->comments;
    }

    /**
     * @param array $comments
     */
    public function setComments(array $comments): void
    {
        $this->comments = $comments;
    }

    /**
     * @return array
     */
    public function getEntries(): ?array
    {
        return $this->entries;
    }

    /**
     * @param array $entries
     */
    public function setEntries(array $entries): void
    {
        $this->entries = $entries;
    }
}