<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="Content/css/style.css">
    </head>
    <body>
        <?php 

        /*
            La page index.html dans le modèle MVC va servir de routeur. 
            C'est à dire que c'est elle qui va envoyer des requêtes aux controllers pour l'affichage des données.
            Pour le permettre, nous allons utiliser la méthode GET, qui sera gérée dans le header
        */

        /* --- On commence par charger les fichiers dont nous auront besoin. --- */
            require_once("Utils/functions.php"); // Contient la fonction e
            require_once("Models/Model.php"); // On charge la classe Model qui répertorie toutes les actions à réaliser (plus de détail dans le fichier Model.php )
            require_once("Controllers/Controller.php"); // On charge également la classe principale des controllers

        /* --- On inclue les header et footer --- */
            
            // Le fichier header.html
            include("Content/html/header.html");

        /* --- GESTION DES REQUÊTES DES CONTROLLERS --- */

            // On commence par créer un tableau qui va contenir le nom de chaque controller que nous allons faire
            $controllers = ["Home", "Livre", "Commande", "Fournisseur", "Entete"];

            //Nous choisissons un controller par défaut qui affichera la page d'acceuil
            $controller_default = "Home";


        //-- Pour gérer la requête des controllers à faire, la méthode est simple.

            // On commence par d'abord regarder si des données ont été transmises par la méthode get(ajout de variable dans l'url tel que: "www.site.fr?variable=valeur")  
            if(isset($_GET['controller']) and in_array($_GET['controller'], $controllers)){
                //Si la variable controller a été set, donc existe, contient une valeur (isset) et si cette même valeur fait partie de la liste de controller (in_array)
                // Alors la variable $nom_controller va récupérer la valeur transmise, donc le nom du controller que nous souhaitons atteindre
                $nom_controller = $_GET['controller'];
            }
            else{

                // Si en revanche, la variable controller n'est pas set, ou alors que sa valeur ne fait pas partie de la liste des controller
                // La variable $nom_controller prendra la valeur du controller par defaut défini plus tôt
                $nom_controller = $controller_default;
            }

        // Une fois la récupération du nom du controller faite, nous créons deux nouvelles variables.
            $nom_classe = 'Controller_'.$nom_controller; // Nom classe, pour la création du controller plus bas 
            //
            
            $nom_fichier = "Controllers/".$nom_classe.".php"; // Nom du fichier qui nous permettra d'aller chercher le fichier du controller souhaité

        // Dernière étape, trouver le controller souhaité. On commence par vérifier l'existence du fichier en question
            if( file_exists($nom_fichier)){
                // Si il existe bien, nous allons le charger, et créer un objet controller à partir de la classe qui convient
                require_once($nom_fichier); 
                // On utilise require_once pour des questions de performance, si la page est chargée une fois, on la garde en mémoire. Les autre chargements sont donc plus fluides
                
                $controller = new $nom_classe();
                // Comme précisé, pour créer l'objet, on utilise le nom de la classe voulu. 
                // Exemple: Si nous voulons afficher les livres, nous allons utiliser la classe Controller_Livres
            }
            else{
                //Si la page n'est pas trouver, nous affichons donc "page not found !" ici
                exit("page not found !");
            } 

            /* --- POUR UNE COMPRÉHENSION PLUS SIMPLE POUR LA SUITE, PASSER DANS LE FICHIER Controller.php --- */
        include("Content/html/footer.html"); ?>
    </body>
</html>