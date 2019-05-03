# Yireo Codeception utilities for Magento 2
This package contains utilities for using [Codeception](https://codeception.com/) in Magento 2.

## Features
- Bootstrap your real-life Magento 2 application within Codeception;
- Base your tests on real-life data from Magento 2;

## Notes on Codeception & MFTF
First of all, this package assumes you have installed Magento 2 and Codeception along side each other. It also assumes both are installed as a composer-package. The bootstrap procedure expects the path of this package itself, the Magento 2 core and Composer to be found through `vendor`.

Codeception is not installed as a depenency of this package. In Magento 2.3, the Magento Functional Testing Framework (MFTF) is already installed and it ships with Codeception. Alternatively, follow the composer-documentation of Codeception. Make also sure to run the Codeception configuration procedure, so that you have a working `tests/` folder in your Magento root.

Please note that this package has zero added-value for MFTF. MFTF is about functional tests. This project assumes a separate Codeception to be used for acceptance tests.

## Installation
To install this package, use the following:

    composer require yireo/magento2-codeception-utilities

Please note that this package is NOT a Magento 2 module. There is no need to enable any module here.

## Magento 2 Bootstrap
Add the following to your `codeception.yml` in the Magento root:

    extensions:
        enabled:
            - Yireo\Codeception\Extension\MagentoBootstrap

Once this extension is active in Codeception, it will run the Magento 2 bootstrap. The `url` within the WebDriver module is now automatically configured with the URL of your Magento 2 shop, plus the Magento bootstrap is run automatically.

Because our approach assumes the Codeception installation to be run in a local environment, this would also assume your Magento 2 developer environment is picked up with the appropriate Base URL. 

## Using `Utils` in your tests
See the `example/` folder for example CESTs to re-use information of Magento 2 within your tests. You can for instance use the utility class `\Yireo\Codeception\Utils\Product` to load a random product, so you can easily navigate to its product URL and scan for attributes. 