<?php
namespace App\Model;

use App\Helpers\Text;
use \DateTime;

class Post {

    private $id;

    private $name;

    private $content;

    private $created_at;

    private $categories= [];

    private $slug;

    public function getName(): string
    {
        return $this->name;
    }

    public function getFormattedContent(): ?string
    {
        return nl2br(e($this->content));
    }

    public function getExcerpt(): string
    {
        return Text::excerpt($this->content);
    }

    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->created_at);
    }
    
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getID(): ?int
    {
        return $this->id;
    }
}