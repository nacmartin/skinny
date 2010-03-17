<?php
/**
 * Symfonians forms global formatter
 * This code comes from symfonians.org (Nicolas Perrault)
 */
class sfWidgetFormSchemaFormatterDiv extends sfWidgetFormSchemaFormatter
{
  protected
    $rowFormat       = "<div class=\"form-row%is_error%\">\n  %label%\n  %error%\n  %field%\n  %help%\n%hidden_fields%</div>\n",
    $errorRowFormat  = "%errors%\n",
    $helpFormat      = '<div class="form-help">%help%</div>',
    $decoratorFormat = "\n  %content%";

  public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
  {
    return strtr(parent::formatRow($label, $field, $errors, $help, $hiddenFields), array(
      '%is_error%'    => (count($errors) > 0) ? ' field_error' : '',
      //'%is_required%' => $field,
    ));
  }
}
