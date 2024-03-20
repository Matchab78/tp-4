<?php
class Auteur {

    /**
    * numero de l'auteur
    * 
    * @var int
    */
    private $num;

    /**
    * libelle de l'auteur
    * 
    * @var string
    */
    private $libelle;

    /**
    * Get the value of num
    */ 
    public function getNum()
    {
    return $this->num;
    }

    /**
     * lit le libelle
     *
     * @return string
     */
    public function getLibelle() : string
    {
    return $this->libelle;
    }

    /**
     * ecrit dans le libelle
     *
     * @param string $libelle
     * @return self
     */
    public function setLibelle( string $libelle) : self
    {
    $this->libelle = $libelle;

    return $this;
    }


    public static function findAll() :array
    {
        $req=MonPdo::getInstance()->prepare("Select a.*, n.libelle from auteur a join nationalite n on a.numnationalite=n.num");
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats;
    }

    /**
     * Trouve un auteur par son num
     * 
     * @param integer $id numéro dd auteur
     * @return Auteur objet auteur trouvé
     */
    public static function findById(int $id) :Auteur 
    {
        $req=MonPdo::getInstance()->prepare("Select * from auteur where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Auteur');
        $req->bindParam(':id' , $id);
        $req->execute();
        $leResultat=$req->fetch();
        return $leResultat; 
    }

    /**
     * Permet d'ajouter un auteur
     *
     * @param Auteur $auteur auteur à ajouter
     * @return integer resultat (1 si l'opération a réussi, 0 sinon)
     */
    public static function add(auteur $auteur) :int
    {
        $req=MonPdo::getInstance()->prepare("insert into auteur(libelle) values(:libelle)");
        $req->bindParam(':libelle' , $auteur->getLibelle());
        $nb=$req->execute();
        return $nb; 
    }

    /**
     * Permet de modifier un auteur
     *
     * @param Auteur $auteur auteur a modifier
     * @return integer resultat (1 si l'opération a réussi, 0 sinon)
     */
    public static function update(Auteur $auteur) :int 
    {
        $req=MonPdo::getInstance()->prepare("update auteur set libelle= :libelle where num= :id");
        $req->bindParam(':id' , $auteur->getNum());
        $req->bindParam(':libelle' , $auteur->getLibelle());
        $nb=$req->execute();
        return $nb; 

    }

    /**
     * Permet de supprimer un auteur
     *
     * @param Auteur $auteur
     * @return integer
     */
    public static function delete(Auteur $auteur) :int
    {
        $req=MonPdo::getInstance()->prepare("delete from auteur where num= :id");
        $req->bindParam(':id' , $auteur->getNum());
        $nb=$req->execute();
        return $nb; 
    }


}

?>