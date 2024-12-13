<?php

class Commentaire {
    // Attributes
    private $id;
    private $contenu;
    private $date;
    private $like;
    private $article;

    // Constructor
    public function __construct($id, $contenu, $date, $like, $article_id) {
        $this->id = $id;
        $this->contenu = $contenu;
        $this->date = date('Y-m-d');
        $this->like = $like;
        $this->article = $article;
    }

    // Getter methods (no setters for read-only attributes)
    
    public function getId() {
        return $this->id;
    }

    public function getContenu() {
        return $this->contenu;
    }

    public function setContenu($contenu) {
        $this->contenu = $contenu;
    }

    public function getDate() {
        return $this->date;
    }

    

    public function getLike() {
        return $this->like;
    }

    public function getArticleId() {
        return $this->article_id;
    }
}
?>