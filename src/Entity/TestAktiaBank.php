<?php

namespace Tupas\Entity;

/**
 * Defines the test Aktia bank.
 *
 * @package Tupas\Entity
 */
final class TestAktiaBank extends BaseAktiaBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        parent::__construct();
        $this->certVersion = '0003';
        $this->receiverId = '3333333333333';
        $this->receiverKey = '1234567890123456789012345678901234567890123456789012345678901234';
        $this->idType = '02';
        $this->keyVersion = '0001';
        $this->algorithm = '03';
    }
}
