<?php 
class Livre
{
        /**
         * numéro du livre
         *
         * @var int
         */
    private $num; 

    /**
     * titre du livre
     *
     * @var string
     */
    private $titre;


    /**
     * isbn du livre
     *
     * @var string
     */
    private $isbn;

        /**
     * prix du livre
     *
     * @var string
     */
    private $prix;

        /**
     * editeur du livre
     *
     * @var string
     */
    private $editeur;

        /**
     * annee du livre
     *
     * @var string
     */
    private $annee;

        /**
     * langue du livre
     *
     * @var string
     */
    private $langue;

        /**
     * numAuteur du livre
     *
     * @var string
     */
    private $numAuteur;

        /**
     * isbn du numGenre
     *
     * @var string
     */
    private $numGenre;




    public function getNum()
    {
    return $this->num;
    }




    /**
     * lit le titre
     *
     * @return string
     */
    public function getTitre() : string
    {
    return $this->titre;
    }

    /**
     * ecrit dans le titre
     *
     * @param string $titre
     * @return self
     */
    public function setTitre(string $titre): self
    {
    $this->titre = $titre;
    return $this;
    }




    /**
     * lit le isbn
     *
     * @return string
     */
    public function getIsbn() : string
    {
    return $this->isbn;
    }

    /**
     * ecrit dans le isbn
     *
     * @param string $isbn
     * @return self
     */
    public function setIsbn(string $isbn): self
    {
    $this->isbn = $isbn;
    return $this;
    }

    

        /**
     * lit le PRIX
     *
     * @return string
     */
    public function getPrix() : string
    {
    return $this->prix;
    }

    /**
     * ecrit dans le prix
     *
     * @param string $prix
     * @return self
     */
    public function setPrix(string $prix): self
    {
    $this->prix = $prix;
    return $this;
    }
    

        /**
     * lit le editeur
     *
     * @return string
     */
    public function getEditeur() : string
    {
    return $this->editeur;
    }

    /**
     * ecrit dans le editeur
     *
     * @param string $editeur
     * @return self
     */
    public function setEditeur(string $editeur): self
    {
    $this->editeur = $editeur;
    return $this;
    }
    

        /**
     * lit le annee
     *
     * @return string
     */
    public function getAnnee() : string
    {
    return $this->annee;
    }

    /**
     * ecrit dans le annee
     *
     * @param string $annee
     * @return self
     */
    public function setAnnee(string $annee): self
    {
    $this->annee = $annee;
    return $this;
    }
    

        /**
     * lit le langue
     *
     * @return string
     */
    public function getLangue() : string
    {
    return $this->langue;
    }

    /**
     * ecrit dans le langue
     *
     * @param string $lague
     * @return self
     */
    public function setLangue(string $langue): self
    {
    $this->langue = $langue;
    return $this;
    }
    

        /**
     * lit le numAuteur
     *
     * @return string
     */
    public function getNumAuteur() : string
    {
    return $this->numAuteur;
    }

    /**
     * ecrit dans le numAuteur
     *
     * @param string $numAuteur
     * @return self
     */
    public function setNumAuteur(string $numAuteur): self
    {
    $this->numAuteur = $numAuteur;
    return $this;
    }
       

        /**
     * lit le numGenre
     *
     * @return string
     */
    public function getNumGenre() : string
    {
    return $this->numGenre;
    }

    /**
     * ecrit dans le numGenre
     *
     * @param string $numGenre
     * @return self
     */
    public function setNumGenre(string $numGenre): self
    {
    $this->numGenre = $numGenre;
    return $this;
    }
    

    /**
     * Retourne l'ensembe des livre
     *
     * @return Livre[] tableau d'objet livre
     */
    public static function findAll() :array
    {
        $req = MonPdo::getInstance()->prepare("SELECT livre.num, livre.isbn, livre.titre, livre.prix, livre.editeur, livre.annee, livre.langue, auteur.nom as 'NomAuteur', genre.libelle as 'GenreLibelle' FROM livre, auteur, genre WHERE livre.numAuteur = auteur.num AND livre.numGenre = genre.num");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'livre');
        $req->execute();
        $lesResultats=$req->fetchALL();
        return $lesResultats;
    }


    /**
     * Trouve un livre par son num
     *
     * @param integer $id numéro du livre
     * @return Livre objet livre trouvé
     */
    public static function findById(int $id) :Livre
    {
        $req=MonPdo::getInstance()->prepare("select * from livre where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Livre');
        $req->bindParam(':id',$id);
        $req->execute();
        $lesResultats=$req->fetch();
        return $lesResultats;
    }


    /**
     * Permet d'ajouter un livre
     *
     * @param Livre $livre contient à ajouter
     * @return integer 1 si l'oppération a reussi 0 si elle a fail
     */
    public static function add(Livre $livre) :int 
    {
        $isbn= $livre->getIsbn();
        $titre=$livre->gettitre();
        $req=MonPdo::getInstance()->prepare("insert into livre(titre,isbn,prix,editeur,annee,langue,numAuteur,numGenre) values(:titre, :isbn, :prix, :editeur, :annee, :langue, :numAuteur, :numGenre)");
        $req->bindParam(':titre',$titre);
        $req->bindParam(':isbn', $isbn); // Utiliser l'ID du continent
        $nb=$req->execute();
        return $nb;
    }

    /**
     * permet de modifier le livre
     *
     * @param Livre $livre livre à modifié
     * @return integer 1 si l'oppération a reussi 0 si elle a fail
     */
    public static function update(Livre $livre) :int 
    {
        $req=MonPdo::getInstance()->prepare("update livre set titre= :titre, isbn= :isbn, prix= :prix, editeur= :editeur, annee= :annee, langue= :langue, numAuteur= :numAuteur, numGenre= :numGenre where num= :id");
        $num=$livre->getNum();
        $titre=$livre->gettitre();
        $req->bindParam(':id',$num);
        $req->bindParam(':titre',$titre);
        $isbn= $livre->getIsbn();
        $req->bindParam(':isbn', $isbn); // Utiliser l'ID du continent
        $nb=$req->execute();
        return $nb;
    }

    /**
     * permet de supprimer ton contient
     *
     * @param Livre $livre livre à supprimer
     * @return integer 1 si l'oppération a reussi 0 si elle a fail
     */
    public static function delete(Livre $livre): int 
    {
        $num = $livre->getNum();
        $req = MonPdo::getInstance()->prepare("delete from livre where num= :id");
        $req->bindParam(':id', $num);
        $nb = $req->execute();
        return $nb;
    }




    /**
     * Set the value of num
     */



    /**
     * Set the value of num
     */
    public function setNum($num): self
    {
        $this->num = $num;

        return $this;
    }
}


?>