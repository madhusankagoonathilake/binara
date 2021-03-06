<?php

require_once dirname(__FILE__) . '/../../lib/binaraConfig.php';
require_once dirname(__FILE__) . '/../../lib/binaraException.php';

/**
 * Test class for binaraConfig.
 * Generated by PHPUnit on 2011-09-18 at 23:28:06.
 * @ignore
 */
class binaraConfigTest extends PHPUnit_Framework_TestCase {

    /**
     * @var binaraConfig
     */
    protected $config;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->config = binaraConfig::instance();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers binaraConfig::instance
     * @covers binaraConfig::__construct
     */
    public function testInstance() {
        $this->config = null;
        $this->assertTrue(binaraConfig::instance() instanceof binaraConfig);
    }

    /**
     * @covers binaraConfig::get
     */
    public function testGet() {
        $this->config->set(array(
            'width' => 100,
            'height' => 50,
        ));

        $this->assertEquals(100, $this->config->get('width'));
        $this->assertEquals(50, $this->config->get('height'));
    }

    /**
     * @covers binaraConfig::get
     * @expectedException binaraException
     * @expectedExceptionMessage Tried to access an undefined property temperature
     */
    public function testGetWhenTryingToAccessAnUndefinedConfiguration() {
        $this->config->set(array(
            'width' => 100,
            'height' => 50,
        ));

        $this->config->get('temperature');
    }

    /**
     * @covers binaraConfig::set
     */
    public function testSet() {
        $this->config->set(array(
            'width' => 100,
            'height' => 50,
        ));

        $this->assertEquals(100, $this->config->get('width'));
        $this->assertEquals(50, $this->config->get('height'));
    }

}

?>
