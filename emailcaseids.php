<?php

require_once 'emailcaseids.civix.php';
use CRM_Emailcaseids_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function emailcaseids_civicrm_config(&$config) {
  _emailcaseids_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function emailcaseids_civicrm_xmlMenu(&$files) {
  _emailcaseids_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function emailcaseids_civicrm_install() {
  _emailcaseids_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function emailcaseids_civicrm_postInstall() {
  _emailcaseids_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function emailcaseids_civicrm_uninstall() {
  _emailcaseids_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function emailcaseids_civicrm_enable() {
  _emailcaseids_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function emailcaseids_civicrm_disable() {
  _emailcaseids_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function emailcaseids_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _emailcaseids_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function emailcaseids_civicrm_managed(&$entities) {
  _emailcaseids_civix_civicrm_managed($entities);
}

function emailcaseids_civicrm_alterMailParams(&$params) {
  if (!empty($params['subject']) && preg_match('/\[case #([0-9a-h]{7})\]/', $params['subject'], $matches)) {
    $key = CRM_Core_DAO::escapeString(CIVICRM_SITE_KEY);
    $hash = $matches[1];
    $caseID = CRM_Core_DAO::singleValueQuery("SELECT id FROM civicrm_case WHERE SUBSTR(SHA1(CONCAT('$key', id)), 1, 7) = %1", [1 => [$hash, 'String')]]);

    $params['subject'] = str_replace($hash, $caseID, $params['subject']);
  }
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function emailcaseids_civicrm_caseTypes(&$caseTypes) {
  _emailcaseids_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function emailcaseids_civicrm_angularModules(&$angularModules) {
  _emailcaseids_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function emailcaseids_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _emailcaseids_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function emailcaseids_civicrm_entityTypes(&$entityTypes) {
  _emailcaseids_civix_civicrm_entityTypes($entityTypes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function emailcaseids_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function emailcaseids_civicrm_navigationMenu(&$menu) {
  _emailcaseids_civix_insert_navigation_menu($menu, 'Mailings', array(
    'label' => E::ts('New subliminal message'),
    'name' => 'mailing_subliminal_message',
    'url' => 'civicrm/mailing/subliminal',
    'permission' => 'access CiviMail',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _emailcaseids_civix_navigationMenu($menu);
} // */
