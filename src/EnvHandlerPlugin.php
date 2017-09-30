<?php

namespace Ck\Composer;

use Composer\Composer;
use Composer\EventDispatcher\Event;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\ScriptEvents;

class EnvHandlerPlugin implements PluginInterface, EventSubscriberInterface
{
    /**
     * @var Composer $composer
     */
    private $composer;

    /**
     * @var IOInterface $io
     */
    private $io;

    /**
     * {@inheritdoc}
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;
    }

    /**
     * @param Event $event
     */
    public function preInstall(Event $event)
    {
        var_dump($this->composer->getPackage()->getExtra());
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            ScriptEvents::PRE_INSTALL_CMD => 'preInstall'
        ];
    }
}
