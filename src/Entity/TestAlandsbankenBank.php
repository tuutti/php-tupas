<?php

namespace Tupas\Entity;

/**
 * Defines the test Ålandsbanken bank.
 *
 * @package Tupas\Entity
 */
final class TestAlandsbankenBank extends BaseAlandsbankenBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        parent::__construct();
        $this->certVersion = '0002';
        $this->receiverId = 'AABTUPASID';
        $this->receiverKey = 'PAPAGAJA';
        $this->idType = '02';
        $this->keyVersion = '0001';
        $this->algorithm = '03';
    }
}
