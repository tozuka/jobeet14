<?php

/**
 * JobeetCategory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    jobeet
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class JobeetCategory extends BaseJobeetCategory
{
  public function getActiveJobs($max = 10)
  {
    $q = Doctrine_Query::create()
      ->from('JobeetJob j')
      ->where('j.category_id = ?', $this->getId())
      ->limit($max);
 
    return Doctrine_Core::getTable('JobeetJob')->getActiveJobs($q);
  }
}
