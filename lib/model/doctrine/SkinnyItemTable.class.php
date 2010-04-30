<?php

class SkinnyItemTable extends Doctrine_Table
{
  public static function getItemsByListId($listId, $user = null){
    if ($user && $user->isAuthenticated()){
      $user_id = $user->getGuardUser()->getId();
    }else{
      $user_id = 0;
    }
    $q = Doctrine_Query::create()->from('SkinnyItem i') 
      ->leftJoin('i.SkinnyList l')
      ->where('l.id = ?', $listId)
      ->OrderBy('i.position')
      ->leftJoin('i.SkinnyChecks c WITH c.id = ?', $user_id);

    $items = $q->execute();
    return $items;
  }
}
