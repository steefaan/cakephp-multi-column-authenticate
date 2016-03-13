<?php

namespace MultiColumnAuthenticate\Test\TestCase\Auth;

use MultiColumnAuthenticate\Auth\MultiColumnAuthenticate;
use Cake\Network\Request;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

class MultiColumnAuthenticateTest extends TestCase
{
    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.multi_column_authenticate.users'
    ];

    /**
     * MultiColumnAuthenticateTest::setUp()
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $registry = $this->getMock('Cake\Controller\ComponentRegistry');
        $this->Auth = new MultiColumnAuthenticate($registry);

        $table = TableRegistry::get('Users');
        $password = password_hash('password', PASSWORD_DEFAULT);
        $table->updateAll(['password' => $password], []);
    }

    /**
     * MultiColumnAuthenticateTest::tearDown()
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Auth);

        parent::tearDown();
    }

    /**
     * MultiColumnAuthenticateTest::testAuthWithUsername()
     *
     * @return void
     */
    public function testAuthWithUsername()
    {
        $request = new Request();

        $request->data = [
            'username' => 'stefan',
            'password' => 'password'
        ];

        $response = $this->getMock('Cake\Network\Response');
        $result = $this->Auth->authenticate($request, $response);

        $this->assertSame('stefan@php-engineer.de', $result['email']);
    }

    /**
     * MultiColumnAuthenticateTest::testAuthWithEmail()
     *
     * @return void
     */
    public function testAuthWithEmail()
    {
        $request = new Request();

        $request->data = [
            'username' => 'stefan@php-engineer.de',
            'password' => 'password'
        ];

        $response = $this->getMock('Cake\Network\Response');
        $result = $this->Auth->authenticate($request, $response);

        $this->assertSame('stefan', $result['username']);
    }

    /**
     * MultiColumnAuthenticateTest::testAuthNoPassword()
     *
     * @return void
     */
    public function testAuthNoPassword()
    {
        $request = new Request();

        $request->data = [
            'username' => 'stefan'
        ];

        $response = $this->getMock('Cake\Network\Response');
        $result = $this->Auth->authenticate($request, $response);

        $this->assertFalse($result);
    }

    /**
     * MultiColumnAuthenticateTest::testAuthNoPassword()
     *
     * @return void
     */
    public function testAuthNoUsername()
    {
        $request = new Request();

        $request->data = [
            'password' => 'password'
        ];

        $response = $this->getMock('Cake\Network\Response');
        $result = $this->Auth->authenticate($request, $response);

        $this->assertFalse($result);
    }
}
