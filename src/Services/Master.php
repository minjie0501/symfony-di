<?php

namespace App\Services;

class Master
{
    private Transform $converter;
    private MonoLogger $monoLogger;

    public function __construct(MonoLogger $monoLogger, Transform $capitalizer)
    {
        $this->monoLogger = $monoLogger;
        $this->converter = $capitalizer;
    }

    public function doTheMagic(string $userInput): string
    {
        $logger = $this->monoLogger;
        $converter = $this->converter;
        $logger->do($userInput);
        return $converter->transform($userInput);
    }
}
