<?php

namespace App\Entity;

use Core\Entity\Hydrate;

abstract class UserEntity extends Hydrate
{

    /**
     * @var integer
     */
    protected int $id;

    /**
     * @var string
     */
    protected string $name;

    /**
     * @var string
     */
    protected string $password;

    /**
     * @var string
     */
    protected string $email;

    /**
     * @var string
     */
    protected string $role;

    /**
     * @var string
     */
    protected string $date;

    /**
     * @var string
     */
    protected string $token;

    /**
     * @var string
     */
    protected string $expirationDate;

    /**
     * @var string
     */
    protected string $validation;


    /**
     * @return string
     */
    public function getExpirationDate(): string
    {
        return $this->expirationDate;

    }


    /**
     * @param string $expirationDate
     * @return $this
     */
    public function setExpirationDate(string $expirationDate): self
    {
        $this->expirationDate = $expirationDate;
        return $this;

    }


    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;

    }


    /**
     * @param string $token
     * @return $this
     */
    public function setToken(string $token): self
    {
        $this->token = $token;
        return $this;

    }


    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;

    }


    /**
     * @param string $date
     * @return $this
     */
    public function setDate(string $date): self
    {
        $this->date = $date;
        return $this;

    }


    /**
     * @return integer
     */
    public function getId(): int
    {
        return $this->id;

    }


    /**
     * @param integer $id
     * @return $this
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;

    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;

    }


    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;

    }


    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;

    }


    /**
     * @param string $password
     * @return $this
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;

    }


    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;

    }


    /**
     * @param string $email
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;

    }


    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;

    }


    /**
     * @param string $role
     * @return $this
     */
    public function setRole(string $role): self
    {
        $this->role = $role;
        return $this;

    }


    /**
     * @return string
     */
    public function getValidation(): string
    {
        return $this->validation;

    }


    /**
     * @param string $validation
     * @return $this
     */
    public function setValidation(string $validation): self
    {
        $this->validation = $validation;
        return $this;

    }


}
