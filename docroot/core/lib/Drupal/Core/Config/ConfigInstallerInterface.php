<?php

/**
 * @file
 * Contains Drupal\Core\Config\ConfigInstallerInterface.
 */

namespace Drupal\Core\Config;

/**
 * Interface for classes that install config.
 */
interface ConfigInstallerInterface {

  /**
   * Installs the default configuration of a given extension.
   *
   * When an extension is installed, it searches all the default configuration
   * directories for all other extensions to locate any configuration with its
   * name prefix. For example, the Node module provides the frontpage view as a
   * default configuration file:
   * core/modules/node/config/views.view.frontpage.yml
   * When the Views module is installed after the Node module is already
   * enabled, the frontpage view will be installed.
   *
   * Additionally, the default configuration directory for the extension being
   * installed is searched to discover if it contains default configuration
   * that is owned by other enabled extensions. So, the frontpage view will also
   * be installed when the Node module is installed after Views.
   *
   * @param string $type
   *   The extension type; e.g., 'module' or 'theme'.
   * @param string $name
   *   The name of the module or theme to install default configuration for.
   *
   * @see \Drupal\Core\Config\ExtensionInstallStorage
   */
  public function installDefaultConfig($type, $name);

}
