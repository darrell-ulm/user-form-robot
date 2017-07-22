<?php
/**
 * Composer
 */
require_once dirname(__FILE__) . '/../../vendor/autoload.php';

use User\View;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2017-07-11 at 11:34:18.
 *
 * by: Darrell Ulm
 */
class ViewTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var \User\View
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->object = new View();
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
     * View test for renderJson
     *
     * @return void
     */
    public function testRenderJson()
    {
        ob_start();

        //*** TEST LINE ***
        $this->object->renderJson(['item1', 'item2', 'item2']);
        //*** TEST LINE ***

        $result = ob_get_clean();

        $expected = <<<HTML
[
    "item1",
    "item2",
    "item2"
]
HTML;

        $this->assertEquals($expected, $result);
    }

    /**
     * View test for renderTemplate
     *
     * @todo Improve test to check for valid HTML or structure.
     * @return void
     */
    public function testRenderTemplate()
    {
        ob_start();

        //*** TEST LINE ***
        $this->object->renderTemplate('default.twig', ['err1', 'err2']);
        //*** TEST LINE ***

        $result = ob_get_clean();
        $this->assertTrue(is_string($result));
    }

    /**
     * View test for getTemplate()
     * 
     * @return void
     */
    public function testGetTemplate()
    {
        //*** TEST LINE ***
        $template = $this->object->getTemplate('index.twig', ['err3', 'err4']);
        //*** TEST LINE ***
        
        $this->assertTrue(is_string($template));
    }
    
}
