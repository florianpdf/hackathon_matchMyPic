<?php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

class User extends BaseUser
{

    ##########################################
    ########## Generate Code #################
    ##########################################

    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var integer
     */
    private $score;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $chalenges;


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return User
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getNomPrenom()
    {
        return $this->prenom.' '.$this->nom;
    }
    /**
     * Set score
     *
     * @param integer $score
     *
     * @return User
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Add chalenge
     *
     * @param \GameBundle\Entity\Challenge $chalenge
     *
     * @return User
     */
    public function addChalenge(\GameBundle\Entity\Challenge $chalenge)
    {
        $this->chalenges[] = $chalenge;

        return $this;
    }

    /**
     * Remove chalenge
     *
     * @param \GameBundle\Entity\Challenge $chalenge
     */
    public function removeChalenge(\GameBundle\Entity\Challenge $chalenge)
    {
        $this->chalenges->removeElement($chalenge);
    }

    /**
     * Get chalenges
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChalenges()
    {
        return $this->chalenges;
    }
}
