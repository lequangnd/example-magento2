<?php
namespace Dtn\Office\Controller\Test;

use Magento\Framework\App\Action\Context;
use Psr\Log\LoggerInterface;

class Log extends \Magento\Framework\App\Action\Action
{
    protected $logger;

    public function __construct(
        Context $context,
        LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->logger = $logger;
    }

    public function execute()
    {
        $this->logger->info('Testing custom logger using virtual type.');
        echo 'Log was written. Check var/log/dtn.log';
    }
}
