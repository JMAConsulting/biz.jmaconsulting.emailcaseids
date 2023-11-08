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
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function emailcaseids_civicrm_install() {
  _emailcaseids_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function emailcaseids_civicrm_enable() {
  _emailcaseids_civix_civicrm_enable();
}

function emailcaseids_civicrm_alterMailParams(&$params) {
  if (!empty($params['subject']) && preg_match('/\[case #([0-9a-h]{7})\]/', $params['subject'], $matches)) {
    $key = CRM_Core_DAO::escapeString(CIVICRM_SITE_KEY);
    $hash = $matches[1];
    $caseID = CRM_Core_DAO::singleValueQuery("SELECT id FROM civicrm_case WHERE SUBSTR(SHA1(CONCAT('$key', id)), 1, 7) = %1", [1 => [$hash, 'String']]);

    $params['subject'] = str_replace($hash, $caseID, $params['subject']);
  }
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *

 // */

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
