<?php
/* --- Controller_Fournisseur une classe fille de la classe Controller --- */

class Controller_Fournisseur extends Controller
{


    public function action_default()
    {
        $this->action_Liste_Fournisseurs();
    }

    public function action_Liste_Fournisseurs()
    {
        $model = Model::get_model();
        $liste_Fournisseurs = ["fournisseurs" => $model->Get_Liste_Fournisseurs()];
        $liste_Pays = ["Pays" => $model->Get_Pays_Fournisseurs()];
        $this->render("Liste_Fournisseurs", array_merge($liste_Pays, $liste_Fournisseurs));
    }

    public function action_Liste_Fournisseurs_Pays()
    {
        $model = Model::get_model();
        $liste_Fournisseurs = ["fournisseurs" => $model->Get_Liste_Fournisseurs_Pays($_GET['pays'])];
        $this->render("Liste_Fournisseurs_Pays", $liste_Fournisseurs);
    }

    public function action_Liste_Fournisseurs_Pays_Selecteur()
    {
        $model = Model::get_model();
        $liste_Pays = ["Pays" => $model->Get_Pays_Fournisseurs()];
        $this->render("Liste_Fournisseurs_Pays_Selecteur", $liste_Pays);
    }

    // Action redirigeant vers la page de modification
    public function action_Modification_Fournisseur()
    {   
        $model = Model::get_model();

        // Appel de la fonction de récupération des données du fournisseur en question
        $fournisseur = ["fournisseur" => $model->Get_Fournisseurs_Modifier($_GET['codeFournisseur'])];

        $this->render("Liste_Fournisseurs_Modif", $fournisseur);
    }

    // Action de modification des données
    public function action_Liste_Fournisseurs_Modif()
    {
        $model = Model::get_model();

        // Appel de la fonction d'update des valeurs et récupération de la table mise à jour [La fonction set retourn la table updaté directement]
        $fournisseurs = ["fournisseurs" => $model->Set_Fournisseurs_Modifier($_GET['codeFournisseur'], $_GET['raisonSociale'], $_GET['rue'], $_GET['codePostal'], $_GET['localite'], $_GET['pays'])];

        // Affichage de la table fournisseur mise à jour
        $this->render("Liste_Fournisseurs", $fournisseurs);
    }

    /* ---------------------------- SUPPRESSION Fournisseur --------------------------- */

    public function action_Suppression_Fournisseur()
    {   
        $model = Model::get_model();

        // Appel de la fonction de récupération des données du fournisseur en question
        $fournisseur = ["fournisseurs" => $model->Remove_Fournisseur($_GET['codeFournisseurSupp'])];

        $this->render("Liste_Fournisseurs", $fournisseur);
    }
}