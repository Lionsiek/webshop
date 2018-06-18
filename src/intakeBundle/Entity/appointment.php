<?php

namespace intakeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * appointment
 *
 * @ORM\Table(name="appointment")
 * @ORM\Entity(repositoryClass="intakeBundle\Repository\appointmentRepository")
 */
class appointment
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
     * @var string
     *
     * @ORM\Column(name="appointment_firstname", type="string", length=255)
     */
    private $firstName;


    /**
     * @var string
     *
     * @ORM\Column(name="appointment_lastname", type="string", length=255)
     */
    private $lastName;


    /**
     * @var string
     *
     * @ORM\Column(name="appointment_email", type="string", length=255)
     */
    private $email;


    /**
     * @var string
     *
     * @ORM\Column(name="telephone_number", type="string", length=255)
     */
    private $telephoneNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datepicker", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="string", length=255)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

//    /**
//     * @var string
//     *
//     * @ORM\Column(name="image_url", type="string", length=255, nullable=true)
//     */
//    private $imageUrl;


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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return appointment
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
     * Set category
     *
     * @param string $category
     *
     * @return appointment
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return appointment
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

//    /**
//     * Set imageUrl
//     *
//     * @param string $imageUrl
//     *
//     * @return appointment
//     */
//    public function setImageUrl($imageUrl)
//    {
//        $this->imageUrl = $imageUrl;
//
//        return $this;
//    }
//
//    /**
//     * Get imageUrl
//     *
//     * @return string
//     */
//    public function getImageUrl()
//    {
//        return $this->imageUrl;
//    }

    public function __toString()
    {
        return $this->getDescription();
    }


    /**
     * Set telephoneNumber
     *
     * @param string $telephoneNumber
     *
     * @return appointment
     */
    public function setTelephoneNumber($telephoneNumber)
    {
        $this->telephoneNumber = $telephoneNumber;

        return $this;
    }

    /**
     * Get telephoneNumber
     *
     * @return string
     */
    public function getTelephoneNumber()
    {
        return $this->telephoneNumber;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return appointment
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return appointment
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return appointment
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
