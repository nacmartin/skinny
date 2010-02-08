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
  //hijack to add an owner credential
  public function getCredential()
  {
    $list = $this->retrieveSkinnyList();
    if ($list && $this->getUser()->isOwnerOf($list)){
      $this->getUser()->addCredential('owner');
    }else{
      $this->getUser()->removeCredential('owner');
    }
    // the hijack is over, let the normal flow continue:
    return parent::getCredential();
  }

  protected function retrieveSkinnyList(){
    if($id = $this->getRequest()->getParameter('id'));
    $list = Doctrine::getTable('SkinnyList')->find(array($id));
    return $list;
  }

  public function executeIndex(sfWebRequest $request)
  {
    $this->skinny_lists = Doctrine::getTable('SkinnyList')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->list = $this->getRoute()->getObject();
    $this->forward404Unless($this->list);
    $this->items = Doctrine::getTable('SkinnyItem')->findAllSortedWithParent($this->list->id, 'list_id','ASCENDING');
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

      $this->redirect('list/show?id='.$skinny_list->getId());
    }
  }

  public function executeSort($request)
  {
    $this->forward404Unless($request->isXmlHttpRequest());
    $jsarray = $request->getParameter("sortarr");
    $obj = json_decode($jsarray); 
    $pos = 1;
    foreach ($obj as $item_id){
      $item = Doctrine::getTable('SkinnyItem')->find(substr($item_id,-1));
      $item->moveToPosition($pos);
      $item->save();
      $pos++;
    }
    return sfView::NONE;
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
