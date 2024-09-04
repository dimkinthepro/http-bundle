<?php

declare(strict_types=1);

namespace Dimkinthepro\Http\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public const ROOT_NODE = 'dimkinthepro_http';
    public const REQUEST_VALIDATION_ENABLED_KEY = 'request_validation_enabled';
    public const REQUEST_VALIDATION_ENABLED_VALUE = true;
    public const EXTRA_FIELDS_ALLOWED_KEY = 'extra_fields_allowed';
    public const EXTRA_FIELDS_ALLOWED_VALUE = true;
    public const HANDLE_VALIDATION_ERRORS_KEY = 'handle_validation_errors';
    public const HANDLE_VALIDATION_ERRORS_VALUE = true;
    public const RESPONSE_ERROR_FORMAT_KEY = 'response_error_format';
    public const RESPONSE_ERROR_FORMAT_VALUE = true;

    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder(self::ROOT_NODE);

        $treeBuilder
            ->getRootNode()
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode(self::REQUEST_VALIDATION_ENABLED_KEY)
                    ->defaultValue(self::REQUEST_VALIDATION_ENABLED_VALUE)
                ->end()
                ->scalarNode(self::EXTRA_FIELDS_ALLOWED_KEY)
                    ->defaultValue(self::EXTRA_FIELDS_ALLOWED_VALUE)
                ->end()
                ->scalarNode(self::HANDLE_VALIDATION_ERRORS_KEY)
                    ->defaultValue(self::HANDLE_VALIDATION_ERRORS_VALUE)
                ->end()
                ->scalarNode(self::RESPONSE_ERROR_FORMAT_KEY)
                    ->defaultValue(self::RESPONSE_ERROR_FORMAT_VALUE)
                ->end()
            ->end();

        return $treeBuilder;
    }
}
