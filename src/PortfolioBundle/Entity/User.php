<?php

namespace PortfolioBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToMany(targetEntity="PortfolioBundle\Entity\Task", inversedBy="users")
     */
    private $tasks;
    
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Add task
     *
     * @param \PortfolioBundle\Entity\Task $task
     *
     * @return User
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
}
