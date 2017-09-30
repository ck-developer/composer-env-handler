<?php

namespace Ck\EnvHandler;

use Composer\Script\Event;

class ScriptHandler
{
    public static function buildParameters(Event $event)
    {
        $processor = new Processor($event->getIO());

        $processor->process();
    }
}
