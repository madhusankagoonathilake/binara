<?php

require_once dirname(__FILE__) . '/../../lib/binaraCryptographyHelper.php';

/**
 * Test class for binaraCryptographyHelper.
 * Generated by PHPUnit on 2012-07-22 at 14:22:58.
 */
class binaraCryptographyHelperTest extends PHPUnit_Framework_TestCase {

    /**
     * @var binaraCryptographyHelper
     */
    protected $cryptographyHelper;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->cryptographyHelper = binaraCryptographyHelper::instance();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers binaraCryptographyHelper::instance
     * @covers binaraCryptographyHelper::__construct
     */
    public function testInstance() {
        $this->assertTrue(binaraCryptographyHelper::instance() instanceof binaraCryptographyHelper);
    }

    public function testHash() {
        $string = 'sample-string';
        $retult = $this->cryptographyHelper->hash($string);
        $this->assertNotEquals($retult, $string);
    }

}

?>
