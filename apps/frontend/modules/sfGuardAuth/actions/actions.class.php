<?php

require_once(sfConfig::get('sf_plugins_dir').'/sfDoctrineGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');

/*
* There is a lot of code here from http://symfonians.org/browser/trunk/apps/main/modules/sfGuardAuth/actions/actions.class.php
*/


class sfGuardAuthActions extends BasesfGuardAuthActions
{
  public function executeRegister(sfWebRequest $request)
  {
    if ($this->getUser()->isAuthenticated())
    {
      $this->redirect('@homepage');
    }

    $this->form = new RegisterForm();
    $params = $request->getParameter('user', array());

    if (!$request->isMethod('post') or !$this->form->bindAndSave($params))
    {
      return sfView::SUCCESS; // redisplay form with errors
    }

    // At this point we got a valid form and a created sfGuardUser object
    $user = $this->form->getObject();

    // Create activation entry
    $activation = new SkinnyActivation();
    $activation->setUserId($user->getId());
    $activation->setHash(md5(rand(100000, 999999)));
    $activation->save();

    // Send user an activation email
    $mailer = sfContext::getInstance()->getMailer();

    $request->setAttribute('user', $user);
    $request->setAttribute('activation', $activation);
    $this->getMailer()->composeAndSend(
        'listandcheck@googlemail.com',
        $user->email,
        'Subject',
        'Body'
    );

    $this->getUser()->setFlash('notice', 'A confirmation mail has been sent to %mail%', array('%mail%' => $user->getEmail()));
    $this->redirect('@homepage');
  }

  public function executeRegisterDone(sfWebRequest $request)
  {
    $this->user = $request->getAttribute('user');
    return sfView::SUCCESS;
  }
}
