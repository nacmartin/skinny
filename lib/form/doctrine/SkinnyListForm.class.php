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

    //Embedding at least a form
    $items = $this->getObject()->getItems();
    if (!count($items)){
      $item = new SkinnyItem();
      $item->SkinnyList = $this->getObject();
      $items = array($item);
    }

    //An empty form will act as a container for all the items
    $items_form = new SfForm();
    $count = 0;
    foreach ($items as $item) {
      $item_form = new SkinnyItemForm($item);
      //Embedding each form in the container
      $items_form->embedForm($count, $item_form);
      $count ++;
    }

    //Embedding the container in the main form
    $this->embedForm('items', $items_form);
    $this->useFields(array(
      'name',
      'private',
      'items',
      'id'
    ));
  }

  public function addSkinnyItem($num){
    $item = new SkinnyItem();
    $item->SkinnyList = $this->getObject();
    $item_form = new SkinnyItemForm($item);

    $this->embeddedForms['items']->embedForm($num, $item_form);
    $this->embedForm('items', $this->embeddedForms['items']);
  }

  public function bind(array $taintedValues = null, array $taintedFiles = null)
  {
    foreach($taintedValues['items'] as $key=>$newItem)
    {
      if (!isset($this['items'][$key]))
      {
        $this->addSkinnyItem($key);
      }
    }

    parent::bind($taintedValues, $taintedFiles);
  }


  //current symfony version saves embedded form twice :(
  public function doSave($con = null){
    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $this->updateObject();

    $this->getObject()->save($con);
    // embedded forms
    //$this->saveEmbeddedForms($con);

  }
}
