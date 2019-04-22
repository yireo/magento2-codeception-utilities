# Yireo Codeception utilities

## Magento 2 Bootstrap
Install this package via `composer` and then add the following to your `codeception.yml`:

    extensions:
        enabled:
            - Yireo\Codeception\Extension\MagentoBootstrap

The `url` within the WebDriver module is now automatically configured with the URL of your Magento 2 shop, plus the Magento bootstrap is run automatically.

## Tests with Magento data
See the `example/` folder for example CESTs.