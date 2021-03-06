<?php

namespace GameBundle\Entity;

/**
 * Image
 */
class Image
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
    private $src;

    /**
     * @var boolean
     */
    private $validee;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $lat;

    /**
     * @var string
     */
    private $lng;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var \UserBundle\Entity\User
     */
    private $users;


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
     * Set src
     *
     * @param string $src
     *
     * @return Image
     */
    public function setSrc($src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Get src
     *
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * Set validee
     *
     * @param boolean $validee
     *
     * @return Image
     */
    public function setValidee($validee)
    {
        $this->validee = $validee;

        return $this;
    }

    /**
     * Get validee
     *
     * @return boolean
     */
    public function getValidee()
    {
        return $this->validee;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Image
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
     * Set lat
     *
     * @param string $lat
     *
     * @return Image
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param string $lng
     *
     * @return Image
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return string
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Image
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set users
     *
     * @param \UserBundle\Entity\User $users
     *
     * @return Image
     */
    public function setUsers(\UserBundle\Entity\User $users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return \UserBundle\Entity\User
     */
    public function getUsers()
    {
        return $this->users;
    }
}
