<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4992d5cecf0b2763bc0e43145bdba4e7
{
    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'mikehaertl\\wkhtmlto\\' => 20,
            'mikehaertl\\tmp\\' => 15,
            'mikehaertl\\shellcommand\\' => 24,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'mikehaertl\\wkhtmlto\\' => 
        array (
            0 => __DIR__ . '/..' . '/mikehaertl/phpwkhtmltopdf/src',
        ),
        'mikehaertl\\tmp\\' => 
        array (
            0 => __DIR__ . '/..' . '/mikehaertl/php-tmpfile/src',
        ),
        'mikehaertl\\shellcommand\\' => 
        array (
            0 => __DIR__ . '/..' . '/mikehaertl/php-shellcommand/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4992d5cecf0b2763bc0e43145bdba4e7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4992d5cecf0b2763bc0e43145bdba4e7::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
