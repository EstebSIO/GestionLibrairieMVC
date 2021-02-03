<?php   

    /*
        Dans ce fichier nous trouveront la classe mère des controller.
        Elle va contenir des fonctions par défault des classes filles 
    */

    // Cette classe est définie comme abstraite car elle contient une méthode sans opération (la fonction action_default)
    abstract class Controller{ 

        // La fonction action_default est abstraite car elle va être écraser dans les autres classes
        // En clair chaque classe fille aura une fonction action_default qui lui sera propre
        abstract public function action_default();

        // Ici nous avons la fonction construct, qui va permettre d'instancier un objet de la classe Controller
        // Donc par exemple : $controller = New Controller()
        public function __construct(){
            // Lorsque nous allons instancier un objet, nous allons regarder cette fois ci la variable action envoyée à la page par la méthode GET
            // Comme pour $_GET['controller'] dans l'index, nous allons regarder ici si la variable existe, et si une methode à son nom existe

            // Exemple $_GET['action'] = Liste_Livres
            // On regarde donc si la méthode action_Liste_Livres existe ou non 
            if( isset($_GET['action']) and method_exists($this, "action_" . $_GET["action"]) ){

                // <!-- Petite remarque: on a un $this ici, parce que chaque controller créé aura la définition des actions lui correspondant dans sa classe --!>
                // <!-- Par exemple, l'action action_Liste_Livres sera définie dans la classe Controller_Livre

                $action = "action_" . $_GET["action"]; //Le nom de l'action va donc prendre la forme action_Liste_Livre si on poursuit l'exemple

                // une fois le nom de l'action défini, nous l'appelons afin qu'elle soit exécutée
                $this -> $action();

                // <!-- Il ne faut pas oublier que nous sommes dans de la programmation Orientée objet, quand vous voyez un $this, il se réfère à l'objet instancié
                //  Donc un objet de la classe Controller_Livre n'appellera pas une fonction action_nomAction de la classe Controller_Commande! --!>
            }
            else{
                // Si le fichier n'existe pas, ou que l'action recherchée n'existe pas, alors nous appelons l'action par défaut de la classe fille
                // *Rappel la classe fille (exemple -> Controller_Livre) possède toujours une fonction action_default() qui écrase celle de la class mère (Controller)
                $this -> action_default();
            }

        }

        // La deuxième fonction de la classe controller sera render, qui va servir à retourner au routeur, la vue correspondant aux données que nous souhaitons afficher
        // Petit plus pour expliquer pourquoi on met protected, c'est pour dire que la fonction render n'est accessible que dans une classe fille
        //  Si on veut écrire par exemble dans l'index $controller.render(...) ça ne fonctionnera pas.
        protected function render($vue, $data = []){
            //En paramètre nous auront la vue que nous voulons afficher, ainsi que les données ($data) que nous voulons afficher sur celle-ci

            // On commence par traiter les datas, la fonction extract va nous permettre de pouvoir récupérer des données en utilisant un mot (c'est compliqué à expliquer comme ça, je mets un exemple en dessous)

            /* $var_array = array("color" => "blue",
                   "size"  => "medium",
                   "shape" => "sphere")

                extract($var_array)

                Après le extract, si nous voulons par exemple récupérer la valeur de la clé "color", nous pouvons simplement écrire $color, car après le extract $color a la valeur "blue"

                Cette propriété nous est surtout utile pour l'affichage des données dans les fichiers des views. Plus de détails dans Controller_Livre.php et view_Liste_Livres.php
            */
            extract($data);

            // $file_name va prendre le chemin pour acceder fichier vue à appeler en afficher
            $file_name = "Views/view_" . $vue . ".php";

            //On vérifie donc que le fichier existe bien 
            if(file_exists($file_name)){
                // si c'est le cas, nous allons l'afficher avec la méthode require
                require($file_name);
            }
            else{
                //Sinon nous appelons la méthode action_error qui va afficher un message d'erreur. [ Fonction action_error si dessous]
                $this -> action_error("La vue n'existe pas !");
            }
        }


        // Simple action d'erreur, il va afficher la page view_Error.php en affichant le $message donné en variable 
        protected function action_error($message){

            // Ici on donne à la clé erreur, la valeur $message
            $data = [ 'erreur' => $message ];

            // On affiche la page d'erreur
            $this -> render('Error', $data);

            die();
        }
    }

?>