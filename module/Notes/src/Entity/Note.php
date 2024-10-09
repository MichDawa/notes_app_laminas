<?php

namespace Notes\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Notes\Repository\NoteRepository")
 * @ORM\Table(name="note")
 * @ORM\HasLifecycleCallbacks
 */
class Note
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, name="title")
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true, name="content")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    // Getters and setters

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Automatically set createdAt before persisting the entity.
     * @ORM\PrePersist
     */
    public function prePersist()
    {
        if ($this->createdAt === null) {
            $timezone = new \DateTimeZone('Asia/Manila');
            $this->createdAt = new \DateTime('now', $timezone);
        }
    }

    public function exchangeArray(array $data)
    {
        $this->title = $data['title'] ?? null;
        $this->content = $data['content'] ?? null;
        $this->createdAt = new \DateTime();
    }

    public function getArrayCopy(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'createdAt' => $this->createdAt ? $this->createdAt->format('Y-m-d H:i:s') : null,
        ];
    }
}
