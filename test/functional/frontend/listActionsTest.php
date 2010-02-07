<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfGuardTestFunctional(new sfBrowser());
Doctrine::loadData(sfConfig::get('sf_test_dir').'/fixtures');

$browser->
  info('0 - General')->
  get('/')->

  with('request')->begin()->
    isParameter('module', 'list')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    checkElement('body', '!/This is a temporary page/')->
  end()
;

$browser->
  info('1 - User owning')->
  info('1.1 - Not authenticated haven\'t edit link')->
  get('/')->
  click('View', array(), array('position' => 1))->
  with('request')->begin()->
    isParameter('module', 'list')->
    isParameter('action', 'show')->
  end()->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('a:contains("Edit")', false)->
  end()->
  info('1.2 - Authenticated and owner has link to edit')->
  signinOk(array('username'=>'nacho','password'=>'nacho'))->
  get('/')->
  click('View', array(), array('position' => 1))->
  with('request')->begin()->
    isParameter('module', 'list')->
    isParameter('action', 'show')->
  end()->
  with('response')->begin()->
    isStatusCode(200)->
    checkElement('a:contains("Edit")', true)->
  end()->
  info('1.3 - Authenticated and owner has link to edit')->
  click('Edit', array(), array('position' => 1))->
  with('request')->begin()->
    isParameter('module', 'list')->
    isParameter('action', 'edit')->
  end()->
  info('1.4 - Authenticated but no owner has not link to edit')->
  logoutOk()->
  signinOk(array('username'=>'vito','password'=>'vito'))->
  get('/')->
  click('View', array(), array('position' => 1))->
  with('response')->begin()->
    checkElement('a:contains("Edit")', false)->
  end(); 
