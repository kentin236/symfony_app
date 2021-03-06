<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
	/**
	* @ORM\Id
	* @ORM\GeneratedValue
	* @ORM\Column(type="integer")
	*/
	private $id;
	
	/**
	* @ORM\Column(type="string", length=180, unique=true)
	*/
	private $username;

    /**
     * @var string
     * @ORM\Column(type="string", length=180, unique=true)
     */
	private $email;
	
	/**
	* @ORM\Column(type="json")
	*/
	private $roles = [];
	
	/**
	* @var string The hashed password
	* @ORM\Column(type="string")
	*/
	private $password;
	
	/**
	* @var string
	* @ORM\Column(type="string", unique=true, nullable=true)
	*/
	private $apiToken;
	
	/**
	 * @return array
	 */
    public function getInfos(): array
    {
	    return [
            'id' => $this->getId(),
	        'username' => $this->getUsername(),
		    'roles' => array_unique($this->getRoles()),
            'apiToken' => $this->getApiToken()
	    ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
      * A visual identifier that represents this user.
      * @see UserInterface
      */
    public function getUsername(): string
    {
       return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
       $this->username = $username;
       return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return (string) $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

	/**
	* @see UserInterface
	*/
	public function getRoles(): array
	{
		$roles = $this->roles;
		// guarantee every user at least has ROLE_USER
		$roles[] = 'ROLE_USER';
		return array_unique($roles);
	}

	public function setRoles(array $roles): self
	{
		$this->roles = $roles;
		return $this;
	}

	/**
	* @see UserInterface
	*/
	public function getPassword(): string
	{
		return (string) $this->password;
	}

	public function setPassword(string $password): self
	{
		$this->password = $password;
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getApiToken(): string
	{
		return (string) $this->apiToken;
	}
	
	/**
	 * @param string $apiToken
	 */
	public function setApiToken(string $apiToken): void
	{
		$this->apiToken = $apiToken;
	}

	/**
	* @see UserInterface
	*/
	public function getSalt()
	{
		// not needed when using the "bcrypt" algorithm in security.yaml
	}

	/**
	* @see UserInterface
	*/
	public function eraseCredentials()
	{
		// If you store any temporary, sensitive data on the user, clear it here
		// $this->plainPassword = null;
	}
}
