<?php
declare(strict_types=1);

namespace Yireo\Codeception\Extension;

use Codeception\Event\SuiteEvent;
use Codeception\Events;
use Codeception\Exception\ModuleConfigException;
use Codeception\Exception\ModuleException;
use Codeception\Extension;
use Codeception\Suite;
use Exception;
use Magento\Framework\App\Bootstrap;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\ObjectManager;

/**
 * Class MagentoBootstrap
 * @package Jola\Codeception\Extension
 */
class MagentoBootstrap extends Extension
{
    /**
     * @var array
     */
    public static $events = [
        Events::SUITE_BEFORE => 'execute'
    ];

    /**
     * @param SuiteEvent $e
     * @throws ModuleConfigException
     * @throws ModuleException
     * @throws Exception
     */
    public function execute(SuiteEvent $e)
    {
        $suite = $e->getSuite();
        if ($suite->getBaseName() !== 'acceptance') {
            return;
        }

        $this->bootstrap();
        $this->setBaseUrl($suite);
    }

    /**
     * @param Suite $suite
     * @throws ModuleConfigException
     * @throws ModuleException
     */
    private function setBaseUrl(Suite $suite)
    {
        $objectManager = ObjectManager::getInstance();

        /** @var ScopeConfigInterface $scopeConfig */
        $scopeConfig = $objectManager->get(ScopeConfigInterface::class);
        $baseUrl = $scopeConfig->getValue('web/unsecure/base_url');

        $modules = $suite->getModules();
        foreach ($modules as $module) {
            if (!$module instanceof \Codeception\Module\WebDriver) {
                continue;
            }

            /** @var $module \Codeception\Module\WebDriver */
            $module->_setConfig(['url' => $baseUrl]);
        }
    }

    /**
     * @return Bootstrap
     * @throws Exception
     */
    private function bootstrap(): Bootstrap
    {
        $bootstrapFile = __DIR__ . '/../../../../../app/bootstrap.php';
        if (!file_exists($bootstrapFile)) {
            throw new Exception($bootstrapFile . ' could not be found');
        }

        require_once $bootstrapFile;
        return Bootstrap::create(BP, $_SERVER);
    }
}
