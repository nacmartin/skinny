<?php

class SkinnyListTable extends Doctrine_Table
{
  /**
   * Retrieve a todo by slug
   */
  public function getObjectBySlug($options = array())
  {
    if (!isset($options['slug']))
    {
      throw new InvalidArgumentException('The slug is required in the options');
    }
    $q = $this->createQuery('td')->where('td.slug = ?', $options['slug']) ;

    return $q->fetchOne();
  }
}
