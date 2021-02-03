<?php
    /* --- Controller_Commande une classe fille de la classe Controller --- */

    class Controller_Commande extends Controller{

        
        public function action_default(){
            $this -> action_Liste_Commandes();
        }

        
        public function action_Liste_Commandes(){

            $model = Model::get_model();

            $liste_Commandes = [ "commandes" => $model -> Get_Liste_Commandes() ];

            $liste_Date_Achat = [ "datesCommandes" => $model -> Get_Commande_Date()];

            $this -> render("Liste_Commandes", array_merge($liste_Commandes, $liste_Date_Achat));

        }
        public function action_Liste_Commandes_Date(){
            $model = Model::get_model();

            $liste_Commandes = [ "commandes" => $model -> Get_Liste_Commandes_Date($_GET["commande"])];
            $this -> render("Liste_Commandes_Date", $liste_Commandes);

        }
        //Action permettant l'affichage de la page d'affichage de la liste de dates des commandes existantes
        public function action_Liste_Commandes_Date_Selecteur(){
            $model = Model::get_model();
            $liste_Date_Achat = [ "datesCommandes" => $model -> Get_Commande_Date()];
            $this -> render("Liste_Commandes_Date_Selecteur", $liste_Date_Achat);

        }

        // Action redirigeant vers la page de modification
        public function action_Modification_Commande()
        {   
            $model = Model::get_model();

            // Appel de la fonction de récupération des données du fournisseur en question
            $commande = ["commande" => $model->Get_Commandes_Modifier($_GET['numCommande'])];

            $this->render("Liste_Commandes_Modif", $commande);
        }

        // Action de modification des données
        public function action_Liste_Commandes_Modif()
        {
            $model = Model::get_model();

            // Appel de la fonction d'update des valeurs et récupération de la table mise à jour [La fonction set retourn la table updaté directement]
            $commandes = ["commandes" => $model->Set_Commandes_Modifier($_GET['numCommande'], $_GET['dateAchat'], $_GET['prixAchat'], $_GET['ISBN'], $_GET['codeFournisseur'])];

            // Affichage de la table fournisseur mise à jour
            $this->render("Liste_Commandes", $commandes);
        }

        /* ---------------------------- SUPPRESSION Commande --------------------------- */

        public function action_Suppression_Commande()
        {   
            $model = Model::get_model();

            // Appel de la fonction de récupération des données du fournisseur en question
            $Commande = ["commandes" => $model->Remove_Commande($_GET['numCommandeSupp'])];

            $this->render("Liste_commandes", $Commande);
        }
    }

?>