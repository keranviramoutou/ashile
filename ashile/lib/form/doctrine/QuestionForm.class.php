<?php

/**
 * Question form.
 *
 * @package    ash
 * @subpackage form
 * @author     regis Gravant
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class QuestionForm extends BaseQuestionForm
{
  public function configure()
  {
		
	$this->widgetSchema['question'] = new sfWidgetFormInputText(array(), array("style"=>'width: 420px;'));
        $this->widgetSchema->setLabels(array(
            'question' => 'Libellé de  la question : (*) ',

        ));
	$this->widgetSchema['num_question'] = new sfWidgetFormInputText(array(), array("style"=>'width: 30px;'));
  }
}
