<?php

namespace Tupas\Entity;

/**
 * Defines the Aktia bank.
 *
 * @package Tupas\Entity
 */
final class AktiaBank extends BaseBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        $this->actionUrl = 'https://auth.aktia.fi/tupastest';
        $this->certVersion = '0003';
        $this->receiverId = '3333333333333';
        $this->receiverKey = '1234567890123456789012345678901234567890123456789012345678901234';
        $this->idType = '02';
        $this->keyVersion = '0001';
        $this->algorithm = '03';
        $this->bankNumber = 410;
    }
}
