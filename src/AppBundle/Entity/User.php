<?php
/**
 * Created by PhpStorm.
 * User: Alberto
 * Date: 29/09/2016
 * Time: 16:57
 */
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 * @UniqueEntity("email")
 */
class User implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=5)
     *
     */
    private $username;
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     * @Assert\Email( message = "The email '{{ value }}' is not a valid email.")
     */
    private $email;
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=5)
     *
     */
    private $password;

    /**
     * @ORM\Column(name="salt", type="string", length=40)
     */
    private $salt;
    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    /**
     * @ORM\Column(type="json_array")
     */
    private $roles = array();
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
        $this->isActive = true;
        $this->salt = md5(uniqid(null, true));
    }
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
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
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
    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
    /**
     * Get name
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * Add items
     *
     * @param \AppBundle\Entity\Book $books
     * @return User
     */
    public function addItem(\AppBundle\Entity\Book $books)
    {
        $this->books[] = $books;
        return $this;
    }
    /**
     * Remove items
     *
     * @param \AppBundle\Entity\Book $books
     */
    public function removeItem(\AppBundle\Entity\Book $books)
    {
        $this->books->removeElement($books);
    }
    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItems()
    {
        return $this->books;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }





    public function getRoles()
    {
        return $this->roles;
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }
    public function eraseCredentials()
    {
    }

    public function getSalt()
    {
        return $this->salt;
    }
}