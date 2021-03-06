<?php

require_once dirname(__FILE__) . '/../../lib/binaraImageHelper.php';

/**
 * Test class for binaraImageHelper.
 * Generated by PHPUnit on 2011-09-18 at 23:28:07.
 * @ignore
 */
class binaraImageHelperTest extends PHPUnit_Framework_TestCase {

    /**
     * @var binaraImageHelper
     */
    protected $imageHelper;
    protected $image;
    protected $black;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->imageHelper = binaraImageHelper::instance();
        $this->image = imagecreate(100, 100);
        $this->black = imagecolorallocate($this->image, 0, 0, 0);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        imagedestroy($this->image);
    }

    /**
     * @covers binaraImageHelper::instance
     * @covers binaraImageHelper::__construct
     */
    public function testInstance() {
        $this->assertTrue(binaraImageHelper::instance() instanceof binaraImageHelper);
    }

    /**
     * @covers binaraImageHelper::addThickLine
     */
    public function testAddThickLine() {
        $this->assertTrue($this->imageHelper->addThickLine($this->image, 10, 20, 30, 40, $this->black));
    }

    /**
     * @covers binaraImageHelper::addNoise
     */
    public function testAddNoise() {
        $this->assertTrue($this->imageHelper->addNoise($this->image));
    }

}

?>
