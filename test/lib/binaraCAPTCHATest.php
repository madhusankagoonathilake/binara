<?php

require_once dirname(__FILE__) . '/../../lib/binaraCAPTCHA.php';

/**
 * Test class for binaraCAPTCHA.
 * Generated by PHPUnit on 2011-09-18 at 23:28:05.
 * @ignore
 */
class binaraCAPTCHATest extends PHPUnit_Framework_TestCase {

    /**
     * @var binaraCAPTCHA
     */
    protected $captcha;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->captcha = binaraCAPTCHA::instance();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        @session_destroy();
    }

    /**
     * @covers binaraCAPTCHA::instance
     * @covers binaraCAPTCHA::__construct
     */
    public function testInstance() {
        $this->assertTrue(binaraCAPTCHA::instance() instanceof binaraCAPTCHA);
    }

    /**
     * @covers binaraCAPTCHA::getHttpHelper
     * @covers binaraCAPTCHA::setHttpHelper
     */
    public function testGettingAndSettingHTTPHelper() {
        $result = $this->captcha->getHttpHelper();
        $this->assertTrue($result instanceof binaraHTTPHelper);

        $helper = binaraHTTPHelper::instance();
        $this->captcha->setHttpHelper($helper);
        $result = $this->captcha->getHttpHelper();
        $this->assertEquals($helper, $result);
    }

    /**
     * @covers binaraCAPTCHA::getMathHelper
     * @covers binaraCAPTCHA::setMathHelper
     */
    public function testGettingAndSettingMathHelper() {
        $result = $this->captcha->getMathHelper();
        $this->assertTrue($result instanceof binaraMathHelper);

        $helper = binaraMathHelper::instance();
        $this->captcha->setMathHelper($helper);
        $result = $this->captcha->getMathHelper();
        $this->assertEquals($helper, $result);
    }

    /**
     * @covers binaraCAPTCHA::getCryptographyHelper
     * @covers binaraCAPTCHA::setCryptographyHelper
     */
    public function testGettingAndSettingCryptographyHelper() {
        $result = $this->captcha->getCryptographyHelper();
        $this->assertTrue($result instanceof binaraCryptographyHelper);

        $helper = binaraCryptographyHelper::instance();
        $this->captcha->setCryptographyHelper($helper);
        $result = $this->captcha->getCryptographyHelper();
        $this->assertEquals($helper, $result);
    }

    /**
     * @covers binaraCAPTCHA::draw
     * @covers binaraCAPTCHA::generateImage
     * @covers binaraCAPTCHA::generateRandomChars
     * @covers binaraCAPTCHA::generateRandomCharCode
     * @covers binaraCAPTCHA::storeString
     * @covers binaraCAPTCHA::getFontPaths
     */
    public function testDraw() {
        $mathHelperMock = $this->getMock('binaraMathHelper', array('generateRandomNumber'), array(), '', false);
        $mathHelperMock->expects($this->any())
                ->method('generateRandomNumber')
                ->will($this->onConsecutiveCalls(30, 31, 32, 62, 63, 64));

        $this->captcha->setMathHelper($mathHelperMock);

        /* Assersions are run twice to cover the possible number combinations generated randomly */
        $this->assertTrue($this->captcha->draw());
        $this->assertTrue($this->captcha->draw());
        @ob_clean();
    }

    /**
     * @covers binaraCAPTCHA::verify
     */
    public function testVerify() {
        @session_start();
        $sampleHash = $this->captcha->getCryptographyHelper()->hash('captcha-text');
        $this->captcha->getHttpHelper()->setSessionValue(binaraConfig::instance()->get('session-value-index'), $sampleHash);
        $this->assertFalse($this->captcha->verify('invalid-input'));
        $this->assertTrue($this->captcha->verify('captcha-text'));
    }

    /**
     * @covers binaraCAPTCHA::verify
     */
    public function testVerifyForCaseSensitivity() {
        $sampleHash = $this->captcha->getCryptographyHelper()->hash('captcha-text');
        $this->captcha->getHttpHelper()->setSessionValue(binaraConfig::instance()->get('session-value-index'), $sampleHash);
        $this->assertTrue($this->captcha->verify('captcha-text'));
        $this->assertTrue($this->captcha->verify('CaPtCha-TeXt'));
        $this->assertTrue($this->captcha->verify('CAPTCHA-TEXT'));
    }

}

?>
