<?php

class Personnel 
{

    private $id;    
    private $nom;    
    private $prenom;    
    private $sexe;    
    private $naissance;    
    private $adresse;    
    private $telephone;
    private $departement;

    public function __construct($array=null)
    {
        $this->hidrate($array);
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
    
    /**
     * Get the value of nom
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of sexe
     */ 
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set the value of sexe
     *
     * @return  self
     */ 
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get the value of naissance
     */ 
    public function getNaissance()
    {
        return $this->naissance;
    }

    /**
     * Set the value of naissance
     *
     * @return  self
     */ 
    public function setNaissance($naissance)
    {
        $this->naissance = $naissance;

        return $this;
    }

    /**
     * Get the value of adresse
     */ 
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @return  self
     */ 
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get the value of telephone
     */ 
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephone
     *
     * @return  self
     */ 
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get the value of departement
     */ 
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * Set the value of departement
     *
     * @return  self
     */ 
    public function setDepartement($departement)
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * Effectue automatiquement les setter
     * 
     */
    private function hidrate(array $array)
    {
        foreach ($array as $key => $value){
            $methode = 'set'.ucfirst($key);
            if(method_exists($this, $methode)){
                $this->$methode($value);
            }
        }
    }

    /**
     * Ajoute un personnel
     * @param $list objet issu du JSON de personnels
     */
    public function add($list){
        $array = [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'naissance' => $this->naissance,
            'adresse' => $this->adresse,
            'telephone' => $this->telephone,
            'sexe' => $this->sexe,
            'departement' => $this->departement
        ];
        array_push($list, $array);
        file_put_contents('stockage-personnels.json',json_encode($list));
    }

    /**
     * Update un personnel
     * @param $list objet issu du JSON de personnels
     */
    public function update($list){
        foreach($list as $l){
            if($l->id == $this->id){
                $l->nom = $this->nom;
                $l->prenom = $this->prenom;
                $l->naissance = $this->naissance;
                $l->adresse = $this->adresse;
                $l->telephone = $this->telephone;
                $l->sexe = $this->sexe;
                $l->departement = $this->departement;
            }
        }
        file_put_contents('stockage-personnels.json',json_encode($list));
    }

    /**
     * Supprime un personnel
     * @param $list objet issu du JSON de personnels
     */
    public function delete($list){
        $i = 0;
        foreach($list as $l){
            if($l->id == $this->id){
                unset($list[$i]);
            }
            $i++;
        }
        $list = array_values($list);
        file_put_contents('stockage-personnels.json',json_encode($list));
    }

    
}