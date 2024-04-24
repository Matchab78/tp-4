<?php
class Genre {

    /** numero du genre
     * @var int
     */
    private $num;

    /**
     * Libelle du genre
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
     * Retourne ensemble genres
     *
     * @return Genre[] tableau objet genre
     */
    public static function findAll() :array
    {
        $req=MonPdo::getInstance()->prepare("Select * from genre ");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Genre');
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats;
    }

    /**
     * Trouve un genre par son num
     *
     * @param integer $id numéro genre 
     * @return Genre objet genre find 
     */
    public static function findById(int $id) :Genre
    {
        $req=MonPdo::getInstance()->prepare("Select * from genre where num= :id ");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Genre');
        $req->bindParam(':id', $id);
        $req->execute();
        $leResultat=$req->fetch();
        return $leResultat;
    }

    /**
     * ajout d'un genre
     *
     * @param Genre $genre à add 
     * @return integer resultat (1 si result reussi 0 si fail)
     */
    public static function add(Genre $genre) :int
    {
        $req=MonPdo::getInstance()->prepare("Insert into genre(libelle) values(:libelle) ");
        $libelle=$genre->getLibelle();
        $req->bindParam(':libelle', $libelle);
        $nb=$req->execute();
        return $nb;
    }

    /**
     * modif genre 
     *
     * @param Genre $genre à modif 
     * @return integer resultat (1 si result reussi 0 si fail)
     */
    public static function update(Genre $genre) :int
    {
        $req=MonPdo::getInstance()->prepare("update genre set libelle= :libelle where num= :id ");
        $num=$genre->getNum();
        $libelle=$genre->getLibelle();
        $req->bindParam(':id', $num);
        $req->bindParam(':libelle', $libelle);
        $nb=$req->execute();
        return $nb;
    }

    /**
     * supp genre 
     *
     * @param Genre $genre
     * @return integer
     */
    public static function delete(Genre $genre) :int 
    {
        $req=MonPdo::getInstance()->prepare("delete from genre where num= :id ");
        $req->bindParam(':id', $genre->getNum());
        $nb=$req->execute();
        return $nb;
    }


    /**
     * Set the value of num
     *
     * @param  int  $num
     *
     * @return  self
     */ 
    public function setNum(int $num) :self
    {
        $this->num = $num;

        return $this;
    }
}

?>