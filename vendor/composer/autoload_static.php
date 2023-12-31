<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb64a23053d55257dfd29b851e7ebfc83
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Facebook\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Facebook\\' => 
        array (
            0 => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb64a23053d55257dfd29b851e7ebfc83::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb64a23053d55257dfd29b851e7ebfc83::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb64a23053d55257dfd29b851e7ebfc83::$classMap;

        }, null, ClassLoader::class);
    }
}
