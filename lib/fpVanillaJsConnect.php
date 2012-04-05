<?php


/**
 * JsConnect wrapper
 *
 * @author Ton Sharp <Forma-PRO@66ton99.org.ua>
 */
class fpVanillaJsConnect
{

  /**
   * @var JsConnect
   */
  protected $object;

  /**
   * @var sfWebRequest
   */
  protected $request;

  /**
   * Constructor
   *
   * @return void
   */
  public function __construct(sfWebRequest $request)
  {
    $this->request = $request;
    $className = sfConfig::get('fp_vanilla_js_connect_class', 'JsConnect');
    $this->object = new $className(
      sfConfig::get('fp_vanilla_js_connect_client_id'),
      sfConfig::get('fp_vanilla_js_connect_client_secret')
    );
  }

  /**
   * Get Json string
   *
   * @return string
   */
  public function getJeson()
  {
    $user = $this->getUser();
    $requestArray = $this->request->getParameterHolder()->getAll();
    unset($requestArray['action'], $requestArray['module']);
    return $this->object->GenerateJson(
      $user?:array(),
      $requestArray
    );
  }

  /**
   * Returns data of vanilla user
   *
   * @return null|array
   */
  public function getUser()
  {
    $user = sfContext::getInstance()->getUser()->getGuardUser();
    if (empty($user)) return null;
    if ($method = sfConfig::get('fp_vanilla_js_connect_client_user_method'))
    {
      return call_user_func(array($user, $method));
    }
    else
    {
      return array(
        'uniqueid' => $user->getId(),
        'name' => $user->getName(),
        'email' => $user->getEmailAddress(),
//         'password' => $user->getPassword(), // TODO Implemet
//         'hashmethod' => sfConfig::get('app_sf_guard_plugin_algorithm_callable', 'sha1'),
        'photourl' => '',
      );
    }
  }
}
