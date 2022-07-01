<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="messages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\Column(type="string", length=555)
     */
    private $content;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $planified_at;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\ManyToMany(targetEntity=SocialMedia::class)
     */
    private $social_media_id;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="messages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status_id;

    public function __construct()
    {
        $this->social_media_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

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

    public function getPlanifiedAt(): ?\DateTimeInterface
    {
        return $this->planified_at;
    }

    public function setPlanifiedAt(?\DateTimeInterface $planified_at): self
    {
        $this->planified_at = $planified_at;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, SocialMedia>
     */
    public function getSocialMediaId(): Collection
    {
        return $this->social_media_id;
    }

    public function addSocialMediaId(SocialMedia $socialMediaId): self
    {
        if (!$this->social_media_id->contains($socialMediaId)) {
            $this->social_media_id[] = $socialMediaId;
        }

        return $this;
    }

    public function removeSocialMediaId(SocialMedia $socialMediaId): self
    {
        $this->social_media_id->removeElement($socialMediaId);

        return $this;
    }

    public function getStatusId(): ?Status
    {
        return $this->status_id;
    }

    public function setStatusId(?Status $status_id): self
    {
        $this->status_id = $status_id;

        return $this;
    }
}
