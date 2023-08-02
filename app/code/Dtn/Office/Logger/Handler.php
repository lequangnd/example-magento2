<?php

namespace Dtn\Office\Logger;

use Magento\Framework\Logger\Handler\Base as BaseHandler;
use Monolog\Logger as MonologLogger;

class Handler extends BaseHandler
{
    /**
     * Logging level
     *
     * @var int
     */
    protected $loggerType = MonologLogger::INFO;

    /**
     * File name
     *
     * @var string
     */
    protected $fileName = '/var/log/dtn.log';
}
