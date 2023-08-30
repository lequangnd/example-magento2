<?php

namespace Dtn\Office\Model\Indexer;

use Magento\Framework\Indexer\ActionInterface as IndexerInterface;
use Magento\Framework\Mview\ActionInterface as MviewInterface;
use Psr\Log\LoggerInterface;

class EmployeeIndexer implements IndexerInterface, MviewInterface
{
    /**
     * Logger
     *
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * EmployeeIndexer constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param int[] $ids
     */
    public function execute($ids)
    {
        $this->logger->info('Indexer dtn employee is running');
    }

    /**
     * Will take all of the data and reindex
     * Will run when reindex via command line
     */
    public function executeFull()
    {
        $this->logger->info('Indexer dtn employee is running');
    }

    /**
     * Works with a set of entity changed (may be massaction)
     *
     * @param array $ids
     */
    public function executeList(array $ids)
    {
        $this->logger->info('Indexer dtn employee is running');
    }

    /**
     * Works in runtime for a single entity using plugins
     *
     * @param int $id
     */
    public function executeRow($id)
    {
        $this->logger->info('Indexer dtn employee is running');
    }
}
