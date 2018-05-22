<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit09b12014f5c7fac32aee96e203b1cdf2
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'Twilio\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Twilio\\' => 
        array (
            0 => __DIR__ . '/..' . '/twilio/sdk/Twilio',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit09b12014f5c7fac32aee96e203b1cdf2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit09b12014f5c7fac32aee96e203b1cdf2::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}