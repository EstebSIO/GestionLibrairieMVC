<!-- La dérnière partie et la plus simple! qui sera l'affichage de la page affichant les données
    Tout se fait sous la forme html/php comme on a vu jusqu'ici  -->  

<head>
    <title>Liste Livre</title>
</head>
<body>
    <h1>Liste Livre</h1>
        <!-- La seule particularité se trouve ici Si on se rapelle de la fonction render, le deuxième paramètre $data comporte les données à afficher -->
        <!-- Dans Controller_Livre, nous avions les lignes:

        $liste_Livre = [ "livres" => $model -> Get_Liste_Livres() ];
        $this -> render("Liste_Livres", $livres);

        Lorsque nous voulons afficher cette page, nous avons la variable $liste_Livre qui est accessible contenant donc tout les livres de la table livre ( de la base de données)
        pour les afficher un par un sous forme de liste, nous utilisons les trois lignes de code ci-dessous
    
        RAPPEL! En dessous vous voyez écrit $livres, c'es parce que dans la fonction render nous avons un extract, ainsi nous pouvons écrire la clé pour avoir la valeur de celle-ci
        et ici la clé est Livres  ([ "livres" => $model -> Get_Liste_Livres() ]) 
                                        ↑
                                       clé
    -->
   
    <table class="table table-striped table-hover">
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Genre</th>
            <th>Prix</th>
            <th></th>
        </tr>

        <?php $livreCpt = 1;
            foreach($livres as $livre): ?>
            
            <!-- La ligne ci-dessous, nous permet de récupérer le titre de chaque livre de la table en utilisant $livre['Titre_Livre'] (on le peut grace au PDO::FETCH_ASSOC) -->
            <tr>
                <td><?= $livre->Titre_Livre ?></td> <!-- on récupère le titre livre dans l'objet -->
                <td><?= $livre->Nom_Auteur?></td>
                <td><?= $livre->Theme_Livre?></td>
                <td><?= $livre->Prix_Livre?></td>
                <td>
                    <form action="" method="get">
                        <button class="btn btn-outline-secondary" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg>
                        </button>
                        <input type="hidden" name="controller" value="Livre">
                        <input type="hidden" name="action" value="Modification_Livre">
                        <input type="hidden" name="ISBNLivre" value="<?= e($livre -> ISBN); ?>">
                        
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#livre<?= $livreCpt ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </button>
                    </form>
                        
                        
                    
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="livre<?= $livreCpt ?>" tabindex="-1" aria-labelledby="livre<?= $livreCpt ?>Label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="livre<?= $livreCpt ?>Label">Suppression de livre</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Êtes vous sûr de vouloir supprimer <?= $livre->Titre_Livre ?>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"  data-bs-dismiss="modal" aria-label="Close">Annuler</button>

                            <form action="" method="get">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                <input type="hidden" name="controller" value="Livre">
                                <input type="hidden" name="action" value="Suppression_Livre">
                                <input type="hidden" name="ISBNLivreSupp" value="<?= e($livre -> ISBN); ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php $livreCpt += 1;
            endforeach ?>

        
    </table>
</body>
</html>