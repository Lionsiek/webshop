<?php
namespace intakeBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
/**
 * Factuur
 *
 * @ORM\Table(name="factuur")
 * @ORM\Entity(repositoryClass="intakeBundle\Repository\FactuurRepository")
 */
class Factuur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     *
     */
    private $userId;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetimetz")
     */
    private $date;
    protected $regels;
    public function __construct()
    {
        $this->regels = new ArrayCollection();
    }
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Factuur
     */
    public function setuserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }
    /**
     * Get userId
     *
     * @return int
     */
    public function getuserId()
    {
        return $this->userId;
    }
    /**
     * Set datum
     *
     * @param \DateTime $datum
     *
     * @return Factuur
     */
    public function setdate($date)
    {
        $this->date = $date;
        return $this;
    }
    /**
     * Get datum
     *
     * @return \DateTime
     */
    public function getdate()
    {
        return $this->date;
    }
    /**
     * @return ArrayCollection
     */
    public function getRegels()
    {
        return $this->regels;
    }
    /**
     * @param ArrayCollection $rgls
     */
    public function setRegels($regels)
    {
        $this->regels = $regels;
    }
    public function __toString()
    {
        return $this->getId().' '.$this->getuserId();
    }
}
