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
        $imagePath = binaraConfig::instance()->get('html-helper-image-path');

        $inputFieldName = binaraConfig::instance()->get('input-field-name');
        $htmlHelperDivId = binaraConfig::instance()->get('html-helper-div-id');
        $htmlHelperReloadHelpText = binaraConfig::instance()->get('html-helper-reload-help-text');
        
        $html = '';
        $html .= '<div id="' . $htmlHelperDivId . '">';
        $html .= '<img src="' . $imagePath . 'image.php" alt="binaraCAPTCHA" title="binaraCAPTCHA" id="binaraCAPTCHA" />';
        $html .= '<br />';
        $html .= '<a href="javascript: document.getElementById(\'binaraCAPTCHA\').src = \'' . $imagePath . 'image.php?seed=\' + Math.random();">';
        $html .= $htmlHelperReloadHelpText;
        $html .= '</a>';
        $html .= '<br />';
        $html .= '<input type="text" id="' . $inputFieldName . '" name="' . $inputFieldName . '" />';
        $html .='</div>';

        if ($output) {
            echo $html;
        }

        return $html;
    }

}
