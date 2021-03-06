<?php

namespace GameBundle\Entity;

/**
 * Challenge
 */
class Challenge
{

    ##########################################
    ########## Generate Code #################
    ##########################################
    
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $type;

    /**
     * @var integer
     */
    private $duree;

    /**
     * @var \DateTime
     */
    private $dateCreate;

    /**
     * @var \GameBundle\Entity\Image
     */
    private $images;

    /**
     * @var \UserBundle\Entity\User
     */
    private $user_meneur;

    /**
     * @var \UserBundle\Entity\User
     */
    private $user_createur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Challenge
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
     * Set description
     *
     * @param string $description
     *
     * @return Challenge
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Challenge
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set duree
     *
     * @param integer $duree
     *
     * @return Challenge
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return integer
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set dateCreate
     *
     * @param \DateTime $dateCreate
     *
     * @return Challenge
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return \DateTime
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * Set images
     *
     * @param \GameBundle\Entity\Image $images
     *
     * @return Challenge
     */
    public function setImages(\GameBundle\Entity\Image $images = null)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get images
     *
     * @return \GameBundle\Entity\Image
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set userMeneur
     *
     * @param \UserBundle\Entity\User $userMeneur
     *
     * @return Challenge
     */
    public function setUserMeneur(\UserBundle\Entity\User $userMeneur = null)
    {
        $this->user_meneur = $userMeneur;

        return $this;
    }

    /**
     * Get userMeneur
     *
     * @return \UserBundle\Entity\User
     */
    public function getUserMeneur()
    {
        return $this->user_meneur;
    }

    /**
     * Set userCreateur
     *
     * @param \UserBundle\Entity\User $userCreateur
     *
     * @return Challenge
     */
    public function setUserCreateur(\UserBundle\Entity\User $userCreateur = null)
    {
        $this->user_createur = $userCreateur;

        return $this;
    }

    /**
     * Get userCreateur
     *
     * @return \UserBundle\Entity\User
     */
    public function getUserCreateur()
    {
        return $this->user_createur;
    }

    /**
     * Add user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return Challenge
     */
    public function addUser(\UserBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \UserBundle\Entity\User $user
     */
    public function removeUser(\UserBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
