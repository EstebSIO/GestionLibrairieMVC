<?php
// On récupère le fournisseur dans le tableau 
$commande = $commande[0];
?>

<h2>Modification de la commande N°<?php echo e($commande['Num_Commande']) ?></h2>


<!-- FORMULAIRE DE MODIFICATION DES DONNÉES--> 
<form action="">

    <div class="row">
        <div class="col">
            <!-- Code Fournisseur -->
            <label>Code Fournisseur</label>
            <input type="text" name="codeFournisseur" class="form-control"
                value="<?php echo e($commande['Code_Fournisseur']); ?>" aria-label="First name">
        </div>
        <div class="col">
            <!-- RUE FOURNISSEUR -->
            <label>ISBN Livre </label>
            <input type="number" name="ISBN" class="form-control" value="<?php echo e($commande['ISBN']); ?>"
                aria-label="Last name">
        </div>
        <div class="col">
            <!-- Date Achat -->
            <label>Date Achat</label>
            <input type="number" name="dateAchat" value="<?php echo e($commande['Date_Achat']); ?>"
                class="form-control" id="inputZip">
        </div>
        <div class="col">
            <!-- LOCALITÉ -->
            <label>Prix Achat (&euro;)</label>
            <input type="text" name="prixAchat" value="<?php echo e($commande['Prix_Achat']); ?>" class="form-control"
                id="inputZip">
        </div>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

    <input type="hidden" name="controller" value="Commande">
    <input type="hidden" name="action" value="Liste_Commandes_Modif">

    <!-- ENVOI CODE FOURNISSEUR -->
    <input type="hidden" name="numCommande" value="<?php echo e($commande['Num_Commande']);?>">
</form>