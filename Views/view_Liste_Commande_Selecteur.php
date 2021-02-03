<head>
    <title>Recherche des commande par date</title>
</head>
<body>
    <h1>Recherche des commandes</h1>

    <form action='' method='get'>
    <select name='commande'>
        <option  value="">--Choisissez une date ou un fournisseur--</option>
        <?php foreach($datesCommandes as $dateCommande): ?>
            <option value="<?= $dateCommande['Date_Achat']?>"><?= $dateCommande['Date_Achat']?></option>
        <?php endforeach?>
    </select>
    
    <input type="submit"Value="Afficher">
    <input type="hidden" name="controller" value="Commande">
    <input type="hidden" name="action" value="Liste_Commandes_Date">
    </form>

    <ul>
        <?php foreach($commandes as $commande): ?>
            <li> ISBN : <?= $commande['ISBN'] ?> Fournisseur : <?= $commande['Code_Fournisseur']?> </li>
        <?php endforeach ?>
    </ul>
    

</body>
</html>