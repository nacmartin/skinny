<?php
class sfGuardTestFunctional extends sfTestFunctional {
  public function signinOk($user_data)
  {
    return $this->
      info(sprintf('Connexion with login : "%s" and password "%s"
      should be ok OK.', $user_data['username'], $user_data['password']))->
      get('/login')->
      with('request')->begin()->
      isParameter('module', 'sfGuardAuth')->
      isParameter('action', 'signin')->
      end()->
      click('sign in',array('signin'=>$user_data))->

      with('form')->begin()->
      hasErrors(false)->
      end()->

      with('user')->begin()->
      isCulture('en')->
      isAuthenticated(true)->
      end()->

      with('request')->begin()->
      isParameter('module', 'sfGuardAuth')->
      isParameter('action', 'signin')->
      end();

  } 
  public function logoutOk(){
    return $this->
      with('user')->begin()->
      isAuthenticated(true)->
      end()->
      get('/logout')->
      with('user')->begin()->
      isAuthenticated(false)->
      end();

  }

}
