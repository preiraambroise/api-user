<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\User;
use JMS\Serializer\Annotation as Serializer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Rapport
 *
 * @ORM\Table(name="rapport")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RapportRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class Rapport
{   
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code_chantier", type="string", length=255)
     * @Serializer\Expose
     */
    private $CodeChantier;

    /**
     * @var bool
     *
     * @ORM\Column(name="succes", type="boolean")
     * @Serializer\Expose
     */
    private $succes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     * @Serializer\Expose
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="text")
     * @Serializer\Expose
     */
    private $commentaire;
    
    /**
     *
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="rapports")
     * @ORM\JoinColumn(nullable = true)
     */
    private $user;

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
     * Set CodeChantier
     *
     * @param string $CodeChantier
     *
     * @return Rapport
     */
    public function setCodeChantier($CodeChantier)
    {
        $this->CodeChantier = $CodeChantier;

        return $this;
    }

    /**
     * Get CodeChantier
     *
     * @return string
     */
    public function getCodeChantier()
    {
        return $this->CodeChantier;
    }

    /**
     * Set succes
     *
     * @param boolean $succes
     *
     * @return Rapport
     */
    public function setSucces($succes)
    {
        $this->succes = $succes;

        return $this;
    }

    /**
     * Get succes
     *
     * @return bool
     */
    public function getSucces()
    {
        return $this->succes;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Rapport
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Rapport
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set user
     *
     * @param User $user
     *
     * @return Rapport
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }
}
