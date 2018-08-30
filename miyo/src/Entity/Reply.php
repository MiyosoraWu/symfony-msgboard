<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReplyRepository")
 */
class Reply
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Msgboard")
     * @ORM\JoinColumn(name="msgid", referencedColumnName="id",  onDelete  =  "CASCADE")
     */
    private $msgid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $replynick;

    /**
     * @ORM\Column(type="text")
     */
    private $replymsg;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $replytime;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMsgid(): ?int
    {
        return $this->msgid;
    }

    public function setMsgid($msgid): self
    {
        $this->msgid = $msgid;

        return $this;
    }

    public function getReplynick(): ?string
    {
        return $this->replynick;
    }

    public function setReplynick(string $replynick): self
    {
        $this->replynick = $replynick;

        return $this;
    }

    public function getReplymsg(): ?string
    {
        return $this->replymsg;
    }

    public function setReplymsg(string $replymsg): self
    {
        $this->replymsg = $replymsg;

        return $this;
    }

    public function getReplytime(): ?string
    {
        return $this->replytime;
    }

    public function setReplytime(string $replytime): self
    {
        $this->replytime = $replytime;

        return $this;
    }
}
