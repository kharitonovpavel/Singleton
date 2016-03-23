<?php

namespace TomWright\Singleton;

trait SingletonTrait
{

    /**
     * @var array|static[]
     */
    protected static $singletonInstances = [];


    /**
     * @param string $instanceId
     * @return static
     */
    public static function getInstance($instanceId = 'default')
    {
        if (! array_key_exists($instanceId, static::$singletonInstances)) {
            static::$singletonInstances[$instanceId] = new static();

            // Allow some sort of initialization for the singleton objects.
            if (method_exists(static::$singletonInstances[$instanceId], 'initSingleton')) {
                static::$singletonInstances[$instanceId]->initSingleton($instanceId);
            }
        }

        return static::$singletonInstances[$instanceId];
    }

}