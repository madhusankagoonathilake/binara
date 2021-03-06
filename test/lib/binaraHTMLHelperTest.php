<?php

require_once dirname(__FILE__) . '/../../lib/binaraHTMLHelper.php';

/**
 * Test class for binaraHTMLHelper.
 * Generated by PHPUnit on 2011-09-18 at 23:28:07.
 * @ignore
 */
class binaraHTMLHelperTest extends PHPUnit_Framework_TestCase {

    /**
     * @var binaraHTMLHelper
     */
    protected $htmlHelper;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->htmlHelper = binaraHTMLHelper::instance();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers binaraHTMLHelper::instance
     * @covers binaraHTMLHelper::__construct
     */
    public function testInstance() {
        $this->assertTrue(binaraHTMLHelper::instance() instanceof binaraHTMLHelper);
    }

    /**
     * @covers binaraHTMLHelper::renderCAPTCHADiv
     */
    public function testRenderCAPTCHADiv() {
        binaraConfig::instance()->set(array(
            'html-helper-div-id' => 'sample_div_id',
            'html-helper-image-path' => 'http://img.example.com/captcha/',
            'html-helper-input-field-name' => 'txtImageVerification',
            'html-helper-input-label-text' => 'Image Verification',
            'html-helper-input-tip-span-id' => 'spanHelpTip',
            'html-helper-input-tip-text' => 'Help Tip',
            'html-helper-reload-help-text' => 'Reload',
        ));
        $html = $this->htmlHelper->renderCAPTCHADiv();
        
        @ob_clean();
        
        $this->assertNotNull($html);
        $this->assertRegExp('/\<div id="sample_div_id"\>/', $html);
        $this->assertRegExp('/\<img src="http:\/\/img.example.com\/captcha\/image.php" alt="binaraCAPTCHA" title="binaraCAPTCHA" id="binaraCAPTCHA" \/\>/', $html);
        $this->assertRegExp('/\<label for="txtImageVerification"\>Image Verification\<\/label\>/', $html);
        $this->assertRegExp('/\<input type="text" id="txtImageVerification" name="txtImageVerification" \/\>/', $html);
        $this->assertRegExp('/\<span id="spanHelpTip"\>Help Tip\<\/span\>/', $html);
        $this->assertRegExp('/\<a href="javascript\: binara_reloadImage\(\)\;"\>Reload\<\/a>/', $html);
        $this->assertRegExp('/\<script type="text\/javascript"\>/', $html);
        $this->assertRegExp('/function binara_reloadImage\(\) \{ document.getElementById\(\'binaraCAPTCHA\'\)\.src = \'http\:\/\/img\.example\.com\/captcha\/image\.php\?seed=\' \+ Math.random\(\)\; \}/', $html);
        $this->assertRegExp('/\<\/script\>/', $html);
        $this->assertRegExp('/\<\/div\>/', $html);
    }

}

?>
