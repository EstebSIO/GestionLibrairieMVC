<head>
    <title>Selecteur fournisseur par type d'information</title>
</head>
<body>
<form action='' method='get'>
    <h3>Sélectionnez un pays</h3>
    <select class="form-select" name='pays' size='<?php echo (count($fournisseurs))?>'>
        <?php foreach($Pays as $Pays): ?>
            <option value="<?= $Pays['Pays']?>"><?= $Pays['Pays']?></option>
        <?php endforeach?>
    </select>
    <input type="submit" class="btn btn-primary" Value="Afficher">
    <input type="hidden" name="controller" value="Fournisseur">
    <input type="hidden" name="action" value="Liste_Fournisseurs_Pays">
</form>
</body>
