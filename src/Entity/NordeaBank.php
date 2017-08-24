<?php

namespace Tupas\Entity;

/**
 * Defines the Nordea bank.
 *
 * @package Tupas\Entity
 */
final class NordeaBank extends BaseBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        $this->actionUrl = 'https://tupas.nordea.fi/cgi-bin/SOLO3011';
        $this->certVersion = '0002';
        $this->receiverId = '87654321';
        $this->receiverKey = 'LEHTI';
        $this->idType = '02';
        $this->keyVersion = '0001';
        $this->algorithm = '03';
        $this->bankNumber = 200;
    }
}
