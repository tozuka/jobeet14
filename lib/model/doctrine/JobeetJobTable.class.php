<?php


class JobeetJobTable extends Doctrine_Table
{
  public static function getInstance()
  {
    return Doctrine_Core::getTable('JobeetJob');
  }

  public function getActiveJobs(Doctrine_Query $q = null)
  {
    if (is_null($q)) {
//    $q = $this->createQuery('j')
      $q = Doctrine_Query::create()
        ->from('JobeetJob j');
    }
    $q->andWhere('j.expires_at > ?', date('Y-m-d H:i:s', time()))
      ->addOrderBy('j.expires_at DESC');

    return $q->execute();
  }

  public function retrieveActiveJob(Doctrine_Query $q)
  {
    $q->andWhere('a.expires_at > ?', date('Y-m-d H:i:s', time()));

    return $q->fetchOne();
  }
}