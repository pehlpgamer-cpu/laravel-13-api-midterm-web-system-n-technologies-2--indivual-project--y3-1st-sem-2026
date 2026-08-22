<?php

declare(strict_types=1);

// use Rector\Config\RectorConfig;
// use Rector\Php55\Rector\String_\StringClassNameToClassConstantRector;
// use RectorLaravel\Set\LaravelLevelSetList;
// use RectorLaravel\Set\LaravelSetList;

// return RectorConfig::configure()
//     ->withImportNames()
//     ->withPaths([
//         __DIR__ . '/src',
//         __DIR__ . '/tests',
//         __DIR__ . '/config',
//     ])
//     ->withSkip([
//         // for tests
//         '*/Source/*',
//         '*/Fixture/*',
//         '*/tests/NodeAnalyzer/fixtures/*',

//         // skip for handle scoped, like in the rector-src as well
//         // @see https://github.com/rectorphp/rector-src/blob/7f73cf017214257c170d34db3af7283eaeeab657/rector.php#L71
//         StringClassNameToClassConstantRector::class,
//     ])
//     ->withPhpSets()
//     ->withPreparedSets(deadCode: true, codeQuality: true, naming: true);
//     ->withSets([
//         LaravelLevelSetList::UP_TO_LARAVEL_130,
//         LaravelSetList::LARAVEL_ARRAYACCESS_TO_METHOD_CALL,
//         LaravelSetList::LARAVEL_ARRAY_STR_FUNCTION_TO_STATIC_CALL,
//         LaravelSetList::LARAVEL_CODE_QUALITY,
//         LaravelSetList::LARAVEL_COLLECTION,
//         LaravelSetList::LARAVEL_CONTAINER_STRING_TO_FULLY_QUALIFIED_NAME,
//         LaravelSetList::LARAVEL_ELOQUENT_MAGIC_METHOD_TO_QUERY_BUILDER,
//         LaravelSetList::LARAVEL_FACADE_ALIASES_TO_FULL_NAMES,
//         LaravelSetList::LARAVEL_IF_HELPERS,
//         LaravelSetList::LARAVEL_LEGACY_FACTORIES_TO_CLASSES,
//         LaravelSetList::LARAVEL_STATIC_TO_INJECTION,
//         LaravelSetList::LARAVEL_TESTING,
//         LaravelSetList::LARAVEL_TYPE_DECLARATIONS,
//     ]);

/**
 * .\vendor\bin\rector --dry-run
 * OR
 * .\vendor\bin\rector
 *
 * [ERROR] The path
 *   "C:\Users\TheHonoredOne\Desktop\e-commerce---web-sys-tech-2-project\laravel-13-api-midterm-indivual-project--y3-1st-sem-2026/src" does not exist.
 *
 * huh??????????
 * also why no auto generate rector.php after install? and official docs doesn't seemed be complete?
*/
