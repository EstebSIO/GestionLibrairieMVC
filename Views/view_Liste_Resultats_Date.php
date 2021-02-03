<head>
    <title>Liste Livre</title>
</head>
<body>
    <h1>Liste Livre</h1>
    <ul>
        <?php foreach($commandes as $commande): ?>
            <li> ISBN : <?= $commande['ISBN'] ?> Fournisseur : <?= $commande['Code_Fournisseur']?> </li>
        <?php endforeach ?>
    </ul>
    

</body>
</html>