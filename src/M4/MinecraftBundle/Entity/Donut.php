<?php
namespace M4\MinecraftBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="donut")
 */
class Donut
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $id_server;

    /**
     * @ORM\Column(type="integer")
     */
    protected $sum;

    /**
     * @ORM\Column(type="date")
     */
    protected $date_operation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $result=0;


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
     * Set id_server
     *
     * @param integer $idServer
     * @return Donut
     */
    public function setIdServer($idServer)
    {
        $this->id_server = $idServer;

        return $this;
    }

    /**
     * Get id_server
     *
     * @return integer
     */
    public function getIdServer()
    {
        return $this->id_server;
    }

    /**
     * Set sum
     *
     * @param integer $sum
     * @return Donut
     */
    public function setSum($sum)
    {
        $this->sum = $sum;

        return $this;
    }

    /**
     * Get sum
     *
     * @return integer
     */
    public function getSum()
    {
        return $this->sum;
    }


    /**
     * Set date_operation
     *
     * @param \DateTime $dateOperation
     * @return Donut
     */
    public function setDateOperation($dateOperation)
    {
        $this->date_operation = $dateOperation;

        return $this;
    }

    /**
     * Get date_operation
     *
     * @return \DateTime 
     */
    public function getDateOperation()
    {
        return $this->date_operation;
    }

    /**
     * Set result
     *
     * @param integer $result
     * @return Donut
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return integer 
     */
    public function getResult()
    {
        return $this->result;
    }
}
