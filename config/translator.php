<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Translation Repositories
    |--------------------------------------------------------------------------
    |
    | Here are each of the repositories which will retrieve the translations.
    |
    | If a translation is present in many repositories, the first translation
    | found will be returned. When no repository has the translation, the
    | translation from default language files will be returned.
    */

    'repositories' => [
        \CrossTimeTech\Laravel\Translation\Repositories\DatabaseRepository::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Translation Cache
    |--------------------------------------------------------------------------
    |
    | Here you may configure the caching backend for translations. By using
    | the cache, the repositories will be touched only first time when
    | retrieving a translation group.
    |
    */

    'cache' => [

        /*
        |--------------------------------------------------------------------------
        | Translation Cache Status
        |--------------------------------------------------------------------------
        |
        | This option determines if the translations must be cached or not.
        |
        */

        'enabled' => env('TRANSLATOR_CACHE_ENABLED', true),

        /*
        |--------------------------------------------------------------------------
        | Translation Cache Driver
        |--------------------------------------------------------------------------
        |
        | This option defines which cache store to use while storing the
        | translations. All cache stores can be found at /config/cache.php.
        |
        */

        'driver' => env('TRANSLATOR_CACHE_DRIVER', 'file'),

        /*
        |--------------------------------------------------------------------------
        | Translation Cache Tag
        |--------------------------------------------------------------------------
        |
        | This option allows you to tag all translations in the cache. So instead
        | of flushing the entire cache, you can flush only the translations.
        |
        | Attention, you should provide a tag name only if you choose a cache
        | store (driver) that supports tags.
        |
        */

        'tag' => env('TRANSLATOR_CACHE_TAG', null),

        /*
        |--------------------------------------------------------------------------
        | Translation Cache Key
        |--------------------------------------------------------------------------
        |
        | This option defines the keys prefix for caching the translations.
        |
        */

        'key' => env('TRANSLATOR_CACHE_KEY', 'translator_'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Translation Database
    |--------------------------------------------------------------------------
    |
    | Here you may configure the repository that stores the translations in
    | the database.
    |
    */

    'database' => [

        /*
        |--------------------------------------------------------------------------
        | Translation Database Migration
        |--------------------------------------------------------------------------
        |
        | If your application works with database repository, make this option
        | "true" to automatically load the migration that creates the
        | translations table.
        |
        */

        'migrate' => true,

        /*
        |--------------------------------------------------------------------------
        | Translation Database Connection
        |--------------------------------------------------------------------------
        |
        | Here you may specify which database connection to use when migrating
        | the translations table or working with database repository.
        |
        */

        'connection' => null,

        /*
        |--------------------------------------------------------------------------
        | Translation Database Table
        |--------------------------------------------------------------------------
        |
        | Here you may specify the name of translations table. If no table name
        | is specified, the "translations" table will be used.
        |
        */

        'table' => null,

        /*
        |--------------------------------------------------------------------------
        | Translation Model
        |--------------------------------------------------------------------------
        |
        | Here you can specify which model class to use to store the translations
        | in the database.
        |
        */

        'model' => \CrossTimeTech\Laravel\Translation\Database\Translation::class,
    ],
];