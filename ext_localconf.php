<?php

if (!(defined('TYPO3') || defined('TYPO3_MODE'))) {
    exit('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['t3rest'] = DMK\T3rest\Legacy\Controller\BaseController::class.'::execute';
