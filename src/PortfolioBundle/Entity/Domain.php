<?php

namespace PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Domain
 *
 * @ORM\Table(name="domain")
 * @ORM\Entity(repositoryClass="PortfolioBundle\Repository\DomainRepository")
 */
class Domain
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
     * @ORM\OneToMany(targetEntity="PortfolioBundle\Entity\Task", mappedBy="domain")
     */
    private $tasks;
    
    /**
     * @ORM\ManyToOne(targetEntity="PortfolioBundle\Entity\Workshop", inversedBy="domains")
     */
    private $workshop;


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
     * @return Domain
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
        $this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add task
     *
     * @param \PortfolioBundle\Entity\Task $task
     *
     * @return Domain
     */
    public function addTask(\PortfolioBundle\Entity\Task $task)
    {
        $this->tasks[] = $task;

        return $this;
    }

    /**
     * Remove task
     *
     * @param \PortfolioBundle\Entity\Task $task
     */
    public function removeTask(\PortfolioBundle\Entity\Task $task)
    {
        $this->tasks->removeElement($task);
    }

    /**
     * Get tasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTasks()
    {
        return $this->tasks;
    }

    /**
     * Set workshop
     *
     * @param \PortfolioBundle\Entity\Workshop $workshop
     *
     * @return Domain
     */
    public function setWorkshop(\PortfolioBundle\Entity\Workshop $workshop = null)
    {
        $this->workshop = $workshop;

        return $this;
    }

    /**
     * Get workshop
     *
     * @return \PortfolioBundle\Entity\Workshop
     */
    public function getWorkshop()
    {
        return $this->workshop;
    }
}
