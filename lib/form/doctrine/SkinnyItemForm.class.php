<?php

/**
 * SkinnyItem form.
 *
 * @package    combo
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SkinnyItemForm extends BaseSkinnyItemForm
{
  public function configure()
  {
    $this->setWidget('text', new sfWidgetFormTextarea(array(), array('style'=>'height:200px;')));
    $this->useFields(array(
      'id',  
      'name',
      'text',
    ));
    //anyways we check if the owner is the one editing
    //and CSRF is responsible of a bug if you reorder items while editing
    $this->disableCSRFProtection();
  }
}
