<?php
// On récupère le fournisseur dans le tableau 
$fournisseur = $fournisseur[0];
?>

<h2>Modification du fournisseur <?php echo e($fournisseur['Raison_Sociale']) .' ('. e($fournisseur['Code_Fournisseur']) .')'; ?></h2>


<!-- FORMULAIRE DE MODIFICATION DES DONNÉES--> 
<form action="">

    <div class="row">
        <div class="col">
            <!-- RAISON SOCIALE -->
            <label>Raison Sociale</label>
            <input type="text" name="raisonSociale" class="form-control"
                value="<?php echo e($fournisseur['Raison_Sociale']); ?>" aria-label="First name">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <!-- RUE FOURNISSEUR -->
            <label>Rue </label>
            <input type="text" name="rue" class="form-control" value="<?php echo e($fournisseur['Rue_Fournisseur']); ?>"
                aria-label="Last name">
        </div>
    </div>

    <div class="row">
        <div class="col">
            <!-- CODE POSTAL -->
            <label>Code Postal</label>
            <input type="text" name="codePostal" value="<?php echo e($fournisseur['Code_Postal']); ?>"
                class="form-control" id="inputZip">
        </div>
        <div class="col">
            <!-- LOCALITÉ -->
            <label>Localité</label>
            <input type="text" name="localite" value="<?php echo e($fournisseur['Localite']); ?>" class="form-control"
                id="inputZip">
        </div>
        <div class="col">
            <!-- PAYS -->
            <label>Pays</label>
            <input type="text" name="pays" value="<?php echo e($fournisseur['Pays']); ?>" class="form-control"
                id="inputZip">
        </div>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-success">Modifier</button>
    </div>

    <input type="hidden" name="controller" value="Fournisseur">
    <input type="hidden" name="action" value="Liste_Fournisseurs_Modif">

    <!-- ENVOI CODE FOURNISSEUR -->
    <input type="hidden" name="codeFournisseur" value="<?php echo e($fournisseur['Code_Fournisseur']);?>">
</form>