<?php
/* --- DÉFINITION DE LA CLASSE MODEL --- */
class Model
{

    // Nous créons une variable private bd,  ce qui veut dire qu'elle ne sera utilisable que dans la classe Model, donc ici
    private $bd;

    //$instance est private et static car elle n'est accessible que dans la classe Model, et correspond à l'objet instancié 
    private static $instance = null;


    // Dans le constructeur, nous allons établir la connexion à la base de données
    private function __construct()
    {

        /* --- On définit les variable de base, nom base de données (dsn) le login et le password (mot de passe) */
        $dsn = 'mysql:host=localhost;dbname=gestionlibrairie';
        $login = "root";
        $password = "";

        // La façon de se connecter ici est différente de celle dont on a l'habitude. Car on utilise la variable base de données, qui va pouvoir être utilisé dans les autres fonctions. 
        // De cette façon pas besoin de se reconnecter encore et encore à chaque méthode
        $this->bd = new PDO($dsn, $login, $password); //Connexion à la base de données
        $this->bd->query('SET NAMES utf8');
        $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Pour pouvoir récupérer une instance, comme la variable est privée, il faut utiliser un get_model(). 
    public static function get_model()
    {

        // Si la variable $instance est null (donc par defaut), alors nous créons une nouvelle instance
        if (is_null(self::$instance)) {
            self::$instance = new Model();
        }

        // Si en revanche l'instance existe déjà, alors nous la retournons telle quel 
        return self::$instance;
    }

    /* -------------------------------------------------------------------------- */
    /*                                 TABLE LIVRE                                */
    /* -------------------------------------------------------------------------- */



    public function Get_Liste_Livres()
    {
        $request = "Select * from livre";

        $result = $this->bd->prepare($request);
        $result->execute();

        return $result->fetchall(PDO::FETCH_OBJ); //On envoie sous forme d'objet
    }

    public function Get_Auteurs()
    {
        $request = "Select Distinct Nom_Auteur,Prenom_Auteur from livre";

        $result = $this->bd->prepare($request);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_NUM); //on renvoie toutes les lignes
    }

    public function Get_Theme()
    {
        $request = "Select Distinct Theme_Livre from livre";

        $result = $this->bd->prepare($request);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC); //on renvoie toutes les lignes
    }

    public function Get_Liste_Livres_Auteur($nom_Auteur)
    {
        $request = 'Select `Titre_Livre` ,`Nom_Auteur` , `Prenom_Auteur` ,`Theme_Livre`,`Prix_Livre`, ISBN from livre where Nom_Auteur="' . $nom_Auteur . '";';
        $result = $this->bd->prepare($request);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ------------------------------ MODIFICATION ------------------------------ */

    // Récupération des données d'un fournisseur spécifique
    public function Get_Livres_Modifier($livreEdit){ 
        $request = 'Select * from livre WHERE ISBN=CONVERT("' . $livreEdit . '", UNSIGNED INTEGER);';

        $result = $this->bd->prepare($request);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }



    // Modification des données d'une commande spécifique
    public function Set_Livres_Modifier($titreLivre, $themeLivre, $nomAuteur, $prenomAuteur,  $editeur, $prixLivre, $isbn){
        // Requête pour update toutes les valeurs (excepté le codeFournisseur) d'un livre selon l'ISBN fourni
        $request = 'UPDATE livre
        SET
            Titre_Livre="' . $titreLivre . '",'.
            'Theme_Livre="' . $themeLivre . '",'.
            'Nom_Auteur="' . $nomAuteur . '",'.
            'Prenom_Auteur="' . $prenomAuteur . '", '.
            'Editeur="' . $editeur . '", '.
            'Prix_Livre="' . $prixLivre . '"'.
            'WHERE ISBN=CONVERT("' . $isbn . '", UNSIGNED INTEGER);';

        $result = $this->bd->prepare($request);
        $result->execute();

        /** On return la fonction Get_Liste_Livres pour eviter de retaper et refaire une requête.
         *  En appelant la fonction sur le return, on update la base de données, puis on retourne la table mise à jour*/ 
        $this->Update_Historique("livre",$isbn, "modification");
        //Enregistre dans la table Historique la modification effectuée
        return $this->Get_Liste_Livres();
    }

    /* ------------------------------- SUPPRESSION ------------------------------ */
    public function Remove_Livre($ISBN){
        $request = 'DELETE FROM livre WHERE ISBN=CONVERT("' . $ISBN . '", UNSIGNED INTEGER);';//Requête permettant d'effacer le livre

        $result = $this->bd->prepare($request);
        $result->execute();

        $this->Update_Historique("livre", $ISBN, "suppression");
        return $this->Get_Liste_Livres();
    }

    /* -------------------------------------------------------------------------- */
    /*                               TABLE COMMANDE                               */
    /* -------------------------------------------------------------------------- */


    public function Get_Liste_Commandes()
    {
        // Dans cette fonction nous voulons récupérer toutes les commandes de la table Commandes
        // Nous écrivons donc la requête dans $request, ce sera la seule chose qui va changer entre les fonctions
        $request = "Select commander.ISBN, commander.Num_Commande, fournisseur.Raison_Sociale, Livre.Titre_Livre from commander, livre, fournisseur WHERE livre.ISBN = commander.ISBN and fournisseur.code_fournisseur = commander.code_fournisseur";

        // Les deux lignes ci-dessous, vont d'abord préparer la requête, avant de l'executer
        $result = $this->bd->prepare($request);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
        // Cette ligne au dessus est importante! le PDO::FETCH_ASSOC est l'équivalent du mysqli_fetch_assoc, on pourra donc récupérer les valeur en tapant le nom de la variable et non en mettant un indice.
        
    }

    public function Get_Commande_Date()
    {
        // Dans cette fonction nous voulons récupérer tout les livres de la table Livre
        // Nous écrivons donc la requête dans $request, ce sera la seule chose qui va changer entre les fonctions
        $request = "Select Distinct Date_Achat from commander";

        // Les deux lignes ci-dessous, vont d'abord préparer la requête, avant de l'executer
        $result = $this->bd->prepare($request);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
        // Cette ligne au dessus est importante! le PDO::FETCH_ASSOC est l'équivalent du mysqli_fetch_assoc, on pourra donc récupérer les valeur en tapant le nom de la variable et non en métant un indice.
        // Pour plus de clareté sur ce point, allez dans view_ListeLivres.php
    }

    public function Get_Liste_Commandes_Date($date){
        // Dans cette fonction nous voulons récupérer tout les livres de la table Livre
        // Nous écrivons donc la requête dans $request, ce sera la seule chose qui va changer entre les fonctions
        $request = "Select commander.Num_Commande, commander.ISBN, fournisseur.Raison_Sociale, Livre.Titre_Livre from commander, livre, fournisseur WHERE livre.ISBN = commander.ISBN and fournisseur.code_fournisseur = commander.code_fournisseur and date_achat = $date";

        $result = $this->bd->prepare($request);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Insertion_Commande($Date_Achat,$prix_Achat,$code_Fournisseur,$ISBN){
        $request = 'INSERT INTO `commander`( `Date_Achat`, `Prix_Achat`, `ISBN`, `Code_Fournisseur`) VALUES ("'.$Date_Achat.'","'.$prix_Achat.'","'.$ISBN.'",".
        '.$code_Fournisseur.'")';
        $result = $this->bd->prepare($request);
        $result->execute();
        $this->Update_Historique("fournisseur",$code_Fournisseur,"Insertion");
        return $this->Get_Liste_Commandes();


    }

    /* ------------------------- FONCTIONS DE MODIFICATION ------------------------ */

    // Récupération des données d'un fournisseur spécifique
    public function Get_Commandes_Modifier($commandeEdit){ 
        $request = 'Select * from commander WHERE Num_Commande=CONVERT("' . intval($commandeEdit)  . '",UNSIGNED INTEGER);';

        $result = $this->bd->prepare($request);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Modification des données d'une commande spécifique
    public function Set_Commandes_Modifier($numCommande, $dateAchat, $prixAchat, $isbn, $codeFournisseur){
        // Requête pour update toutes les valeurs (excepté le codeFournisseur) du fournisseur défini par le code fournisseur fournis
        $request = 'UPDATE commander
        SET
            Date_Achat=CONVERT("' . $dateAchat . '", UNSIGNED INTEGER),'.
            'Prix_Achat=CONVERT("' . $prixAchat . '", DECIMAL),'.
            'ISBN=CONVERT("' . $isbn . '", UNSIGNED INTEGER),'.
            'Code_Fournisseur="' . $codeFournisseur . '" '.
            'WHERE Num_Commande="' . $numCommande . '";';

        $result = $this->bd->prepare($request);
        $result->execute();

        /** On return la fonction Get_Liste_Fournisseurs pour eviter de retaper et refaire une requête.
         *  En appelant la fonction sur le return, on update la base de données, puis on retourne la table mise à jour*/ 
        $this->Update_Historique("commander",$numCommande, "modification");
        return $this->Get_Liste_Commandes();
    }

    /* ------------------------------- SUPPRESSION ------------------------------ */
    public function Remove_Commande($numCommande){
        $request = 'DELETE FROM commander WHERE Num_Commande="' . $numCommande . '";';

        $result = $this->bd->prepare($request);
        $result->execute();

        $this->Update_Historique("commander", $numCommande, "suppression");
        return $this->Get_Liste_Commandes();
    }


    /* -------------------------------------------------------------------------- */
    /*                              TABLE FOURNISSEUR                             */
    /* -------------------------------------------------------------------------- */

    public function Get_Pays_Fournisseurs()
    {
        $request = "Select Distinct Pays from fournisseur";

        // Les deux lignes ci-dessous, vont d'abord préparer la requête, avant de l'executer
        $result = $this->bd->prepare($request);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function Get_Liste_Fournisseurs()
    {
        // Dans cette fonction nous voulons récupérer tout les livres de la table Livre
        // Nous écrivons donc la requête dans $request, ce sera la seule chose qui va changer entre les fonctions
        $request = "Select Raison_Sociale, Localite, Pays, Code_Fournisseur from fournisseur";

        // Les deux lignes ci-dessous, vont d'abord préparer la requête, avant de l'executer
        $result = $this->bd->prepare($request);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
        // Cette ligne au dessus est importante! le PDO::FETCH_ASSOC est l'équivalent du mysqli_fetch_assoc, on pourra donc récupérer les valeur en tapant le nom de la variable et non en métant un indice.
        // Pour plus de clareté sur ce point, allez dans view_ListeLivres.php
    }

    public function Get_Liste_Fournisseurs_Pays($pays)
    {
        $request = 'Select Code_Fournisseur, Raison_Sociale, Localite, Pays from fournisseur where fournisseur.Pays="' . $pays . '";';
        $result = $this->bd->prepare($request);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }


    /* ------------------------- FONCTIONS DE MODIFICATION ------------------------ */

    // Récupération des données d'un fournisseur spécifique
    public function Get_Fournisseurs_Modifier($fournisseurEdit){ 
        $request = 'Select * from fournisseur WHERE Code_Fournisseur="' . $fournisseurEdit . '";';

        $result = $this->bd->prepare($request);
        $result->execute();

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Modification des données d'un fournisseur spécifique
    public function Set_Fournisseurs_Modifier($codeFournisseur, $raisonSociale, $rueFournisseur, $codePostal, $localite, $pays){
        // Requête pour update toutes les valeurs (excepté le codeFournisseur) du fournisseur défini par le code fournisseur fournis
        $request = 'UPDATE fournisseur
        SET
        Raison_Sociale="' . $raisonSociale . '", ' .
            'Rue_Fournisseur="' . $rueFournisseur . '", ' .
            'Code_Postal="' . $codePostal . '", ' .
            'Localite="' . $localite . '", ' .
            'Pays="' . $pays . '" '.
            'WHERE Code_Fournisseur="' . $codeFournisseur . '";';

        $result = $this->bd->prepare($request);
        $result->execute();

        /** On return la fonction Get_Liste_Fournisseurs pour eviter de retaper et refaire une requête.
         *  En appelant la fonction sur le return, on update la base de données, puis on retourne la table mise à jour*/ 
        $this->Update_Historique("fournisseur",$codeFournisseur, "modification");
        return $this->Get_Liste_Fournisseurs();
    }


    /* ------------------------------- SUPPRESSION ------------------------------ */

    public function Remove_Fournisseur($codeFournisseur){
        $request = 'DELETE FROM fournisseur WHERE Code_Fournisseur="' . $codeFournisseur . '"';

        $result = $this->bd->prepare($request);
        $result->execute();

        $this->Update_Historique("fournisseur", $codeFournisseur, "suppression");
        return $this->Get_Liste_Fournisseurs();
    }


    /* -------------------------------- INSERTION ------------------------------- */

	public function Insertion_Fournisseur($codeFournisseur, $raisonSociale, $rueFournisseur, $codePostal, $localite, $pays)
    {
        $request = "INSERT INTO `fournisseur`(`Code_Fournisseur`, `Raison_Sociale`, `Rue_Fournisseur`, `Code_Postal`, `Localite`, `Pays`) VALUES (".$codeFournisseur.",".$raisonSociale.",".$rueFournisseur.",".$codePostal.",".$localite.",".$pays.")";
        $result = $this->bd->prepare($request);
        $result->execute();
        $this->Update_Historique("fournisseur",$codeFournisseur,"Insertion");
        return $this->Get_Liste_Fournisseurs();

    }
    //Fonction permettant l'ajout d'un livre dans la base de données
    public function Set_Livres_Ajouter($titreLivre, $themeLivre, $nomAuteur, $prenomAuteur, $editeur, $prixLivre)
    {
        $request = 'INSERT INTO `livre`(`ISBN`, `Titre_Livre`, `Theme_Livre`, `Nom_Auteur`, `Prenom_Auteur`, `Editeur`, `Prix_Livre`)
                    VALUES("",
                        "'. $titreLivre .'",
                        "'. $themeLivre .'", 
                        "'. $nomAuteur .'",
                        "'. $prenomAuteur .'",
                        "'. $editeur .'", 
                        "'. $prixLivre .'")';
        $result = $this->bd->prepare($request);
        $result->execute();
        $this->Update_Historique("livre",$titreLivre,"Ajout Livre");
        return $this->Get_Liste_Livres();
    }


    /* -------------------------------------------------------------------------- */
    /*                            HISTORIQUE D'UPDATES                            */
    /* -------------------------------------------------------------------------- */

    //Fonction permettant d'enregistrer dans la table Historique les modifs effectués sur une table donnée en paramètre
    public function Update_Historique($table,$idTable,$typeModif)
    {
        $request = 'INSERT INTO historique_modification (Type_Modif,Nom_Table,Id_Table) VALUES ("'.$typeModif.'","'.$table.'","'.$idTable.'");';
        $result = $this->bd->prepare($request);
        $result->execute();
    }
}