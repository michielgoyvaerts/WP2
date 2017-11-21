<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1eace5a883c06250ef871ee268d44e6b
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Repository\\' => 11,
        ),
        'D' => 
        array (
            'DAO\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Repository\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Repository',
        ),
        'DAO\\' => 
        array (
            0 => __DIR__ . '/../..' . '/DAO',
        ),
    );

    public static $classMap = array (
        'AltoRouter' => __DIR__ . '/..' . '/altorouter/altorouter/AltoRouter.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1eace5a883c06250ef871ee268d44e6b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1eace5a883c06250ef871ee268d44e6b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1eace5a883c06250ef871ee268d44e6b::$classMap;

        }, null, ClassLoader::class);
    }
}
