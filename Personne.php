<?php

class Personne
{
    private $nom,$prenom,$dateNaissance, $mail;

    public function __construct($id='', $nom='', $prenom='', $dateNaissance='', $mail=''){
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance=$dateNaissance;
        $this->mail=$mail;
    }

    public function setId($id){
        $this->id=$id;
    }
    public function setNom($nom){
        $this->nom = strtoupper($nom);
    }

    public function setPrenom($prenom){
        $this->prenom = strtoupper (substr($prenom, 0, 1)).strtolower(substr($prenom, 1));
    }
    public function setDateNAissance($dateNaissance){
        $this->dateNaissance = $dateNaissance;
    }
    public function setMail($mail){
        $this->mail=$mail;
    }

    public function getId(){
        return $this->id;
    }
    public function getNom(){
        return $this->nom;
    }

    public function getPrenom(){
        return $this->prenom;
    }

    public function getAge(){
        return $this->calculAge($this->dateNaissance);
    }
    public function getMail(){
        return $this->mail;
    }

    public function __toString(){
        return $this->nom.' '.$this->prenom;
    }

    /*CALCUL DE L'AGE A PARTIR DE LA DATE DE NAISSANCE*/
    private function calculAge($date){
        $infosDate = explode('-', $date);
        $newDate = $infosDate[1].'-'.$infosDate[2].'-'.$infosDate[0];
        /*Conversion d'une chaine de caract en tps sec écoulé depuis 70'*/
        $d = strtotime($newDate);
        return (int)((time()-$d)/3600/24/365.242);
    }
}
