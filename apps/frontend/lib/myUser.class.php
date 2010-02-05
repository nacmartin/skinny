<?php

class myUser extends sfGuardSecurityUser
{
  public function isOwnerOf($list=null){
    if (!$list || !$this->getGuardUser()){
      return false;
    } else {
      return ($list->getUserId() == $this->getGuardUser()->getId());
    }
  }
}
