<?php

require_once 'DatabaseInterface.php';
require_once 'RepositoryInterface.php';
require_once 'User.php';

class UserRepository implements RepositoryInterface
{
    private DatabaseInterface $databaseInterface;
    public function __construct(DatabaseInterface $dataBaseInterface)
    {
        $this->databaseInterface = $dataBaseInterface;
    }

    public function getUser(string $userEmail): User
    {
        foreach ($this->getUsers() as $user) {
            if ($user["email"] === $userEmail) {
                var_dump(new User(
                    $user["full_name"],
                    $user["email"]
                ));
                return new User(
                    $user["full_name"],
                    $user["email"]
                );
            }
        }

        return new User('Inconnu', $userEmail);
    }



    public function getUsers(): array
    {
        $users = $this->databaseInterface->fetchAll();
        return $users;
    }
}