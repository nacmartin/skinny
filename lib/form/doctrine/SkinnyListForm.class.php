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
      'private',
      'items',
      'id'
    ));
  }
}
