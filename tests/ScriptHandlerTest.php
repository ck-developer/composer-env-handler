<?php
namespace Ck\EnvHandler\Tests;

use Ck\EnvHandler\ScriptHandler;
use PHPUnit\Framework\TestCase;

class ScriptHandlerTest extends TestCase
{
    private $event;
    private $io;
    private $package;
    protected function setUp()
    {
        parent::setUp();
        $this->event = $this->prophesize('Composer\Script\Event');
        $this->io = $this->prophesize('Composer\IO\IOInterface');
        $this->package = $this->prophesize('Composer\Package\PackageInterface');
        $composer = $this->prophesize('Composer\Composer');
        $composer->getPackage()->willReturn($this->package);
        $this->event->getComposer()->willReturn($composer);
        $this->event->getIO()->willReturn($this->io);
    }
}
