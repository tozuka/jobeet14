<?php

/**
 * category actions.
 *
 * @package    jobeet
 * @subpackage category
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class categoryActions extends sfActions
{
/*
  public function executeIndex(sfWebRequest $request)
  {
    $this->categories = Doctrine::getTable('JobeetCategory')
      ->createQuery('a')
      ->execute();
  }
*/
  public function executeShow(sfWebRequest $request)
  {
	$this->category = $this->getRoute()->getObject();

    $this->pager = new sfDoctrinePager(
      'JobeetJob',
      sfConfig::get('app_max_jobs_on_category')
    );
    $this->pager->setQuery($this->category->getActiveJobsQuery());
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new JobeetCategoryForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new JobeetCategoryForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($jobeet_category = Doctrine::getTable('JobeetCategory')->find(array($request->getParameter('id'))), sprintf('Object jobeet_category does not exist (%s).', $request->getParameter('id')));
    $this->form = new JobeetCategoryForm($jobeet_category);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($jobeet_category = Doctrine::getTable('JobeetCategory')->find(array($request->getParameter('id'))), sprintf('Object jobeet_category does not exist (%s).', $request->getParameter('id')));
    $this->form = new JobeetCategoryForm($jobeet_category);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($jobeet_category = Doctrine::getTable('JobeetCategory')->find(array($request->getParameter('id'))), sprintf('Object jobeet_category does not exist (%s).', $request->getParameter('id')));
    $jobeet_category->delete();

    $this->redirect('category/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $jobeet_category = $form->save();

      $this->redirect('category/edit?id='.$jobeet_category->getId());
    }
  }
}
