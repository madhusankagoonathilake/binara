<?php

class binaraHTMLHelper {

    private static $instance;

    private function __construct() {
        
    }

    /**
     *
     * @return binaraHTMLHelper
     */
    public static function instance() {
        if (!(self::$instance instanceof binaraCAPTCHA)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     *
     * @param bool $output
     * @return string 
     */
    public function renderCAPTCHADiv($output = true) {
        $imagePath = binaraConfig::instance()->get('image-path');

        $html = '';
        $html .= '<div>';
        $html .='<img src="' . $imagePath . 'image.php" alt="binaraCAPTCHA" title="binaraCAPTCHA" id="binaraCAPTCHA" />';
        $html .='<br />';
        $html .='<a href="javascript: document.getElementById(\'binaraCAPTCHA\').src = \'' . $imagePath . 'image.php?seed=\' + Math.random();">Reload</a>';
        $html .= '<br />';
        $html .= '<input type="text" id="binaraCAPTCHATextInput" name="binaraCAPTCHATextInput" />';
        $html .='</div>';

        if ($output) {
            echo $html;
        }

        return $html;
    }

}
