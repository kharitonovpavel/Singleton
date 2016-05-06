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
            // Check to see if a method has been created to create the singleton instance.
            if (method_exists(static::class, 'createSingleton') && is_callable([static::class, 'createSingleton'])) {
                static::$singletonInstances[$instanceId] = static::createSingleton($instanceId);
            } else {
                static::$singletonInstances[$instanceId] = new static();
            }

            // Allow some sort of initialization for the singleton objects.
            if (method_exists(static::$singletonInstances[$instanceId], 'initSingleton') && is_callable([static::$singletonInstances[$instanceId], 'initSingleton'])) {
                static::$singletonInstances[$instanceId]->initSingleton($instanceId);
            }
        }

        return static::$singletonInstances[$instanceId];
    }

}