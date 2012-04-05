<?php

/**
 * Main configuration of fpVanillaJsConnectPlugin
 *
 * @author Ton Sharp <Forma-PRO@66Ton99.org.ua>
 */
class fpVanillaJsConnectPluginConfiguration extends sfPluginConfiguration
{

  /**
   * (non-PHPdoc)
   * @see sfPluginConfiguration::initialize()
   */
  public function initialize()
  {
    $configFiles = $this->configuration->getConfigPaths('config/fp_vanilla_js_connect.yml');
    $config = sfDefineEnvironmentConfigHandler::getConfiguration($configFiles);
    foreach ($config as $name => $value) {
      sfConfig::set("fp_vanilla_js_connect_{$name}", $value);
    }
  }
}
