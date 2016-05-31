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
    private static $CONNECTION_WINDOW = 300; // 5 minutes
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(name="connectionToken", type="string", length=255, nullable=true)
     */
    private $connectionToken;
    
    /**
     * @ORM\Column(name="connectionRequestTime", type="datetime", nullable=true)
     */
    private $connectionRequestTime;
    
    /**
     * @ORM\ManyToMany(targetEntity="PortfolioBundle\Entity\Task", inversedBy="users")
     */
    private $tasks;
    
    public function __construct()
    {
        parent::__construct();
        $this->setPassword(\uniqid('', true));
    }
    
    public function setEmail($email) {
      parent::setEmail($email);
      if($this->getUsername() == null) {
        $this->setUsername($email);
      }
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

    /**
     * Set connectionToken
     *
     * @param string $connectionToken
     *
     * @return User
     */
    public function setConnectionToken($connectionToken)
    {
        $this->connectionToken = $connectionToken;
        $this->setConnectionRequestTime(new \DateTime());

        return $this;
    }

    /**
     * Get connectionToken
     *
     * @return string
     */
    public function getConnectionToken()
    {
        return $this->connectionToken;
    }

    /**
     * Set connectionRequestTime
     *
     * @param \DateTime $connectionRequestTime
     *
     * @return User
     */
    public function setConnectionRequestTime($connectionRequestTime)
    {
        $this->connectionRequestTime = $connectionRequestTime;

        return $this;
    }

    /**
     * Get connectionRequestTime
     *
     * @return \DateTime
     */
    public function getConnectionRequestTime()
    {
        return $this->connectionRequestTime;
    }
    
    public function connect($token) {
      if ($this->getConnectionToken() != null && $this->getConnectionRequestTime() != null)
      {
        return strcmp($this->getConnectionToken(), $token) == 0 && (new \DateTime())->getTimestamp() - $this->getConnectionRequestTime()->getTimestamp() < User::$CONNECTION_WINDOW;
      }
    }
}
