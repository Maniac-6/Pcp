<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc5ce812f3476cbf5123de71d2f8943e8
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Models\\' => 7,
        ),
        'C' => 
        array (
            'Controllers\\' => 12,
            'Components\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controllers',
        ),
        'Components\\' => 
        array (
            0 => __DIR__ . '/../..' . '/components',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc5ce812f3476cbf5123de71d2f8943e8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc5ce812f3476cbf5123de71d2f8943e8::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
