<?php
namespace M4\MinecraftBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="mc_server")
 */
class Mc_server
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $ip;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $ver;

    /**
     * @ORM\Column(type="string", length=400)
     */
    protected $description;

    /**
     * @ORM\Column(type="integer")
     */
    protected $balls;

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $color;

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $website;

    /**
     * @ORM\Column(type="integer")
     */
    protected $rating;

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $location;

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
     * Set name
     *
     * @param string $name
     * @return Mc_server
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set ip
     *
     * @param string $ip
     * @return Mc_server
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set ver
     *
     * @param string $ver
     * @return Mc_server
     */
    public function setVer($ver)
    {
        $this->ver = $ver;

        return $this;
    }

    /**
     * Get ver
     *
     * @return string 
     */
    public function getVer()
    {
        return $this->ver;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Mc_server
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
     * Set balls
     *
     * @param integer $balls
     * @return Mc_server
     */
    public function setBalls($balls)
    {
        $this->balls = $balls;

        return $this;
    }

    /**
     * Get balls
     *
     * @return integer 
     */
    public function getBalls()
    {
        return $this->balls;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return Mc_server
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Mc_server
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     * @return Mc_server
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Mc_server
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }
}
