<?php

declare(strict_types=1);

return [
    'tx_t3rest_provider_AbstractBase' => DMK\T3rest\Legacy\Provider\AbstractProvider::class,
    'tx_t3rest_provider_IProvider' => DMK\T3rest\Legacy\Provider\IProvider::class,
    'tx_t3rest_provider_News' => DMK\T3rest\Legacy\Provider\NewsProvider::class,
    'tx_t3rest_models_Generic' => DMK\T3rest\Legacy\Model\GenericModel::class,
    'tx_t3rest_models_Provider' => DMK\T3rest\Legacy\Model\ProviderModel::class,
    'tx_t3rest_models_Error' => DMK\T3rest\Legacy\Model\ErrorModel::class,
    'tx_t3rest_models_Response' => DMK\T3rest\Legacy\Model\ResponseModel::class,
    'tx_t3rest_decorator_Base' => DMK\T3rest\Legacy\Decorator\BaseDecorator::class,
    'tx_t3rest_decorator_News' => DMK\T3rest\Legacy\Decorator\NewsDecorator::class,
    'tx_t3rest_decorator_Simple' => DMK\T3rest\Legacy\Decorator\SimpleDecorator::class,
    'tx_t3rest_util_FAL' => DMK\T3rest\Legacy\Utility\FALUtil::class,
    'tx_t3rest_util_Objects' => DMK\T3rest\Legacy\Utility\Objects::class,
];
