<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sfWidgetFormSchemaFormatterParagraph
 *
 * @author master
 */
class sfWidgetFormSchemaFormatterParagraph extends sfWidgetFormSchemaFormatter
{

    protected
            $rowFormat = '<p class="form_row%row_class%">%label%%field%%help%%hidden_fields%</p>%error%',
            $helpFormat = '<span class="help">%help%</span>',
            $errorRowFormat = '<div class="global_error"><span style="color: #CC3333; display: block; height: 27px; font-weight: bold; text-decoration: underline;">Erreurs:</span>%errors%</div>',
            $errorListFormatInARow = '<div class="errMsg">%errors%</div>',
            $errorRowFormatInARow = '%error%<br />',
            $namedErrorRowFormatInARow = '%name%: %error%',
            $decoratorFormat = '%content%';

    public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
    {
        $row = parent::formatRow(
                        $label, $field, $errors, $help, $hiddenFields
        );

        return strtr($row, array(
                    '%row_class%' => (count($errors) > 0) ? ' form_row_error' : '',
                ));
    }

}

?>
