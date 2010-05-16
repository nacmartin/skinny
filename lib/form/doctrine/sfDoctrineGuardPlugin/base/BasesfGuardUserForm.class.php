<?php

/**
 * sfGuardUser form base class.
 *
 * @method sfGuardUser getObject() Returns the current form's model object
 *
 * @package    skinny
 * @subpackage form
 * @author     Nacho Martín
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'username'                => new sfWidgetFormInputText(),
      'algorithm'               => new sfWidgetFormInputText(),
      'salt'                    => new sfWidgetFormInputText(),
      'password'                => new sfWidgetFormInputText(),
      'is_active'               => new sfWidgetFormInputCheckbox(),
      'is_super_admin'          => new sfWidgetFormInputCheckbox(),
      'last_login'              => new sfWidgetFormDateTime(),
      'email'                   => new sfWidgetFormInputText(),
      'new_password'            => new sfWidgetFormInputText(),
      'new_password_created_at' => new sfWidgetFormDateTime(),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
      'groups_list'             => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup')),
      'permissions_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission')),
      'skinny_checks_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'SkinnyItem')),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'username'                => new sfValidatorString(array('max_length' => 128)),
      'algorithm'               => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'salt'                    => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'password'                => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'is_active'               => new sfValidatorBoolean(array('required' => false)),
      'is_super_admin'          => new sfValidatorBoolean(array('required' => false)),
      'last_login'              => new sfValidatorDateTime(array('required' => false)),
      'email'                   => new sfValidatorString(array('max_length' => 128)),
      'new_password'            => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'new_password_created_at' => new sfValidatorDateTime(array('required' => false)),
      'created_at'              => new sfValidatorDateTime(),
      'updated_at'              => new sfValidatorDateTime(),
      'groups_list'             => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup', 'required' => false)),
      'permissions_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission', 'required' => false)),
      'skinny_checks_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'SkinnyItem', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('username'))),
        new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('email'))),
      ))
    );

    $this->widgetSchema->setNameFormat('sf_guard_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUser';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['groups_list']))
    {
      $this->setDefault('groups_list', $this->object->groups->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['permissions_list']))
    {
      $this->setDefault('permissions_list', $this->object->permissions->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['skinny_checks_list']))
    {
      $this->setDefault('skinny_checks_list', $this->object->SkinnyChecks->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->savegroupsList($con);
    $this->savepermissionsList($con);
    $this->saveSkinnyChecksList($con);

    parent::doSave($con);
  }

  public function savegroupsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['groups_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->groups->getPrimaryKeys();
    $values = $this->getValue('groups_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('groups', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('groups', array_values($link));
    }
  }

  public function savepermissionsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['permissions_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->permissions->getPrimaryKeys();
    $values = $this->getValue('permissions_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('permissions', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('permissions', array_values($link));
    }
  }

  public function saveSkinnyChecksList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['skinny_checks_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->SkinnyChecks->getPrimaryKeys();
    $values = $this->getValue('skinny_checks_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('SkinnyChecks', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('SkinnyChecks', array_values($link));
    }
  }

}
