<?php
declare(strict_types=1);

namespace Yireo\Codeception\Utils;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilderFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\ObjectManager;

/**
 * Class Product
 *
 * @package Yireo\Codeception\Utils
 */
class Product
{
    /**
     * @return ProductInterface
     */
    static public function getFirstProduct(): ProductInterface
    {
        $searchCriteria = self::getSearchCriteriaBuilder()
            ->setPageSize(1)
            ->create();

        $searchResult = self::getProductRepository()->getList($searchCriteria);
        $items = $searchResult->getItems();
        return array_shift($items);
    }

    /**
     * @return ProductRepositoryInterface
     */
    static public function getProductRepository(): ProductRepositoryInterface
    {
        $objectManager = ObjectManager::getInstance();
        return $objectManager->get(ProductRepositoryInterface::class);
    }

    /**
     * @return SearchCriteriaBuilder
     */
    static public function getSearchCriteriaBuilder(): SearchCriteriaBuilder
    {
        $objectManager = ObjectManager::getInstance();
        $searchCriteriaBuilderFactory = $objectManager->get(SearchCriteriaBuilderFactory::class);
        return $searchCriteriaBuilderFactory->create();
    }

    /**
     * @param ProductInterface $product
     * @return string
     */
    static public function getUrlFromProduct(ProductInterface $product): string
    {
        $urlParts = parse_url($product->getProductUrl());
        $url = $urlParts['path'];
        $url = str_replace('ide-codeception.php/', '', $url);
        $url = str_replace('codecept/', '', $url);
        return $url;
    }
}
