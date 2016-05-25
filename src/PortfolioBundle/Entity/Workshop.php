<?php

namespace PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Workshop
 *
 * @ORM\Table(name="workshop")
 * @ORM\Entity(repositoryClass="PortfolioBundle\Repository\WorkshopRepository")
 */
class Workshop
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;
    
    /**
     * @ORM\OnetoMany(targetEntity="PortfolioBundle\Entity\Domain", mappedBy="workshop")
     */
    private $domains;


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
     * Set name
     *
     * @param string $name
     *
     * @return Workshop
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
     * Constructor
     */
    public function __construct()
    {
        $this->domains = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add domain
     *
     * @param \PortfolioBundle\Entity\Domain $domain
     *
     * @return Workshop
     */
    public function addDomain(\PortfolioBundle\Entity\Domain $domain)
    {
        $this->domains[] = $domain;

        return $this;
    }

    /**
     * Remove domain
     *
     * @param \PortfolioBundle\Entity\Domain $domain
     */
    public function removeDomain(\PortfolioBundle\Entity\Domain $domain)
    {
        $this->domains->removeElement($domain);
    }

    /**
     * Get domains
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDomains()
    {
        return $this->domains;
    }
}
