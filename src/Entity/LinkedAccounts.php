<?php

namespace App\Entity;

use App\Repository\LinkedAccountsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LinkedAccountsRepository::class)
 */
class LinkedAccounts
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="linkedAccounts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity=SocialMedia::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $social_media_id;

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

    public function getSocialMediaId(): ?SocialMedia
    {
        return $this->social_media_id;
    }

    public function setSocialMediaId(?SocialMedia $social_media_id): self
    {
        $this->social_media_id = $social_media_id;

        return $this;
    }
}
