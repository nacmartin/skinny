<?php

/**
 * SkinnyItem form base class.
 *
 * @method SkinnyItem getObject() Returns the current form's model object
 *
 * @package    skinny
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseSkinnyItemForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInputText(),
      'text'       => new sfWidgetFormTextarea(),
      'list_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('SkinnyList'), 'add_empty' => false)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'name'       => new sfValidatorString(array('max_length' => 255)),
      'text'       => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'list_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('SkinnyList'))),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('skinny_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'SkinnyItem';
  }

}
