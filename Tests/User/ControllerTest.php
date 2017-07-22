<?php
/**
 * Composer
 */
require_once dirname(__FILE__) . '/../../vendor/autoload.php';

use User\Controller;
use User\Model;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-07-11 at 11:34:17.
 *
 * by: Darrell Ulm
 */
class ControllerTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var \User\Controller
     */
    protected $object;

    /**
     * @var ControllerTest\array
     */
    protected $routes;

    /**
     * @var ControllerTest\array
     */
    protected $routesParams;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = new Controller();

        // Define routes to test.
        $this->routes = [
            '/index.php?command=read&id=6',
            '/index.php?command=delete&id=4',
            '/index.php?command=create&e=e@test.dev&fn=first1&ln=last1&p=password1',
            '/index.php?command=index',
            '/index.php?command=read&id=6&type=json',
            '/index.php?command=index&type=json',
            '/index.php?command=NoCommand',
            '/index.php?command=update&e=e@test.dev&fn=first1&ln=last1&p=password1&id=6',
            '/read/id/6',
            '/read/id/6/type/json',
            '/update/e/e@test.dev/fn/first1/ln/last1/p/password1/id/6',
            '/delete/id/6',
            '/NoRoute',
            '/create/e/e@test.dev/fn/first1/ln/last1/p/password1',
            '/index',
            '/index/type/json',
            '/index.php',
        ];

        // Define analysed routes as expected output.
        $this->routesParams = [
            ['command' => 'read', 'query' => ['command' => 'read', 'id' => '6']],
            ['command' => 'delete', 'query' => ['command' => 'delete', 'id' => '4']],
            ['command' => 'create', 'query' =>
                ['command' => 'create', 'e' => 'e@test.dev', 'fn' => 'first1', 'ln' => 'last1', 'p' => 'password1']],
            ['command' => 'index', 'query' => ['command' => 'index']],
            ['command' => 'read', 'query' => ['command' => 'read', 'id' => '6', 'type' => 'json']],
            ['command' => 'index', 'query' => ['command' => 'index', 'type' => 'json']],
            ['command' => 'NoCommand', 'query' => ['command' => 'NoCommand']],
            ['command' => 'update', 'query' =>
                ['command' => 'update', 'e' => 'e@test.dev', 'fn' => 'first1', 'ln' => 'last1', 'p' => 'password1', 'id' => '6']],
            ['command' => 'read', 'query' => ['id' => '6']],
            ['command' => 'read', 'query' => ['id' => '6', 'type' => 'json']],
            ['command' => 'update', 'query' =>
                ['e' => 'e@test.dev', 'fn' => 'first1', 'ln' => 'last1', 'p' => 'password1', 'id' => '6']],
            ['command' => 'delete', 'query' => ['id' => '6']],
            ['command' => 'NoRoute', 'query' => []],
            ['command' => 'create', 'query' =>
                ['e' => 'e@test.dev', 'fn' => 'first1', 'ln' => 'last1', 'p' => 'password1']],
            ['command' => 'index', 'query' => []],
            ['command' => 'index', 'query' => ['type' => 'json']],
            ['command' => '', 'query' => []],
        ];
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
    }

    /**
     * Controller test analyseRoute
     *
     * @return void
     */
    public function testAnalyseRoute()
    {
        // Test all routes and expected outputs.
        $num = count($this->routes);
        for ($i = 0; $i < $num; $i++) {
            $expected = $this->routesParams[$i];

            // Analyse the route.
            $url = $this->routes[$i];
            
            //*** TEST LINE ***
            $results = $this->object->analyseRoute($url);
            //*** TEST LINE ***

            // Segment route into params and/or id.
            $params = $this->object->getParams();
            $id = $this->object->getID();
            $query = $this->object->getQueryParams();

            // Check that are the same.
            $this->assertEquals($params, $expected);
            $this->assertEquals($query, $expected['query']);
            $this->assertInternalType('boolean', $results);
        }
    }

    /**
     * Controller test directRoute
     *
     * @return void
     */
    public function testDirectRoute()
    {
         // Test all routes and expected outputs.
        $num = count($this->routes);
        for ($i = 0; $i < $num; $i++) {
            $expected = $this->routesParams[$i];

            // Get URL (path).
            $url = $this->routes[$i];

            // Collect output when routes are tested.
            ob_start();
            
            //*** TEST LINE ***
            $results = $this->object->directRoute($url);
            //*** TEST LINE ***
            
            $text = ob_get_clean();

            // Segment route into params and/or id.
            $params = $this->object->getParams();
            $id = $this->object->getID();
            $query = $this->object->getQueryParams();

            // Check results
            $this->assertEquals($params, $expected);
            $this->assertEquals($query, $expected['query']);
            $this->assertInternalType('string', $text);
        }
    }

    /**
     * Controller test routeError
     *
     * @return void
     */
    public function testRouteError()
    {
        ob_start();
        
        //*** TEST LINE ***
        $results = $this->object->routeError();
        //*** TEST LINE ***
        
        $text = ob_get_clean();
        $this->assertInternalType('string', $text);
        $this->assertInternalType('boolean', $results);
        $this->assertEquals(false, $results);
    }

    /**
     * Controller test defaultPage
     *
     * @return void
     */
    public function testDefaultPage()
    {
        ob_start();
        
        //*** TEST LINE ***
        $results = $this->object->defaultPage();
        //*** TEST LINE ***
        
        $text = ob_get_clean();
        $this->assertInternalType('string', $text);
        $this->assertInternalType('boolean', $results);
        $this->assertEquals(true, $results);
    }
    
    /**
     * Controller test callRender
     *
     * @return void
     */
    public function testCallRender()
    {
        ob_start();
        
        //*** TEST LINE ***
        $results = $this->object->callRender("Twig", "index", FALSE);
        //*** TEST LINE ***
        
        $text = ob_get_clean();
        $this->assertTrue(is_string($text));
    }

    /**
     * Controller test updateUser
     *
     * @todo improve this test
     * @return void
     */
    public function testUpdateUser()
    {
        // Set up a read route.
        $url = '/update/e/e@test.dev/fn/first1/ln/last1/p/password1/id/6';
        $results = $this->object->analyseRoute($url);

        // Separaate the parameters
        $params = $this->object->getParams();
        $query = $this->object->getQueryParams();

        // Udpdate a user, and capture output.
        ob_start();

        //*** TEST LINE ***
        $createdId = $this->object->updateUser($params);
        //*** TEST LINE ***

        $text = ob_get_clean();

        // Check the results
        $this->assertEquals($params, ['command' => 'update', 'query' =>
                ['e' => 'e@test.dev', 'fn' => 'first1', 'ln' => 'last1', 'p' => 'password1', 'id' => '6']]);
        $this->assertInternalType('string', $text);
        $this->assertInternalType('boolean', $results);
        $this->assertEquals(true, $results);
    }

    /**
     * Controller test createUser
     *
     * @todo Improve this test.
     * @return void
     */
    public function testCreateUser()
    {
        // Set up a read route.
        $url = '/create/e/e@test.dev/fn/first1/ln/last1/p/password1';
        $results = $this->object->analyseRoute($url);

        // Separaate the parameters
        $params = $this->object->getParams();
        $query = $this->object->getQueryParams();

        // Create the user, and capture output.
        ob_start();
        
        //*** TEST LINE ***
        $createdId = $this->object->createUser($params);
        //*** TEST LINE ***
        
        $text = ob_get_clean();

        // Check the results
        $this->assertEquals($params, ['command' => 'create', 'query' =>
                ['e' => 'e@test.dev', 'fn' => 'first1', 'ln' => 'last1', 'p' => 'password1']]);
        $this->assertInternalType('string', $text);
        $this->assertInternalType('boolean', $results);
        $this->assertEquals(true, $results);

        // Delete the created user.
        ob_start();
        $this->object->deleteUser($createdId);
        $text = ob_get_clean();
    }

    /**
     * Controller test deleteUser
     *
     * @todo improve testing for deleteUser
     * @return void
     */
    public function testDeleteUser()
    {
        // Set up a read route.
        $url = '/delete/id/0';
        $results = $this->object->analyseRoute($url);

        // Delete the user, and capture output.
        ob_start();
        
        //*** TEST LINE ***
        $results = $this->object->deleteUser(0);
        //*** TEST LINE ***
        
        $text = ob_get_clean();

        // Separaate the parameters
        $params = $this->object->getParams();
        $id = $this->object->getID();
        $query = $this->object->getQueryParams();

        // Check the results
        $this->assertEquals($params, ['command' => 'delete', 'query' => ['id' => '0']]);
        $this->assertEquals($id, 0);
        $this->assertEquals($query, ['id' => '0']);
        $this->assertInternalType('string', $text);
        $this->assertInternalType('boolean', $results);
        $this->assertEquals(false, $results);
    }

    /**
     * Controller test readUser
     *
     * @todo make better tests for readUser.
     * @return void
     */
    public function testReadUser()
    {
        // Set up a read route.
        $url = '/read/id/0';
        $results = $this->object->analyseRoute($url);

        // Read the user, and capture output.
        ob_start();
        
        //*** TEST LINE ***
        $results = $this->object->readUser();
        //*** TEST LINE ***
        
        $text = ob_get_clean();

        // Separaate the parameters
        $params = $this->object->getParams();
        $id = $this->object->getID();
        $query = $this->object->getQueryParams();

        // Check the results
        $this->assertEquals($params, ['command' => 'read', 'query' => ['id' => '0']]);
        $this->assertEquals($id, 0);
        $this->assertEquals($query, ['id' => '0']);
        $this->assertInternalType('string', $text);
        $this->assertInternalType('boolean', $results);
        $this->assertEquals(false, $results);
    }

    /**
     * Controller test indexUser
     *
     * @return void
     */
    public function testIndexUser()
    {
        ob_start();
        
        //*** TEST LINE ***
        $results = $this->object->indexUser();
        //*** TEST LINE ***
        
        $text = ob_get_clean();
        $this->assertInternalType('array', $results);
        $this->assertInternalType('string', $text);
    }

    /**
     * Controller test getID
     *
     * @return void
     */
    public function testGetID()
    {
        //*** TEST LINE ***
        $result = $this->object->getID();
        //*** TEST LINE ***
        
        $expected = false;
        $this->assertEquals($expected, $result);
    }

    /**
     * Controller test getParams
     *
     * @return void
     */
    public function testGetParams()
    {
        //*** TEST LINE ***
        $result = $this->object->getParams();
        //*** TEST LINE ***
        
        $expected = null;
        $this->assertEquals($expected, $result);
    }

    /**
     * Controller test getQueryParams
     *
     * @return void
     */
    public function testGetQueryParams()
    {
        //*** TEST LINE ***
        $result = $this->object->getQueryParams();
        //*** TEST LINE ***
        
        $expected = null;
        $this->assertEquals($expected, $result);
    }

    /**
     * Controller test getUser
     *
     * @return void
     */
    public function testGetUser()
    {
        // Make sure class returned is the Model class.
        
        //*** TEST LINE ***
        $result = $this->object->getUser();
        //*** TEST LINE ***
        
        $this->assertInstanceOf(Model::class, $result);
    }

    /**
     * Controller test getErrors
     *
     * @return void
     */
    public function testGetErrors()
    {
        // Add errors and check if they are show up.
        $this->object->getUser()->addError('err1');
        $this->object->getUser()->addError('err2');
        
        //*** TEST LINE ***
        $result = $this->object->getErrors();
        //*** TEST LINE ***
        
        $expected = [0 => 'err1', 1 => 'err2'];
        $delta = 0.0;
        $maxDepth = 10;
        $canonicalize = true;
        $this->assertEquals($expected, $result, '$canonicalize = true', $delta, $maxDepth, $canonicalize);
    }
}
