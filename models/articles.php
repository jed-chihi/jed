<?php

class Articles {
    private $id;
    private $titre_art;
    private $contenu;
    private $date;
    private $nom_user;

    public function __construct($id, $titre_art, $contenu, $nom_user) {
        $this->id = $id;
        $this->titre_art = $titre_art;
        $this->contenu = $contenu;
        $this->date = date('Y-m-d'); // Fixed to the current date and time
        $this->nom_user = $nom_user;
    }

    /**
     * Get the value of id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get the value of titre_art
     */
    public function getTitreArt() {
        return $this->titre_art;
    }

    /**
     * Set the value of titre_art
     */
    public function setTitreArt($titre_art) {
        $this->titre_art = $titre_art;
        return $this;
    }

    /**
     * Get the value of contenu
     */
    public function getContenu() {
        return $this->contenu;
    }

    /**
     * Set the value of contenu
     */
    public function setContenu($contenu) {
        $this->contenu = $contenu;
        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate() {
        return $this->date;
    }

    // No setter for date to keep it immutable

    /**
     * Get the value of nom_user
     */
    public function getNomUser() {
        return $this->nom_user;
    }

    /**
     * Set the value of nom_user
     */
    public function setNomUser($nom_user) {
        $this->nom_user = $nom_user;
        return $this;
    }
}
?>
