<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3d273164b9596b5cda0a39117fe4d4ad
{
    public static $files = array (
        'e39a8b23c42d4e1452234d762b03835a' => __DIR__ . '/..' . '/ramsey/uuid/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Ramsey\\Uuid\\' => 12,
            'Ramsey\\Collection\\' => 18,
        ),
        'B' => 
        array (
            'Brick\\Math\\' => 11,
        ),
        'A' => 
        array (
            'Aslfaslas\\PhpFunkosComplejo\\' => 28,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ramsey\\Uuid\\' => 
        array (
            0 => __DIR__ . '/..' . '/ramsey/uuid/src',
        ),
        'Ramsey\\Collection\\' => 
        array (
            0 => __DIR__ . '/..' . '/ramsey/collection/src',
        ),
        'Brick\\Math\\' => 
        array (
            0 => __DIR__ . '/..' . '/brick/math/src',
        ),
        'Aslfaslas\\PhpFunkosComplejo\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3d273164b9596b5cda0a39117fe4d4ad::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3d273164b9596b5cda0a39117fe4d4ad::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit3d273164b9596b5cda0a39117fe4d4ad::$classMap;

        }, null, ClassLoader::class);
    }
}