<?php
class Nationalite {

    /** numero de la nationalite
     * @var int
     */
    private $num;

    /**
     * Libelle de la nationalite
     *
     * @var string
     */
    private $libelle;

    /**
     * num continent (clé étrangère) relié à un num continent
     * 
     * @var int
     */
    private $numContinent;
    

    /**
     * Get the value of num
     */ 
    public function getNum()
    {
        return $this->num;
    }


    /**
     * ecrit dans le libelle
     *
     * @param string $libelle
     * @return self
     */
    public function setNum(string $libelle) : self
    {
        $this->libelle = $libelle;

        return $this;
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
     * renvoie obj continent associé 
     *
     * @return Continent
     */
    public function getNumContinent() :Continent
    {
        return Continent::findById($this->numContinent);
    }


    /**
     * écrit num continent
     *
     * @param Continent $continent
     * @return self
     */
    public function setNumContinent(Continent $continent) : self
    {
        $this->numContinent = $continent->getNum();

        return $this;
    }

    /**
     * Retourne ensemble nationalite
     *
     * @return Nationalite[] tableau objet nationalite
     */
    public static function findAll() :array
    {
        $req=MonPdo::getInstance()->prepare("select n.num as numero, n.libelle as 'libNation', c.libelle as 'libContinent' from nationalite n left join continent c on n.numContinent=c.num");
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats;
    }

    /**
     * Trouve une nationalite par son num
     *
     * @param integer $id numéro nationalite 
     * @return Nationalite objet nationalite find 
     */
    public static function findById(int $id) :Nationalite
    {
        $req=MonPdo::getInstance()->prepare("Select * from nationalite where num= :id ");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Nationalite');
        $req->bindParam(':id', $id);
        $req->execute();
        $leResultat=$req->fetch();
        return $leResultat;
    }

    /**
     * ajout d'une nationalite
     *
     * @param Nationalite $nationalite à add 
     * @return integer resultat (1 si result reussi 0 si fail)
     */
    public static function add(Nationalite $nationalite) :int
    {
        $req=MonPdo::getInstance()->prepare("Insert into nationalite(libelle, numContinent) values(:libelle, :numContinent) ");
        $libelle=$nationalite->getLibelle();
        $req->bindParam(':libelle', $libelle);
        $nat=null; //$nationalite->getNumContinent()
        $req->bindParam(':numContinent', $nat);
        $nb=$req->execute();
        return $nb;
    }

    /**
     * modif nationalite 
     *
     * @param Nationalite $nationalite  à modif 
     * @return integer resultat (1 si result reussi 0 si fail)
     */
    public static function update(Nationalite $nationalite) :int
    {
        $req=MonPdo::getInstance()->prepare("update nationalite set libelle= :libelle, numContinent= :numContinent where num= :id ");
        $num = $nationalite->getNum();
        $libelle = $nationalite->getLibelle();
        $nat = $nationalite->getNumContinent()->getNum();
        $req->bindParam(':id', $num);
        $req->bindParam(':libelle', $libelle);
        $req->bindParam(':numContinent', $nat);
        $nb=$req->execute();
        return $nb;
    }

    /**
     * supp nationalite 
     *
     * @param Nationalite $nationalite
     * @return integer
     */
    public static function delete(Nationalite $nationalite) :int 
    {
        $req=MonPdo::getInstance()->prepare("delete from nationalite where num= :id ");
        $req->bindParam(':id', $nationalite->getNum());
        $nb=$req->execute();
        return $nb;
    }

}

?>