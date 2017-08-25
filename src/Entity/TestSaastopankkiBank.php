<?php

namespace Tupas\Entity;

/**
 * Defines the test Saastopankki bank.
 *
 * @package Tupas\Entity
 */
final class TestSaastopankkiBank extends BaseSaastopankkiBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        parent::__construct();
        $this->certVersion = '0002';
        $this->receiverId = '1111111111111';
        $this->receiverKey = '11111111111111111111';
        $this->idType = '02';
        $this->keyVersion = '0001';
        $this->algorithm = '03';
    }
}
