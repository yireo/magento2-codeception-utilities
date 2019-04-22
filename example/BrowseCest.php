<?php
declare(strict_types=1);

use Yireo\Codeception\Utils\Product;

/**
 * Class BrowseCest
 */
class BrowseCest
{
    /**
     * Some random tests to show the utilities
     *
     * @param AcceptanceTester $I
     */
    public function testForWelcomeMessage(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->wait(2);
        $I->see('Default welcome msg');

        $product = Product::getFirstProduct();
        $I->amOnPage(Product::getUrlFromProduct($product));
        $I->see($product->getName());
    }
}
