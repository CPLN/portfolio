<?php

namespace PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Task
 *
 * @ORM\Table(name="task")
 * @ORM\Entity(repositoryClass="PortfolioBundle\Repository\TaskRepository")
 */
class Task
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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="goal", type="string", length=255)
     */
    private $goal;

    /**
     * @var int
     *
     * @ORM\Column(name="duration", type="integer")
     */
    private $duration;

    /**
     * @var string
     *
     * @ORM\Column(name="material", type="text", nullable=true)
     */
    private $material;

    /**
     * @var int
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var bool
     *
     * @ORM\Column(name="mandatory", type="boolean")
     */
    private $mandatory;
    
    /**
     * @ORM\ManyToOne(targetEntity="PortfolioBundle\Entity\Domain", inversedBy="tasks")
     */
    private $domain;

    /**
     * @ORM\ManyToMany(targetEntity="PortfolioBundle\Entity\User", mappedBy="tasks")
     */
    private $users;
    
    /**
     * @ORM\ManyToMany(targetEntity="PortfolioBundle\Entity\Task", inversedBy="childrenTasks")
     */
    private $parentTasks;
    
    /**
     * @ORM\ManyToMany(targetEntity="PortfolioBundle\Entity\Task", mappedBy="parentTasks")
     */
    private $childrenTasks;

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
     * Set description
     *
     * @param string $description
     *
     * @return Task
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
     * Set goal
     *
     * @param string $goal
     *
     * @return Task
     */
    public function setGoal($goal)
    {
        $this->goal = $goal;

        return $this;
    }

    /**
     * Get goal
     *
     * @return string
     */
    public function getGoal()
    {
        return $this->goal;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     *
     * @return Task
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set material
     *
     * @param string $material
     *
     * @return Task
     */
    public function setMaterial($material)
    {
        $this->material = $material;

        return $this;
    }

    /**
     * Get material
     *
     * @return string
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return Task
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set mandatory
     *
     * @param boolean $mandatory
     *
     * @return Task
     */
    public function setMandatory($mandatory)
    {
        $this->mandatory = $mandatory;

        return $this;
    }

    /**
     * Get mandatory
     *
     * @return bool
     */
    public function getMandatory()
    {
        return $this->mandatory;
    }

    /**
     * Set domain
     *
     * @param \PortfolioBundle\Entity\Domain $domain
     *
     * @return Task
     */
    public function setDomain(\PortfolioBundle\Entity\Domain $domain = null)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return \PortfolioBundle\Entity\Domain
     */
    public function getDomain()
    {
        return $this->domain;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add user
     *
     * @param \PortfolioBundle\Entity\User $user
     *
     * @return Task
     */
    public function addUser(\PortfolioBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \PortfolioBundle\Entity\User $user
     */
    public function removeUser(\PortfolioBundle\Entity\User $user)
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

    /**
     * Add parentTask
     *
     * @param \PortfolioBundle\Entity\Task $parentTask
     *
     * @return Task
     */
    public function addParentTask(\PortfolioBundle\Entity\Task $parentTask)
    {
        $this->parentTasks[] = $parentTask;

        return $this;
    }

    /**
     * Remove parentTask
     *
     * @param \PortfolioBundle\Entity\Task $parentTask
     */
    public function removeParentTask(\PortfolioBundle\Entity\Task $parentTask)
    {
        $this->parentTasks->removeElement($parentTask);
    }

    /**
     * Get parentTasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParentTasks()
    {
        return $this->parentTasks;
    }

    /**
     * Add childrenTask
     *
     * @param \PortfolioBundle\Entity\Task $childrenTask
     *
     * @return Task
     */
    public function addChildrenTask(\PortfolioBundle\Entity\Task $childrenTask)
    {
        $this->childrenTasks[] = $childrenTask;

        return $this;
    }

    /**
     * Remove childrenTask
     *
     * @param \PortfolioBundle\Entity\Task $childrenTask
     */
    public function removeChildrenTask(\PortfolioBundle\Entity\Task $childrenTask)
    {
        $this->childrenTasks->removeElement($childrenTask);
    }

    /**
     * Get childrenTasks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildrenTasks()
    {
        return $this->childrenTasks;
    }
}
