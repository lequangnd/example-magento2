<?php

namespace Dtn\Office\Controller\Test;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Psr\Log\LoggerInterface;

class Log extends Action
{
    protected $logger;

    public function __construct(Context $context, LoggerInterface $logger)
    {
        parent::__construct($context);
        $this->logger = $logger;
    }

    public function execute()
    {
        $this->logger->info('This is a test log message.');
        exit('Log has been written to var/log/dtn.log.');
    }
}
