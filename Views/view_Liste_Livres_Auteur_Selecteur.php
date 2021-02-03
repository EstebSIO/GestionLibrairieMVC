<body>

    <form action='' method='get'>
        <h5>Choisissez un auteur</h5>
        <select class='form-select' name='auteur' size='<?php echo (count($auteurs)) ?>'?>
            <?php foreach($auteurs as $auteur): ?>
                <option value="<?=e($auteur[0])?>"><?= e($auteur[0])?> <?= e($auteur[1])?></option> <!-- On récupère les valeurs dans le tableau de chaque ligne-->
            <?php endforeach?>
        </select>
        <input type="submit" class="btn btn-primary" value="Afficher">
        <input type="hidden" name="controller" value="Livre">
        <input type="hidden" name="action" value="Liste_Livres_Auteur">
    </form>
</body>
</html>