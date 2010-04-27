<?php

/**
 * SkinnyList form.
 *
 * @package    combo
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SkinnyListForm extends BaseSkinnyListForm
{
  public function configure()
  {
    $this->useFields(array(
      'name',
//      'private',
      'id',
      'description'
    ));
    $this->widgetSchema->setLabels(array(
      'name'    => 'List name',
//      'private'   => 'Keep this list private?',
      'description' => 'Description',
    ));

    // helps
    $this->widgetSchema->setHelps(array(
      'name'  => 'Give a title to the list.',
      'description'     => 'You can write comments or a short description here'
    ));


    $oDecorator = new sfWidgetFormSchemaFormatterDiv($this->getWidgetSchema());
    $this->getWidgetSchema()->addFormFormatter('div', $oDecorator);
    $this->getWidgetSchema()->setFormFormatterName('div');

  }
}
