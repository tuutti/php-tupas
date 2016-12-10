<?php

namespace TupasTests;

use Tupas\Tupas;

/**
 * @coversDefaultClass \Tupas\Tupas
 */
class TupasTest extends \PHPUnit_Framework_TestCase
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
     * Tests validate() method exceptions.
     *
     * @covers ::__construct
     * @covers ::validate
     * @covers ::get
     * @covers \Tupas\Exception\TupasGenericException
     * @dataProvider validateGenericExceptionDataProvider
     * @expectedException \Tupas\Exception\TupasGenericException
     */
    public function testValidateGenericException($given)
    {
        $sut = new Tupas($this->bank, $given);
        $sut->validate();
    }

    public function validateGenericExceptionDataProvider()
    {
        return [
            [
                [],
            ],
            [
                ['B02K_MAC' => '123'],
            ],
            [
                [
                    'B02K_MAC' => 123,
                    'B02K_VERS' => 123,
                    'B02K_TIMESTMP' => 123,
                    'B02K_IDNBR' => 123,
                    'B02K_STAMP' => 123,
                    'B02K_CUSTNAME' => 123,
                    'B02K_KEYVERS' => 123,
                    'B02K_ALG' => 123,
                    'B02K_CUSTID' => 123,
                    'B02K_CUSTTYPE' => '08',
                ],
            ]
        ];
    }

    /**
     * Tests validate() method HashMatchException.
     *
     * @covers ::__construct
     * @covers ::validate
     * @covers ::get
     * @covers \Tupas\Exception\HashMatchException
     * @dataProvider validateHashMatchExceptionDataProvider
     * @expectedException \Tupas\Exception\HashMatchException
     */
    public function testValidateHashMatchException($given)
    {
        $sut = new Tupas($this->bank, $given);
        $sut->validate();
    }

    public function validateHashMatchExceptionDataProvider()
    {
        return [
            [
                [
                    'B02K_MAC' => 123,
                    'B02K_VERS' => 123,
                    'B02K_TIMESTMP' => 123,
                    'B02K_IDNBR' => 123,
                    'B02K_STAMP' => 123,
                    'B02K_CUSTNAME' => 123,
                    'B02K_KEYVERS' => 123,
                    'B02K_ALG' => 123,
                    'B02K_CUSTID' => 123,
                    'B02K_CUSTTYPE' => 123,
                ],
            ]
        ];
    }

    /**
     * Tests validate() method HashMatchException.
     *
     * @covers ::__construct
     * @covers ::validate
     * @covers ::get
     * @covers ::isValidTransaction
     * @covers \Tupas\TupasEncryptionTrait
     * @dataProvider validateDataProvider
     */
    public function testValidate($given, $stamp, $alg)
    {
        $this->bank->expects($this->any())
            ->method('getAlgorithm')
            ->will($this->returnValue($alg));

        $this->bank->expects($this->any())
            ->method('getReceiverKey')
            ->will($this->returnValue('333'));

        $sut = new Tupas($this->bank, $given);
        $return = $sut->validate();

        $this->assertTrue($return);
        $this->assertTrue($sut->isValidTransaction($stamp));
        $this->assertFalse($sut->isValidTransaction(strrev($stamp)));
    }

    public function validateDataProvider()
    {
        return [
            [
                [
                    'B02K_MAC' => '9F5C42C17DC5F4DBBEF2347C361DFE06',
                    'B02K_VERS' => 123,
                    'B02K_TIMESTMP' => 123,
                    'B02K_IDNBR' => 123,
                    'B02K_STAMP' => '20161212232323123456',
                    'B02K_CUSTNAME' => 123,
                    'B02K_KEYVERS' => 123,
                    'B02K_ALG' => '01',
                    'B02K_CUSTID' => 123,
                    'B02K_CUSTTYPE' => 123,
                ],
                '123456',
                '01',
            ],
            [
                [
                    'B02K_MAC' => 'D3DDBDD399FBBED4F5227F5652FCC377074FE18A',
                    'B02K_VERS' => 123,
                    'B02K_TIMESTMP' => 123,
                    'B02K_IDNBR' => 123,
                    'B02K_STAMP' => '20161212232323123456',
                    'B02K_CUSTNAME' => 123,
                    'B02K_KEYVERS' => 123,
                    'B02K_ALG' => '02',
                    'B02K_CUSTID' => 123,
                    'B02K_CUSTTYPE' => 123,
                ],
                '123456',
                '02',
            ],
            [
                [
                    'B02K_MAC' => 'F65334D7D78C2109C44C0709727CF3E764CEDE3217F4AF4D9EDCEB83D826C48D',
                    'B02K_VERS' => 123,
                    'B02K_TIMESTMP' => 123,
                    'B02K_IDNBR' => 123,
                    'B02K_STAMP' => '20161212232323123456',
                    'B02K_CUSTNAME' => 123,
                    'B02K_KEYVERS' => 123,
                    'B02K_ALG' => '03',
                    'B02K_CUSTID' => 123,
                    'B02K_CUSTTYPE' => 123,
                ],
                '123456',
                '03',
            ],
            [
                [
                    'B02K_MAC' => '483CC4833F5705913268FD3B35A133ACA49A5C19CE5A9502E142424D8DF36F1E',
                    'B02K_VERS' => 123,
                    'B02K_TIMESTMP' => 123,
                    'B02K_IDNBR' => 123,
                    'B02K_STAMP' => '20161212232323123456',
                    'B02K_CUSTNAME' => 123,
                    'B02K_KEYVERS' => 123,
                    'B02K_ALG' => '03',
                    'B02K_CUSTID' => 123,
                    'B02K_CUSTTYPE' => '08',
                    'B02K_USRID' => 123,
                    'B02K_USERNAME' => 'username',
                ],
                '123456',
                '03',
            ],
        ];
    }

    /**
     * Tests isValidTransaction() method.
     *
     * @covers ::isValidTransaction
     * @covers ::get
     */
    public function testIsValidTransaction()
    {
        $sut = new Tupas($this->bank, []);
        $this->assertFalse($sut->isValidTransaction('123456'));
        $sut = new Tupas($this->bank, ['B02K_STAMP' => '20161212232323123456']);
        $this->assertTrue($sut->isValidTransaction('123456'));
        $this->assertFalse($sut->isValidTransaction('1234567'));
    }
}
