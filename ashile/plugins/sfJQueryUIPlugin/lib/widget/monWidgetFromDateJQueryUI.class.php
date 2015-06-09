<?php
class monWidgetFormDateJQueryUI extends sfWidgetFormDateJQueryUI
{
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
   * @param  string $name        The element name
   * @param  string $value       The date displayed in this widget
   * @param  array  $attributes  An array of HTML attributes to be merged with the default HTML attributes
   * @param  array  $errors      An array of errors for the field
   *
   * @return string An HTML tag string
   *
   * @see sfWidgetForm
   */
  public function render($name, $value = null, $attributes = array(), $errors = array())
  {
    $attributes = $this->getAttributes();
 
    $input = new sfWidgetFormInput(array(), $attributes);
 
   if($this->getOption('date_format') != null){
        $date_format = new sfDateFormat();
        $value = $date_format->format($value, $this->getOption('date_format'));
        if($value == '00-00-' | $value == '00/00/'| $value == '00-00-0000'| $value == '00/00/0000'){
			$value = '';
		}
    }
    $html = $input->render($name, $value);
 
 
        $id = $input->generateId($name);
        $culture = $this->getOption('culture');
        $cm = $this->getOption("changeMonth") ? "true" : "false";
    	$cy = $this->getOption("changeYear") ? "true" : "false";
        $nom = $this->getOption("numberOfMonths");
        $sbp = $this->getOption("showButtonPanel") ? "true" : "false";
        $yr = $this->getOption("yearRange", '-30 : +0');
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
    date_format : "$fo"    
        
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
