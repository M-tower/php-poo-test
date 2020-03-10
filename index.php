<?php
require 'form.class.php';
require 'personnel.class.php';
require 'listing.class.php';


$list = Listing::getAllPersonnel();
$form_data = [
    'id' => -1,
    'nom' => '',
    'prenom' => '',
    'naissance' => '',
    'adresse' => '',
    'telephone' => '',
    'sexe' => 'M',
    'departement' => 'Ressources Humaines',
    'action' => ''
];

//taitement requêtes save
if(isset($_POST['id'])){
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $naissance = $_POST['naissance'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $sexe = $_POST['sexe'];
    $departement = $_POST['departement'];
    $item = [
        'id' => $id,
        'nom' => $nom,
        'prenom' => $prenom,
        'naissance' => $naissance,
        'adresse' => $adresse,
        'telephone' => $telephone,
        'sexe' => $sexe,
        'departement' => $departement
    ];
    if($id == -1){ //add
        $item['id'] = Listing::getLastId() + 1;
        
        $personnel = new Personnel($item);
        // ici j'ai du passer la liste en param car je l'ai déjà appelé dans ce fichier
        $personnel->add($list);
        
    }else if(isset($_POST['action'])){ 
        $action = $_POST['action'];
        if($action == 'edit'){ // update
            $personnel = new Personnel($item);
            $personnel->update($list);
        }else{ //delete
            $personnel = new Personnel($item);
            $personnel->delete($list);
        }
        header('Location: http://'.$_SERVER['HTTP_HOST']);
            exit();
    }

    
    // On récupère à nouveau le fichier JSON
    $list = Listing::getAllPersonnel();
}

if(isset($_GET['id'])){ //edition par le formulaire
    $id = $_GET['id'];
    $form_data['id'] = $id;
    $p = Listing::getPersonnelById($id);
    if($p){
        $form_data['nom'] = $p->getNom();
        $form_data['prenom'] = $p->getPrenom();
        $form_data['naissance'] = $p->getNaissance();
        $form_data['adresse'] = $p->getAdresse();
        $form_data['telephone'] = $p->getTelephone();
        $form_data['sexe'] = $p->getSexe();
        $form_data['departement'] = $p->getDepartement();
        $form_data['action'] = 'edit';
    }
}

$form = new Form($form_data);
$sexe_array = [
    'Masculin' => 'M',
    'Feminin' => 'F'
];
$dep_array = [
    'Ressources Humaines' => 'Ressources Humaines',
    'Commercial' => 'Commercial',
    'Marketing' => 'Marketing',
    'IT' => 'IT',
    'Administration' => 'Administration'
];
// Génération du formulaire
$show_form = 
$form->inputHidden('id') .
$form->input('nom') .
$form->input('prenom') .
$form->input('naissance') .
$form->input('adresse') .
$form->input('telephone') .
$form->inputSelect('sexe', $sexe_array).
$form->inputSelect('departement', $dep_array).
$form->inputHidden('action') .
$form->submit();

?>

<html>
<head>
    <title>Gestion du personnel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="form">
            <h3>Edition de personnel</h3>
            <form action="#" method="post">
                <?= $show_form ?>
            </form>
        </div>
        <div class="list">
            <h3>Liste de personnels</h3>
            <table>
                <thead>
                    <tr>
                        <th>Noms</th>
                        <th>Prénoms</th>
                        <th>Département</th>
                        <th>Editer</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($list as $l){
                            echo '<tr>'.
                            '<td>'.$l->nom.'</td>'.
                            '<td>'.$l->prenom.'</td>'.
                            '<td>'.$l->departement.'</td>'.
                            '<td><a href="/?id='.$l->id.'">✎</a></td>'.
                            '<td><a href="/delete-confirm.php?id='.$l->id.'&action=delete">✗</a></td>'.
                            '</tr>';
                        }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
