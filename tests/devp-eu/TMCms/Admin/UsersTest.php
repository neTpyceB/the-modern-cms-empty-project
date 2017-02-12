<?php

namespace Tests\TMCms\Admin;

use TMCms\Admin\Users;
use TMCms\Admin\Users\Entity\AdminUser;
use TMCms\Admin\Users\Entity\AdminUserGroup;
use TMCms\Routing\Languages;

// Ensure DB exists
$users = new Users\Entity\AdminUserRepository();
$groups = new Users\Entity\AdminUserGroupRepository();

class UsersTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerateHash()
    {
        $pass = '';
        $test_hash = '8e4c54c19d2902a66650dd00dc45b04549a979c74cbd39d11a8e0ac3ac6b8a692fca0d40ee7174a98f8e60e6f148dc23b4ed6f4ef4319a6ac3d7886f484aee03';

        $generated_hash = Users::getInstance()->generateHash($pass);

        $this->assertEquals($test_hash, $generated_hash);
    }

    public function testIsLogged()
    {
        $res_not_logged = Users::getInstance()->isLogged();

        $this->assertFalse($res_not_logged);
    }

    public function testStartSession()
    {
        $test_user_id = 1;
        $sid = Users::getInstance()->startSession($test_user_id);

        $_SESSION['admin_sid'] = $sid;

        $this->assertTrue(is_string($sid));
    }

    public function testDeleteSession()
    {
        $test_user_id = 1;

        // Check with session
        $sid = Users::getInstance()->startSession($test_user_id);
        $_SESSION['admin_sid'] = $sid;
        $res = Users::getInstance()->deleteSession($test_user_id);

        $this->assertTrue($res);

        // Check again after removed
        unset($_SESSION['admin_sid']);
        $res = Users::getInstance()->deleteSession($test_user_id);

        $this->assertTrue($res);
    }

    public function testGetUserLng()
    {
        // Get first existing language
        $languages = Languages::getPairs();
        if (!$languages) {
            return;
        }
        $language = key($languages);

        // Create test user
        $group = new AdminUserGroup;
        $group->loadDataFromArray([
            'active' => 1
        ]);
        $group->save();

        $user = new AdminUser;
        $user->loadDataFromArray([
            'group_id' => $group->getId(),
            'active' => 1,
            'login' => 'test-unit-user',
            'password' => '',
            'lng' => $language
        ]);
        $user->save();

        $user_id = $user->getId();

        // Check
        $res = Users::getInstance()->getUserLng($user_id);

        // Delete user
        $user->deleteObject();
        $group->deleteObject();

        $this->assertEquals($language, $res);
    }

    public function testGetUserData()
    {
        // Create test user
        $group = new AdminUserGroup;
        $group->loadDataFromArray([
            'active' => 1
        ]);
        $group->save();

        $user = new AdminUser;
        $user->loadDataFromArray([
            'group_id' => $group->getId(),
            'active' => 1,
            'login' => 'test-unit-user',
            'password' => ''
        ]);
        $user->save();

        // Check
        $res = Users::getInstance()->getUserData('login', $user->getId());

        $user->deleteObject();

        $this->assertEquals('test-unit-user', $res);
    }

    public function testGetGroupData()
    {
        // Create test group
        $group = new AdminUserGroup;
        $group->loadDataFromArray([
            'title' => 'test-title'
        ]);
        $group->save();

        // Check
        $res = Users::getInstance()->getGroupData('title', $group->getId());

        $group->deleteObject();

        $this->assertSame('test-title', $res);
    }

    public function testGetGroupsPairs()
    {
        $res = Users::getInstance()->getGroupsPairs();

        $this->assertTrue(is_array($res));
    }

    public function testCheckAccess()
    {
        $res = Users::getInstance()->checkAccess('non', 'existing', 1);

        $this->assertFalse($res);
    }

    public function testCheckSitePagePermissions()
    {
        if (!defined('USER_ID')) define('USER_ID', 1);
        $res = Users::getInstance()->checkSitePagePermissions(0, 'non-action');

        $this->assertTrue(is_bool($res));
    }

    public function testGetUsersPairs()
    {
        $res = Users::getInstance()->getUsersPairs();

        $this->assertTrue(is_array($res));
    }
}