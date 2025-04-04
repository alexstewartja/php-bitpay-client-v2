<?php

namespace BitPaySDK\Test\Model\Rate;

use BitPaySDK\Client;
use BitPaySDK\Exceptions\BitPayApiException;
use BitPaySDK\Exceptions\BitPayGenericException;
use BitPaySDK\Model\Rate\Rate;
use BitPaySDK\Model\Rate\Rates;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class RatesTest extends TestCase
{
    public function testInstanceOf()
    {
        $rates = $this->createClassObject();
        self::assertInstanceOf(Rates::class, $rates);
    }

    public function testGetRates()
    {
        $rates = $this->createClassObject();

        $ratesArray = $rates->getRates();
        self::assertIsArray($ratesArray);
    }

    /**
     * @throws BitPayApiException
     */
    public function testUpdate(): void
    {
        $bch = new Rate();
        $bch->setName('Bitcoin Cash');
        $bch->setCode('BCH');
        $bch->setRate(229.19);

        $expectedRatesArray = [$bch];
        $expectedRates = new Rates($expectedRatesArray);
        /**
         * @var Client|MockObject
         */
        $bp = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $bp->method('getRates')->willReturn($expectedRates);

        $rates = new Rates([]);
        self::assertEquals([], $rates->getRates());

        $rates->update($bp);

        self::assertEquals($expectedRatesArray, $rates->getRates());
    }

    public function testUpdateShouldThrowsExceptionsForInvalidRateFormat(): void
    {
        $rates = $this->createClassObject();
        $this->expectException(BitPayGenericException::class);

        $clientApiResponse = [
            [
                'name' => 'Bitcoin Cash',
                'code' => 'BCH',
                'rate' => 229.19
            ]
        ];
        $expectedRates = new Rates($clientApiResponse);
        /**
         * @var Client|MockObject
         */
        $bp = $this->getMockBuilder(Client::class)->disableOriginalConstructor()->getMock();
        $bp->method('getRates')->willReturn($expectedRates);

        $rates->update($bp);
    }

    public function testGetRateException()
    {
        $rates = $this->createClassObject();
        $this->expectException(BitPayGenericException::class);
        $this->expectExceptionMessage('Currency code WRG must be a type of Model.Currency');
        $rates->getRate('WRG');
    }

    /**
     * @throws BitPayApiException
     */
    public function testGetRate()
    {
        $expectedValue = 12;

        $rateMock = $this->getMockBuilder(Rate::class)->disableOriginalConstructor()->getMock();
        $rateMock->method('getCode')->willReturn('BTC');
        $rateMock->method('getRate')->willReturn(12.0);

        $rates = [$rateMock];
        $rates = new Rates($rates);

        self::assertEquals($expectedValue, $rates->getRate('BTC'));
    }

    public function testToArray()
    {
        $rates = $this->createClassObject();
        $ratesEmpty = new Rates([]);
        $ratesArray = $rates->toArray();

        $ratesEmptyArray = $ratesEmpty->toArray();

        self::assertIsArray($ratesArray);
        self::assertArrayNotHasKey('rates', $ratesEmptyArray);
    }

    private function createClassObject(): Rates
    {
        $rates = [new Rate()];

        return new Rates($rates);
    }
}
