<?php

namespace App\Classes\DTO;

use App\User;

/**
 * Class UserDTO
 * @package App\Classes\DTO
 */
class UserDTO
{
    /**
     * @var
     */
    protected $name;
    /**
     * @var
     */
    protected $phone;
    /**
     * @var
     */
    protected $email;
    /**
     * @var User
     */
    protected $model;


    /**
     * UserDTO constructor.
     * @param User|null $user
     */
    public function __construct(?User $user = null)
    {
        if (!empty($user)) {
            $this->model = $user;
        } else {
            $this->model = new User;
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->model->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->model->email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->model->phone;
    }

    /**
     * @return string
     */
    public function getModel(): User
    {
        return $this->model;
    }

    /**
     * @param string $name
     * @return UserDTO
     */
    public function setName(string $name): UserDTO
    {
        $this->model->name = $name;
        return $this;
    }

    /**
     * @param string $email
     * @return UserDTO
     */
    public function setEmail(string $email): UserDTO
    {
        $this->model->email = $email;
        return $this;
    }

    /**
     * @param string $phone
     * @return UserDTO
     */
    public function setPhone(string $phone): UserDTO
    {
        $this->model->phone = $phone;
        return $this;
    }

    /**
     * @return bool
     */
    public function store(): UserDTO
    {
        $this->model->save();

        return $this;
    }
}
