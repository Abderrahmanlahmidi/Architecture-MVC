<?php

class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private Role $role;

    private PDO $connection;



    public function __construct(PDO $connexion)
    {
        $this -> connexion = $connexion;
    }

    public function getConnection(): PDO{
        return $this -> connexion;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function displayUsers()
    {
        $sql = "SELECT * FROM mvcdb.user INNER JOIN learnifydb.role ON role_id = role.id";

        $stmt = $this -> connection -> prepare($sql);

        $stmt -> execute();

        $users = $stmt -> fetchAll();

    }


}