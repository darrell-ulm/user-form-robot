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
     * @todo Improve test to check for valid HTML or structure.
     * @return void
     */
    public function testRenderJson()
    {
        $data = ['item1', 'item2', 'item2'];

        ob_start();
        $this->object->renderJson($data);
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
        $html = 'default.twig';
        $errors = ['err1', 'err2'];

        ob_start();
        $this->object->renderTemplate($html, $errors);
        $result = ob_get_clean();

        $this->assertTrue(is_string($result));
    }

}
