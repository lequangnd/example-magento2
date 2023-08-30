<?php

namespace Dtn\Office\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class EmployeeDeleteBefore implements ObserverInterface
{
    /**
     * Logger
     *
     * @var LoggerInterface
     */
    protected $_logger;

    /**
     * EmployeeDeleteBefore constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->_logger = $logger;
    }

    /**
     * Write to a custom to log file
     *
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        $employee = $observer->getObject();
        $this->_logger->info('Employee delete before', $employee->getData());
    }
}
