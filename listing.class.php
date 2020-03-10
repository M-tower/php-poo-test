<?php

class Listing
{
    public static function getAllPersonnel(){
        $json = file_get_contents('stockage-personnels.json');
        return json_decode($json);
    }

    public static function getPersonnelById($id){
        $list = self::getAllPersonnel();
        foreach($list as $l){
            if($l->id == $id){
                $item = [
                    'id' => $l->id,
                    'nom' => $l->nom,
                    'prenom' => $l->prenom,
                    'naissance' => $l->naissance,
                    'adresse' => $l->adresse,
                    'telephone' => $l->telephone,
                    'sexe' => $l->sexe,
                    'departement' => $l->departement
                ];
                $p = new Personnel($item);
                return $p;
            }
        }
        return false;
    }

    public static function getLastId(){
        $list = self::getAllPersonnel();
        return end($list)->id;
    }
}