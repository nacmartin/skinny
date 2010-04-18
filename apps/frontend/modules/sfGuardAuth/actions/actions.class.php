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

    //users are inactive until they confirm their email accounts
    $user = $this->form->getObject();
    $user->setIsActive(false);
    $user->save();

    // At this point we got a valid form and a created sfGuardUser object

    // Create activation entry
    $activation = new SkinnyActivation();
    $activation->setUserId($user->getId());
    $activation->setHash(md5(rand(100000, 999999)));
    $activation->save();

    $message = Swift_Message::newInstance()
        ->setSubject('Activate your List&Check account')
        ->setBody($this->getPartial('activationMail', array(
            'username' => $user->username,
            'token'    => $activation->hash
        )))
        ->setFrom(array('listandcheck@googlemail.com' => 'List & Check'))
        ->setTo(array($user->email => $user->username));

    $this->getMailer()->send($message);
    $this->getUser()->setFlash('error', 'A confirmation mail has been sent to '. $user->email);
    $this->redirect('@homepage');
  }

  public function executeRegisterDone(sfWebRequest $request)
  {
    $this->user = $request->getAttribute('user');
    return sfView::SUCCESS;
  }

  public function executeChangePassword(sfWebRequest $request)
  {
    $this->forward404Unless($this->getUser() && $this->getUser()->isAuthenticated());
    $this->form = new ChangePasswordForm(null, array('user_id' => $this->getUser()->getGuardUser()->getId()));
    if($request->isMethod('post')){
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid()){
        $password = $this->form->getValue('password');
        $user = $this->getUser()->getGuardUser();
        $user->setPassword($password);
        $user->save();
        $this->getUser()->setFlash('notice', 'Password changed');
        $this->redirect('@homepage');

      }
    }
  } 

  public function executePassword($request)
  {
    $this->form = new RememberPasswordForm();
    if($request->isMethod('post')){
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid()){
        $email = $this->form->getValue('email');
        $user = Doctrine::getTable('sfGuardUser')->findOneByEmail($email);
        $password = substr(md5(rand(100000, 999999)), 0, 8);
        $user->setPasswordForgotten($password);

        $message = Swift_Message::newInstance()
          ->setSubject('Password reminder')
          ->setBody($this->getPartial('forgotPasswordMail', array(
            'username' => $user->username,
            'password'    => $password
          )))
          ->setFrom(array('listandcheck@googlemail.com' => 'List & Check'))
          ->setTo(array($user->email => $user->username));

        $this->getMailer()->send($message);
        $this->getUser()->setFlash('notice', 'A new password has been sent to '. $user->email);
        $this->redirect('@homepage');

      }else{
        $this->getUser()->setFlash('error', 'There are no accounts registered with this email address');
      }
    }
  }

  public function executeActivate(sfWebRequest $request)
  {
    $key = $this->getRequestParameter('token');
    $activation = Doctrine::getTable('SkinnyActivation')->
      findOneByHash($key);
    if (!$activation){
      $this->getUser()->setFlash('error', 'Invalid activation key');
      return sfView::ERROR;
    }

    if (!$user = $activation->getUser()){
      $this->getUser()->setFlash('error', 'Sorry, we could not find an user associated with this activation key');
      return sfView::ERROR;
    }
    if ($user->getIsActive()){
      $this->getUser()->setFlash('error', 'This account is already active');
      return sfView::ERROR;
    }

    $user->setIsActive(true);
    $user->save();
    $activation->delete();

    $this->getUser()->setFlash('notice', 'Your account has been activated. You can now log in using the username and password you provided at registration time.');
    $this->redirect('@sf_guard_signin');
  }

}
