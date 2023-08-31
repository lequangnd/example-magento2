<?php

namespace Dtn\Office\Cron;

use Psr\Log\LoggerInterface;

class Test
{
    /**
     * Logger
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Test constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute()
    {
        $this->logger->info("Dtn cron is running");
    }
}
