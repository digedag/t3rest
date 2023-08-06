<?php

if (!defined('TYPO3_MODE')) {
    exit('Access denied.');
}

/* @deprecated legacy code, will be removed for 10.x or later */
if (!\Sys25\RnBase\Utility\TYPO3::isTYPO60OrHigher()) {
    $GLOBALS['TCA']['tx_t3rest_providers'] = require \Sys25\RnBase\Utility\Extensions::extPath(
        't3rest',
        'Configuration/TCA/tx_t3rest_providers.php'
    );
}
