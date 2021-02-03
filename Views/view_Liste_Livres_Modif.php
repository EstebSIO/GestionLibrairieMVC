<?php
// On récupère le livre dans le tableau 
if(isset($livre[0])){$livre = $livre[0];}
?>
<h2>
    <?php
     if(isset($livre))
        {echo 'Modification du livre'. e($livre['Titre_Livre']).' (ISBN: '. e($livre['ISBN']) .')';}
    else{echo "Ajout d'un livre";} ?>
    </h2>


<!-- FORMULAIRE DE MODIFICATION DES DONNÉES--> 
<form action="">

    <div class="row">
        <div class="col">
            <!-- Titre Livre -->
            <label>Titre Livre</label>
            <input type="text" name="titreLivre" class="form-control"
                value="<?php if(isset($livre)){echo e($livre['Titre_Livre']);} ?>" aria-label="First name">
        </div>
        <div class="col">
            <!-- Theme Livre -->
            <label>Theme Livre </label>
            <input type="text" name="themeLivre" class="form-control" value="<?php if(isset($livre)){echo e($livre['Theme_Livre']);} ?>"
                aria-label="Last name">
        </div>
    </div>
    <div class="row">
        
    </div>

    <div class="row">
        <div class="col">
            <!-- CODE POSTAL -->
            <label>Nom Auteur</label>
            <input type="text" name="nomAuteur" value="<?php if(isset($livre)){echo e($livre['Nom_Auteur']);} ?>"
                class="form-control" id="inputZip">
        </div>
        <div class="col">
            <!-- Prenom Auteur -->
            <label>Prenom Auteur</label>
            <input type="text" name="prenomAuteur" value="<?php if(isset($livre)){echo e($livre['Prenom_Auteur']);}  ?>" class="form-control"
                id="inputZip">
        </div>
        <div class="col">
            <!-- Editeur -->
            <label>Editeur</label>
            <input type="text" name="editeur" value="<?php if(isset($livre)){echo e($livre['Editeur']);} ?>" class="form-control"
                id="inputZip">
        </div>
        <div class="col">
            <!-- Prix Livre -->
            <label>Prix Livre </label>
            <input type="number" name="prixLivre" class="form-control" value="<?php if(isset($livre)){echo e($livre['Prix_Livre']);} ?>"
                aria-label="Last name">
        </div>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

    <input type="hidden" name="controller" value="Livre">
    <?php
     if(isset($livre))
        {echo '<input type="hidden" name="action" value="Liste_Livres_Modif">';}
    else{echo'<input type="hidden" name="action" value="Liste_Livres_Ajouter">';} ?>

    <!-- ENVOI CODE livre -->
    <input type="hidden" name="ISBN" value="<?php if(isset($livre)){echo e($livre['ISBN']);}else{echo('202020202020');} ?>">
</form>