<?php
class Continent {

    /** numero du continent
     * @var int
     */
    private $num;

    /**
     * Libelle du continent
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
    public function setLibelle(string $libelle) : self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Retourne ensemble continents
     *
     * @return Continent[] tableau objet continent
     */
    public static function findAll() :array
    {
        $req=MonPdo::getInstance()->prepare("Select * from continent ");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Continent');
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats;
    }

    /**
     * Trouve un continent par son num
     *
     * @param integer $id numéro continent 
     * @return Continent objet continent find 
     */
    public static function findById(int $id) :Continent
    {
        $req=MonPdo::getInstance()->prepare("Select * from continent where num= :id ");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Continent');
        $req->bindParam(':id', $id);
        $req->execute();
        $leResultat=$req->fetch();
        return $leResultat;
    }

    /**
     * ajout d'un continent
     *
     * @param Continent $continent à add 
     * @return integer resultat (1 si result reussi 0 si fail)
     */
    public static function add(Continent $continent) :int
    {
        $req=MonPdo::getInstance()->prepare("Insert into continent(libelle) values(:libelle) ");
        $req->bindParam(':libelle', $continent->getLibelle());
        $nb=$req->execute();
        return $nb;
    }

    /**
     * modif continent 
     *
     * @param Continent $continent à modif 
     * @return integer resultat (1 si result reussi 0 si fail)
     */
    public static function update(Continent $continent) :int
    {
        $req=MonPdo::getInstance()->prepare("update continent set libelle= :libelle where num= :id ");
        $req->bindParam(':id', $continent->getNum());
        $req->bindParam(':libelle', $continent->getLibelle());
        $nb=$req->execute();
        return $nb;
    }

    /**
     * supp continent 
     *
     * @param Continent $continent
     * @return integer
     */
    public static function delete(Continent $continent) :int 
    {
        $req=MonPdo::getInstance()->prepare("delete from continent where num= :id ");
        $req->bindParam(':id', $continent->getNum());
        $nb=$req->execute();
        return $nb;
    }
}

?>