<?php

namespace App;

/**
 * Class User
 */
class User
{
    private const MIN_PASS_LENGTH = 4;

    private $user = [];

    /**
     * User constructor.
     *
     * @param array $user
     */
    public function __construct(array $user)
    {
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $password
     *
     * @return bool
     */
    public function setPassword(string $password): bool
    {
        if (strlen($password) < self::MIN_PASS_LENGTH) {
            return false;
        }

        $this->user['password'] = $this->cryptPassword($password);

        return true;
    }

    /**
     * @param string $password
     *
     * @return string
     */
    private function cryptPassword(string $password)
    {
        return md5($password);
    }
}
