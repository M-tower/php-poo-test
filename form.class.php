<?php

/**
 * Class permettant de générer un formulaire
 */
class Form
{

    /**
     * $disp balise encadrant les élément du formulaire
     */
    private static $disp = 'p';
    
    /**
     * $data donnée à charger dans le formulaire
     */
    private $data;

    public function __construct($data = null)
    {
        $this->data = $data;
    }

    /**
     * formate l'affichage avec la balise définie dans $disp
     * @param $tag string html
     */
    private function formate($tag)
    {
        return '<' . self::$disp . '>' . $tag . '</' . self::$disp . '>';
    }

    /**
     * récupère la valeur correspondant à l'index dans le $data
     * @param $index string index dans le tableau $data
     */
    private function getValue($index){
        return $this->data[$index];
    }
    
    /**
     * génère un champ input avec comme name $name
     * @param $name string
     */
    public function input($name)
    {
        $tag = $name . '<br><input type="text" name="' . $name . '" value="' . $this->getValue($name) . '" />';
        return $this->formate($tag);
    }

    /**
     * génère un champ input hidden avec comme name $name
     * @param $name string
     */
    public function inputHidden($name)
    {
        $tag = '<input type="hidden" name="' . $name . '" value="' . $this->getValue($name) . '" />';
        return $tag;
    }

    /**
     * génère un champ select avec comme name $name et options les données dans l'array $array
     * @param $name string
     * @param $array Array
     */
    public function inputSelect($name, $array)
    {
        $tag = $name . '<br><select name="' . $name . '" />';
        foreach ($array as $k => $v) {
            $selected = ($this->getValue($name) == $v)? 'selected' : '';
            $tag .= '<option value="' . $v . '" ' .$selected. '>' . $k . '</option>';
        }
        $tag .= '</select>';
        return $this->formate($tag);
    }

    /**
     * génère un bouton submit avec un libelle $label
     * @param $label string
     */
    public function submit($label=null)
    {
        $text = ($label)? $label : 'Enregistrer';
        $tag = '<button type="submit">'.$text.'</button>';
        return $this->formate($tag);
    }
}
