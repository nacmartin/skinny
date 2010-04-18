<?php

class RememberPasswordForm extends BasesfGuardUserForm
{
  /**
   * Form configuration
   */
  public function configure()
  {
    // widgets
    $this->setWidgets(array(
      'email'   => new sfWidgetFormInput(),
    ));

    // helps
    $this->widgetSchema->setHelps(array(
      'email'     => 'Enter your email, so we can send you further instructions to change your password.',
    ));

    // validators
    $this->setValidators(array(
      'email'  => new sfGuardUserRememberPasswordValidator(),
    ));

    $this->widgetSchema->setNameFormat('choosepass[%s]');

    $oDecorator = new sfWidgetFormSchemaFormatterDiv($this->getWidgetSchema());
    $this->getWidgetSchema()->addFormFormatter('div', $oDecorator);
    $this->getWidgetSchema()->setFormFormatterName('div'); 
  }

}
