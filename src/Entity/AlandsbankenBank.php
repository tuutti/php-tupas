<?php

namespace Tupas\Entity;

/**
 * Defines the Ålandsbanken bank.
 *
 * @package Tupas\Entity
 */
final class AlandsbankenBank extends BaseBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        $this->actionUrl = 'https://online.alandsbanken.fi/service/identify';
        $this->certVersion = '0002';
        $this->receiverId = 'AABTUPASID';
        $this->receiverKey = 'PAPAGAJA';
        $this->idType = '02';
        $this->keyVersion = '0001';
        $this->algorithm = '03';
        $this->bankNumber = 600;
    }
}
