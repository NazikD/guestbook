<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8e0dcdc9dfedcd242ba66e9cee1cfa29
{
    public static $prefixLengthsPsr4 = array (
        'G' => 
        array (
            'Guestbook\\Classes\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Guestbook\\Classes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8e0dcdc9dfedcd242ba66e9cee1cfa29::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8e0dcdc9dfedcd242ba66e9cee1cfa29::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8e0dcdc9dfedcd242ba66e9cee1cfa29::$classMap;

        }, null, ClassLoader::class);
    }
}
