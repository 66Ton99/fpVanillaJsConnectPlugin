<?php

/**
 * Base actions of fpVanillaJsConnectPlugin
 *
 * @author Ton Sharp <Forma-PRO@66ton99.org.ua>
 */
class fpVanillaJsConnectBaseActions extends sfActions
{

  /**
   * (non-PHPdoc)
   * @see sfAction::preExecute()
   */
  public function preExecute()
  {
    sfConfig::set('sf_web_debug', false);
  }

  /**
   * Index action
   *
   * @param sfWebRequest $request
   *
   * @return void
   */
  public function executeIndex(sfWebRequest $request)
  {
    $connection = new fpVanillaJsConnect($request);
    $this->renderText($connection->getJeson());
    return sfView::NONE;
  }
}
