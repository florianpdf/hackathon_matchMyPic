<?php

namespace GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * Image
 */
class Image
{
    public $file;

    protected function getUploadDir()
    {
        return 'uploads/promotion';
    }

    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../web/' . $this->getUploadDir();
    }

    public function getWebPath()
    {
        return null === $this->src ? null : $this->getUploadDir() . '/' . $this->src;
    }

    public function getAbsolutePath()
    {
        return null === $this->src ? null : $this->getUploadRootDir() . '/' . $this->src;
    }

    /**
     * @ORM\PrePersist
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // do whatever you want to generate a unique name
            $this->src = uniqid() . '.' . $this->file->guessExtension();
        }
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        // Add your code here
    }

    /**
     * @ORM\PrePersist
     */
    public function setExpiresAtValue()
    {
        // Add your code here
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        // Add your code here
    }

    /**
     * @ORM\PostPersist
     */
    public function upload()
    {
        if (null === $this->file) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->file->move($this->getUploadRootDir(), $this->src);

        unset($this->file);
    }

    /**
     * @ORM\PostRemove
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

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
     * @var \GameBundle\Entity\Challenge
     */
    private $challenges;

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
     * Set challenges
     *
     * @param \GameBundle\Entity\Challenge $challenges
     *
     * @return Image
     */
    public function setChallenges(\GameBundle\Entity\Challenge $challenges = null)
    {
        $this->challenges = $challenges;

        return $this;
    }

    /**
     * Get challenges
     *
     * @return \GameBundle\Entity\Challenge
     */
    public function getChallenges()
    {
        return $this->challenges;
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
