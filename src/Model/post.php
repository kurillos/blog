<?php
namespace App\Model;
namespace App\Helpers\Text;

class Post {

    private $id;

    private $name;

    private $content;

    private $created_at;

    private $categories= [];

    public function getName(): string
    {
        return $this->name;
    }

    public function getExcerpt(): string
    {
        return \App\Helpers\Text::excerpt($this->content);
    }
    
}