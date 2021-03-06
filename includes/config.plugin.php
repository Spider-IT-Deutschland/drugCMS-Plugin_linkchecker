<?php
/**
 * Project: 
 * Contenido Content Management System
 * 
 * Description: 
 * Config file for the plugin linkchecker
 * 
 * Requirements: 
 * @con_php_req 5.0
 * 
 *
 * @package    Contenido Backend plugins
 * @version    2.0.1
 * @author     Frederic Schneider
 * @copyright  four for business AG <www.4fb.de>
 * @license    http://www.contenido.org/license/LIZENZ.txt
 * @link       http://www.4fb.de
 * @link       http://www.contenido.org
 * @since      file available since contenido release 4.8.7
 * 
 * {@internal 
 *   created 2007-08-08
 *   modified 2007-12-13, 2008-05-15
 *
 *   $Id$:
 * }}
 * 
 */

if(!defined('CON_FRAMEWORK')) {
	die('Illegal call');
}

$plugin_name = "linkchecker";
$cfg['plugins']['linkchecker'] = $cfg['path']['contenido'] . "plugins/" . $plugin_name . "/";
$cfg['tab']['whitelist'] = $cfg['sql']['sqlprefix'] . '_pi_linkwhitelist';

// Templates
$cfg['templates']['linkchecker_test'] = $cfg['plugins']['linkchecker'] . "templates/standard/template.linkchecker_test.html";
$cfg['templates']['linkchecker_test_errors'] = $cfg['plugins']['linkchecker'] . "templates/standard/template.linkchecker_test_errors.html";
$cfg['templates']['linkchecker_test_errors_cat'] = $cfg['plugins']['linkchecker'] . "templates/standard/template.linkchecker_test_errors_cat.html";
$cfg['templates']['linkchecker_test_nothing'] = $cfg['plugins']['linkchecker'] . "templates/standard/template.linkchecker_test_nothing.html";
$cfg['templates']['linkchecker_noerrors'] = $cfg['plugins']['linkchecker'] . "templates/standard/template.linkchecker_noerrors.html";
$cfg['templates']['linkchecker_whitelist'] = $cfg['plugins']['linkchecker'] . "templates/standard/template.linkchecker_whitelist.html";
$cfg['templates']['linkchecker_whitelist_urls'] = $cfg['plugins']['linkchecker'] . "templates/standard/template.linkchecker_whitelist_urls.html";

# 2015-12-04 :: Create DB tables if nessecary -->
function pilcCreateDbTables($db, $cfg) {
    $sql = 'CREATE TABLE `' . $cfg['sql']['sqlprefix'] . '_pi_linkwhitelist` (
                `url` varchar(255) NOT NULL DEFAULT "0",
                `lastview` int(11) NOT NULL DEFAULT "0",
                PRIMARY KEY (`url`)
            )';
    $db->query($sql);
}
if (!$db) {
    $db = new DB_Contenido();
}
$sql = 'SELECT url
        FROM ' . $cfg['sql']['sqlprefix'] . '_pi_linkwhitelist
        LIMIT 0, 1';
if (!$db->query($sql)) {
    pilcCreateDbTables($db, $cfg);
}
?>