<?php
namespace Dtn\Office\Controller\Override\Contact\Index;

use Magento\Framework\App\Action\HttpGetActionInterface as HttpGetActionInterface;

class Index extends \Magento\Contact\Controller\Index\Index implements HttpGetActionInterface
{
    public function execute()
    {
        echo 'controller overrided!';
        exit;
    }
}
