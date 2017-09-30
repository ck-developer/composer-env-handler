<?php

namespace Ck\EnvHandler;

use Composer\IO\IOInterface;
use Symfony\Component\Dotenv\Dotenv;

class Processor
{
    /**
     * @var IOInterface $io
     */
    private $io;

    /**
     * Processor constructor.
     * @param IOInterface $io
     */
    public function __construct(IOInterface $io)
    {
        $this->io = $io;
    }

    public function process()
    {
        $file = '.env';
        $distFile = '.env.dist';
        $appEnvName = 'APP_ENV';
        $patternEnvFile = '.env.{env}';

        $actualParams = $this->fileExist($file, true) ? $this->parse($file) : [];
        $distParams = $this->parse($distFile);

        if (false !== getenv('APP_ENV')) {
            $envParams = [];
            $distParams = array_merge($distParams, $envParams);
        }

        $params = array_diff_key(
            $distParams,
            $actualParams
        );

        foreach ($params as $key => $value) {
            $distParams[$key] = $this->askParam($key, $value);
        }

        file_put_contents('.env', $this->dump($distParams));
    }

    private function askParam($key, $default)
    {
        if (false === $this->io->isInteractive()) {
            return $default;
        }

        return $this->io->ask(sprintf('<question>%s</question> (<comment>%s</comment>): ', $key, $default), $default);
    }

    private function parse($path)
    {
        return (new Dotenv())->parse(file_get_contents($path), $path);
    }

    private function dump($params)
    {
        $contents = '';

        foreach ($params as $key => $value) {
            $contents .= $key . '=' . $value . PHP_EOL;
        }

        return $contents;
    }

    private function fileExist($path, $warrnig = false)
    {
        $exist = is_file($path);

        if(false === $exist) {
            $this->io->write(sprintf('<warning>not file exist %s</warning>', $path));
        }

        return $exist;
    }
}
