<?php

/**
 *
 * @author Artur Rozek
 * @version 1.0.0
 */
class sfWidgetFormDateJQueryUI extends sfWidgetForm {
    /**
     * Configures the current widget.
     *
     * Available options:
     *
     * @param string $ culture           Sets culture for the widget
     * @param boolean $ change_month      If date chooser attached to widget has month select dropdown, defaults to false
     * @param boolean $ change_year       If date chooser attached to widget has year select dropdown, defaults to false
     * @param integer $ number_of_months  Number of months visible in date chooser, defaults to 1
     * @param boolean $ show_button_panel If date chooser shows panel with 'today' and 'done' buttons, defaults to false
     * @param string $ theme             css theme for jquery ui interface, defaults to '/sfJQueryUIPlugin/css/ui-lightness/jquery-ui.css'
     * @see sfWidgetForm
     */
    protected function configure($options = array(), $attributes = array())
    {
        
        if (sfContext::hasInstance())
            $this->addOption('culture', sfContext::getInstance()->getUser()->getCulture());

        else
            $this->addOption('culture', "fr");
        $this->addOption('changeMonth', false);
        $this->addOption('changeYear', false);
        $this->addOption('numberOfMonths', 1);
        $this->addOption('showButtonPanel', false);
    	$this->addOption('yearRange', 'c-20:c+20');
        $this->addOption('date_format', null);
		parent::configure($options, $attributes);
    }

    /**
     *
     * @param string $name The element name
     * @param string $value The date displayed in this widget
     * @param array $attributes An array of HTML attributes to be merged with the default HTML attributes
     * @param array $errors An array of errors for the field
     * @return string An HTML tag string
     * @see sfWidgetForm
     */
    public function render($name, $value = null, $attributes = array(), $errors = array())
    {
        $attributes = $this->getAttributes();

        $input = new sfWidgetFormInput(array(), $attributes);
        
        // pour le format_date
            if($this->getOption('date_format') != null){
    	$dateFormat = new sfDateFormat();
		$value = $dateFormat->format($value, $this->getOption('date_format'));
		}
        

        $html = $input->render($name, $value);

        $id = $input->generateId($name);
        $culture = $this->getOption('culture');
        $cm = $this->getOption("changeMonth") ? "true" : "false";
    	$cy = $this->getOption("changeYear") ? "true" : "false";
        $nom = $this->getOption("numberOfMonths");
        $sbp = $this->getOption("showButtonPanel") ? "true" : "false";
        $yr = $this->getOption("yearRange");
        $fo = $this->getOption("date_format");
        
        $html .= <<<EOHTML
<script type="text/javascript">
	\$j(function() {
    var params = {
    changeMonth : $cm,
    changeYear : $cy,
    numberOfMonths : $nom,
    showButtonPanel : $sbp,
    yearRange : "$yr",
    date_format : "$fo",  
        };
    \$j("#$id").datepicker(params);
	});
</script>
EOHTML;

        return $html;
    }

    /*
   *
   * Gets the stylesheet paths associated with the widget.
   *
   * @return array An array of stylesheet paths
   */
    public function getStylesheets()
    {
        $theme = $this->getOption('theme');
        return array($theme => 'screen');
    }

    /**
     * Gets the JavaScript paths associated with the widget.
     *
     * @return array An array of JavaScript paths
     */
    public function getJavaScripts()
    {
        // check if jquery is loaded
        $js = array();
        $js[] = sfConfig::get('sf_jquery_web_dir') . '/js/' . sfConfig::get('sf_jquery_core');
        // $culture = $this->getOption('culture');
        $js[] = sfConfig::get('sf_jquery_web_dir') . '/js/jquery.ui.datepicker-fr.js';

        return $js;
    }
}
