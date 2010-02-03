<?php

/**
 * list actions.
 *
 * @package    skinny
 * @subpackage list
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class listActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->skinny_lists = Doctrine::getTable('SkinnyList')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->list = Doctrine::getTable('SkinnyList')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->list);
    $this->items = $this->list->items;
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SkinnyListForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SkinnyListForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($skinny_list = Doctrine::getTable('SkinnyList')->find(array($request->getParameter('id'))), sprintf('Object skinny_list does not exist (%s).', $request->getParameter('id')));
    $this->form = new SkinnyListForm($skinny_list);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($skinny_list = Doctrine::getTable('SkinnyList')->find(array($request->getParameter('id'))), sprintf('Object skinny_list does not exist (%s).', $request->getParameter('id')));
    $this->form = new SkinnyListForm($skinny_list);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($skinny_list = Doctrine::getTable('SkinnyList')->find(array($request->getParameter('id'))), sprintf('Object skinny_list does not exist (%s).', $request->getParameter('id')));
    $skinny_list->delete();

    $this->redirect('list/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $skinny_list = $form->save();

      $this->redirect('list/edit?id='.$skinny_list->getId());
    }
  }

  public function executeAddSkinnyItemForm($request)
  {
    $this->forward404unless($request->isXmlHttpRequest());
    $number = intval($request->getParameter("num"));

    if($list = Doctrine::getTable('SkinnyList')->find($request->getParameter('id'))){
      $form = new SkinnyListForm($list);
    }else{
      $form = new SkinnyListForm(null);
    }

    $form->addSkinnyItem($number);

    return $this->renderPartial('addItem',array('form' => $form, 'num' => $number));
  }

}
