<?php
require 'form.class.php';
require 'personnel.class.php';
require 'listing.class.php';

if(isset($_GET['id'])){ //confirmation par le formulaire
    $id = $_GET['id'];
    $form_data['id'] = $id;
    $p = Listing::getPersonnelById($id);
    if($p){
        $nom = $p->getNom();
        $prenom = $p->getPrenom();
        $form_data['action'] = 'delete';
    }
    $form = new Form($form_data);

    $show_form = 
    $form->inputHidden('id') .
    $form->inputHidden('action') .
    $form->submit('Oui confirmer');
}
?>
<html>
<head>
    <title>Suppression du personnel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="form">
            <h3>Confirmation de suppression</h3>
            <h1>Voulez-vous vraiment supprimer <?= $nom . ' ' . $prenom ?> de la liste de vos personnels ?</h1>
            <h4>Cette action sera irréversible</h4>
            <form action="/index.php" method="post">
                <?= $show_form ?>
            </form>
            <a href="/index.php" target="" rel="noopener noreferrer"><button>Annuler</button></a>
        </div>
        <div class="list">
            
        </div>
    </div>
</body>
</html>