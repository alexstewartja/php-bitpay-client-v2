<?php

namespace BitPaySDK\Test\Model\Invoice;

use BitPaySDK\Model\Invoice\SupportedTransactionCurrencies;
use BitPaySDK\Model\Invoice\SupportedTransactionCurrency;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class SupportedTransactionCurrenciesTest extends TestCase
{
    public function testInstanceOf()
    {
        $supportedTransactionCurrencies = $this->createClassObject();
        self::assertInstanceOf(SupportedTransactionCurrencies::class, $supportedTransactionCurrencies);
    }

    public function testGetBTC()
    {
        /**
         * @var SupportedTransactionCurrency|MockObject
         */
        $expectedSupportedTransactionCurrency = $this->getMockBuilder(SupportedTransactionCurrency::class)->getMock();
        $supportedTransactionCurrencies = $this->createClassObject();
        $supportedTransactionCurrencies->setBTC($expectedSupportedTransactionCurrency);
        self::assertEquals($expectedSupportedTransactionCurrency, $supportedTransactionCurrencies->getBTC());
    }

    public function testGetBCH()
    {
        /**
         * @var SupportedTransactionCurrency|MockObject
         */
        $expectedSupportedTransactionCurrency = $this->getMockBuilder(SupportedTransactionCurrency::class)->getMock();
        $supportedTransactionCurrencies = $this->createClassObject();
        $supportedTransactionCurrencies->setBCH($expectedSupportedTransactionCurrency);
        self::assertEquals($expectedSupportedTransactionCurrency, $supportedTransactionCurrencies->getBCH());
    }

    public function testGetETH()
    {
        /**
         * @var SupportedTransactionCurrency|MockObject
         */
        $expectedSupportedTransactionCurrency = $this->getMockBuilder(SupportedTransactionCurrency::class)->getMock();
        $supportedTransactionCurrencies = $this->createClassObject();
        $supportedTransactionCurrencies->setETH($expectedSupportedTransactionCurrency);
        self::assertEquals($expectedSupportedTransactionCurrency, $supportedTransactionCurrencies->getETH());
    }

    public function testGetUSDC()
    {
        /**
         * @var SupportedTransactionCurrency|MockObject
         */
        $expectedSupportedTransactionCurrency = $this->getMockBuilder(SupportedTransactionCurrency::class)->getMock();
        $supportedTransactionCurrencies = $this->createClassObject();
        $supportedTransactionCurrencies->setUSDC($expectedSupportedTransactionCurrency);
        self::assertEquals($expectedSupportedTransactionCurrency, $supportedTransactionCurrencies->getUSDC());
    }

    public function testGetGUSD()
    {
        /**
         * @var SupportedTransactionCurrency|MockObject
         */
        $expectedSupportedTransactionCurrency = $this->getMockBuilder(SupportedTransactionCurrency::class)->getMock();
        $supportedTransactionCurrencies = $this->createClassObject();
        $supportedTransactionCurrencies->setGUSD($expectedSupportedTransactionCurrency);
        self::assertEquals($expectedSupportedTransactionCurrency, $supportedTransactionCurrencies->getGUSD());
    }

    public function testGetPAX()
    {
        /**
         * @var SupportedTransactionCurrency|MockObject
         */
        $expectedSupportedTransactionCurrency = $this->getMockBuilder(SupportedTransactionCurrency::class)->getMock();
        $supportedTransactionCurrencies = $this->createClassObject();
        $supportedTransactionCurrencies->setPAX($expectedSupportedTransactionCurrency);
        self::assertEquals($expectedSupportedTransactionCurrency, $supportedTransactionCurrencies->getPAX());
    }

    public function testGetXRP()
    {
        /**
         * @var SupportedTransactionCurrency|MockObject
         */
        $expectedSupportedTransactionCurrency = $this->getMockBuilder(SupportedTransactionCurrency::class)->getMock();
        $supportedTransactionCurrencies = $this->createClassObject();
        $supportedTransactionCurrencies->setXRP($expectedSupportedTransactionCurrency);
        self::assertEquals($expectedSupportedTransactionCurrency, $supportedTransactionCurrencies->getXRP());
    }

    public function testToArray()
    {
        /**
         * @var SupportedTransactionCurrency|MockObject
         */
        $expectedSupportedTransactionCurrency = $this->getMockBuilder(SupportedTransactionCurrency::class)->getMock();
        $expectedSupportedTransactionCurrency->expects(self::once())
            ->method('toArray')
            ->willReturn(['enabled' => true, 'reason' => 'test']);
        $supportedTransactionCurrencies = $this->createClassObject();
        $supportedTransactionCurrencies->setBTC($expectedSupportedTransactionCurrency);
        $supportedTransactionCurrenciesArray = $supportedTransactionCurrencies->toArray();

        self::assertNotNull($supportedTransactionCurrenciesArray);
        self::assertIsArray($supportedTransactionCurrenciesArray);

        self::assertArrayHasKey('btc', $supportedTransactionCurrenciesArray);
        self::assertArrayNotHasKey('bch', $supportedTransactionCurrenciesArray);
        self::assertEquals(['btc' => ['enabled' => true,  'reason' => 'test']], $supportedTransactionCurrenciesArray);
    }

    public function testToArrayEmptyKey()
    {
        $supportedTransactionCurrencies = $this->createClassObject();
        $supportedTransactionCurrenciesArray = $supportedTransactionCurrencies->toArray();

        self::assertNotNull($supportedTransactionCurrenciesArray);
        self::assertIsArray($supportedTransactionCurrenciesArray);

        self::assertArrayNotHasKey('btc', $supportedTransactionCurrenciesArray);
    }

    private function createClassObject(): SupportedTransactionCurrencies
    {
        return new SupportedTransactionCurrencies();
    }
}
