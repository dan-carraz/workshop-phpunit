<?php

namespace App\Tests;

use App\User;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 * @package App\Tests
 */
class UserTest extends TestCase
{
    public function testSetPasswordReturnsTrueWhenPasswordSuccessfullySet()
    {
        $user = new User([]);

        $password = 'fubar';

        $result = $user->setPassword($password);

        $this->assertTrue($result);
    }

    public function testGetUserReturnsUserWithExpectedValues()
    {
        $user = new User([]);

        $password = 'fubar';

        $user->setPassword($password);

        $expectedPasswordResult = '5185e8b8fd8a71fc80545e144f91faf2';

        $currentUser = $user->getUser();

        $this->assertEquals($expectedPasswordResult, $currentUser['password']);
    }

    public function testSetPasswordReturnsFalseWhenPasswordLengthIsTooShort()
    {
        $user = new User([]);

        $password = 'fub';

        $result = $user->setPassword($password);

        $this->assertFalse($result);
    }

    public function testPrivateCryptPasswordFunction()
    {
        $user = new User([]);

        $password = $this->invokeMethod($user, 'cryptPassword', array('fubar'));

        $this->assertEquals('5185e8b8fd8a71fc80545e144f91faf2', $password);
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}



