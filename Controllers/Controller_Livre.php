<?php
    /* --- Controller_Livre une classe fille de la classe Controller --- */

    // La définition d'une classe fille est normal, sauf pour le extends qui sert à direr que la classe Controller_Livre va récupérer les méthodes de la classe Controller
    class Controller_Livre extends Controller{

        // On commence par définir l'action par défaut (action_default) qui va faire appel à la fonction action_Liste_Livre()
        // <!-- La fonction par default ne sera appelée que si une certaine méthode n'est pas trouvée --!>
        public function action_default(){
            $this -> action_Liste_Livres();
        }

        // Ici nous voyons la communication entre le Controller - Model, ainsi que la communication Controller - View
        // Nous prenoms l'action Liste Livre, qui va nous afficher tout les livres disponibles
        public function action_Liste_Livres(){

            //On commence par créer un objet de la classe Model
            // <!-- Pour rappel, la classe model va répertorier toutes les méthodes servant à accéder et récupérer des éléments de la base de données --!>
            // En créant un objet de la classe model, "créons" un accès aux fonctions de récupération de données dans la base
            $model = Model::get_model();

            // Ici nous allons créer un tableau qui va récupérer tout les livres de la base de donnée. Chaque ligne représentera un élément avec la clé "Livres"
            // La méthode Get_Liste_Livres() est définie dans la classe Model, allez voir dans Model.php pour voir ce qu'elle fait
            $liste_Livre = [ "livres" => $model -> Get_Liste_Livres() ];
            $liste_auteur = [ "auteurs" => $model -> Get_Auteurs() ];

            


            // Une fois les données récupérées sont envoyées afficher grâce à la méthode render. On lui donne le nom de la vue, ainsi que les datas du tableau $livres
            $this -> render("Liste_Livres", array_merge($liste_Livre,$liste_auteur));
        }
        
        public function action_Liste_Livres_Auteur(){
            $model = Model::get_model();
            $liste_Livre = [ "livres" => $model -> Get_Liste_Livres_Auteur($_GET['auteur']) ];
            $this -> render("Liste_Livres_Auteur", $liste_Livre);
        }

        public function action_Liste_Livres_Auteur_Selecteur(){
            $model = Model::get_model();
            $liste_Auteur = [ "auteurs" => $model -> Get_Auteurs() ];

            $this -> render("Liste_Livres_Auteur_Selecteur", $liste_Auteur);
        }

        /* --------------------------- MODIFICATIONS LIVRE -------------------------- */
        // Action redirigeant vers la page de modification
        public function action_Modification_Livre()
        {   
            $model = Model::get_model();

            // Appel de la fonction de récupération des données du fournisseur en question
            if(isset($_GET['ISBNLivre']))
            {
            $dataLivre = ["livre" => $model->Get_Livres_Modifier($_GET['ISBNLivre'])];
        }else{
        $dataLivre = [];
}
            $this->render("Liste_Livres_Modif", $dataLivre);
        }

        // Action de modification des données
        public function action_Liste_Livres_Modif()
        {
            $model = Model::get_model();

            // Appel de la fonction d'update des valeurs et récupération de la table mise à jour [La fonction set retourne la table updaté directement]
            $livres = ["livres" => $model->Set_Livres_Modifier($_GET['titreLivre'], $_GET['themeLivre'], $_GET['nomAuteur'], $_GET['prenomAuteur'], $_GET['editeur'], $_GET['prixLivre'], $_GET['ISBN'])];

            // Affichage de la table fournisseur mise à jour
            $this->render("Liste_Livres", $livres);
        }

        /* ---------------------------- SUPPRESSION LIVRE --------------------------- */

        public function action_Suppression_Livre()
        {   
            $model = Model::get_model();

            // Appel de la fonction de récupération des données du fournisseur en question
            $livre = ["livres" => $model->Remove_Livre($_GET['ISBNLivreSupp'])];

            $this->render("Liste_Livres", $livre);
        }
        public function action_Liste_Livres_Ajouter()
  {
      $model = Model::get_model();
      $liste_Livre = [ "livres" => $model -> Set_Livres_Ajouter(
            $_GET['titreLivre'],
            $_GET['themeLivre'],
            $_GET['nomAuteur'],
            $_GET['prenomAuteur'],
            $_GET['editeur'],
            $_GET['prixLivre']) ];
      $this -> render("Liste_Livres", $liste_Livre);
  }
    }

?>