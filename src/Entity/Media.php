<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @todo use Vich-Uploader-Bundle */

/**
 * Class Media
 *
 * @package App\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="media")
 */
class Media
{
    /**
     * @var string
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="string", length=190)
     */
    private $uuid;

    /**
     * @var Entry
     * @ORM\OneToOne(targetEntity="Entry")
     */
    private $entry;

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