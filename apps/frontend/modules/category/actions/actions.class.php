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
  public function executeIndex(sfWebRequest $request)
  {
    $this->categories = Doctrine::getTable('JobeetCategory')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->jobeet_category = Doctrine::getTable('JobeetCategory')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->jobeet_category);
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
