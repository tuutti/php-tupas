<?php

namespace TupasTests;

use Tupas\Form\TupasForm;

/**
 * @coversDefaultClass \Tupas\Form\TupasForm
 */
class TupasFormTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \Tupas\Entity\BankInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $bank;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->bank = $this->createMock('\Tupas\Entity\BankInterface');
    }

    /**
     * Tests build() method.
     *
     * @covers ::__construct
     * @covers ::getLanguage
     * @covers ::getStamp
     * @covers ::getReturnUrl
     * @covers ::getCancelUrl
     * @covers ::getRejectedUrl
     * @covers ::assertValidUrl
     * @covers ::setReturnUrl
     * @covers ::setCancelUrl
     * @covers ::setRejectedUrl
     * @covers ::setLanguage
     * @covers ::build
     * @covers \Tupas\TupasEncryptionTrait
     * @dataProvider testBuildDataProvider
     */
    public function testBuild($expected)
    {
        $this->bank->expects($this->any())
            ->method('getActionId')
            ->will($this->returnValue(701));
        $this->bank->expects($this->any())
            ->method('getCertVersion')
            ->will($this->returnValue('0001'));
        $this->bank->expects($this->any())
            ->method('getReceiverId')
            ->will($this->returnValue('333333'));
        $this->bank->expects($this->any())
            ->method('getKeyVersion')
            ->will($this->returnValue('0004'));
        $this->bank->expects($this->any())
            ->method('getAlgorithm')
            ->will($this->returnValue('01'));
        $this->bank->expects($this->any())
            ->method('getIdType')
            ->will($this->returnValue('0001'));

        $sut = new TupasForm($this->bank);
        $sut->setReturnUrl('http://localhost/return')
            ->setCancelUrl('http://localhost/cancel')
            ->setRejectedUrl('http://localhost/rej')
            ->setLanguage('FI');
        $response = $sut->build();

        $expected['A01Y_STAMP'] = $response['A01Y_STAMP'];
        $expected['A01Y_MAC'] = $response['A01Y_MAC'];

        $this->assertEquals($response, $expected);
    }

    public function testBuildDataProvider()
    {
        return [
            [
                [
                    'A01Y_ACTION_ID' => 701,
                    'A01Y_VERS' => '0001',
                    'A01Y_RCVID' => '333333',
                    'A01Y_LANGCODE' => 'FI',
                    'A01Y_IDTYPE' => '0001',
                    'A01Y_RETLINK' => 'http://localhost/return',
                    'A01Y_CANLINK' => 'http://localhost/cancel',
                    'A01Y_REJLINK' => 'http://localhost/rej',
                    'A01Y_KEYVERS' => '0004',
                    'A01Y_ALG' => '01',
                ],
            ],
        ];
    }

    /**
     * Tests transaction methods.
     *
     * @covers ::setTransactionId
     * @covers ::getTransactionId
     */
    public function testTransaction()
    {
        $sut = new TupasForm($this->bank);
        $response = $sut->getTransactionId();
        $this->assertNotNull($response);
        $this->assertEquals($sut->getTransactionId(), $response);

        $sut->setTransactionId(123456);
        $this->assertEquals($sut->getTransactionId(), 123456);
    }

    /**
     * Tests stamp generation.
     *
     * @covers ::getStamp
     *
     * @depends testTransaction
     */
    public function testGetStampWithDefinedDateTimeAndTransactionId()
    {
        $dateTime = (new \DateTime())->setTimestamp(0);
        $transactionId = 314159;
        $sut = new TupasForm($this->bank, 'en', $dateTime);
        $sut->setTransactionId($transactionId);
        $stamp = $sut->getStamp();
        $this->assertSame('19700101000000314159', $stamp);
    }

    /**
     * Tests stamp generation.
     *
     * @covers ::getStamp
     *
     * @depends testTransaction
     */
    public function testGetStampWithUndefinedDateTimeAndTransactionId()
    {
        $sut = new TupasForm($this->bank);
        $response = $sut->getStamp();
        $this->assertEquals(substr($response, -6), $sut->getTransactionId());
    }

    /**
     * @covers ::assertValidUrl
     *
     * @depends testBuild
     */
    public function testAssertValidUrl()
    {
        $sut = new TupasForm($this->bank);
        $url = 'foo bar';
        $this->expectException(\InvalidArgumentException::class);
        $sut->setCancelUrl($url);
    }
}
