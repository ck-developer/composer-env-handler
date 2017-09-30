<?php

namespace Ck\Composer;

use Ck\EnvHandler\Processor;
use Composer\IO\BufferIO;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Output\OutputInterface;

class ProcessorTest extends TestCase
{
    private $io;

    /**
     * @var Processor
     */
    private $processor;

    protected function setUp()
    {
        parent::setUp();

        $this->io = new BufferIO('', OutputInterface::VERBOSITY_VERBOSE);
        $this->processor = new Processor($this->io);
    }

    public function testProcess()
    {
        chdir(__DIR__ . '/fixtures');

        $this->processor->process();
    }
}
