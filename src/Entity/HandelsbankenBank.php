<?php

namespace Tupas\Entity;

/**
 * Defines Handelsbanken.
 *
 * @package Tupas\Entity
 */
final class HandelsbankenBank extends BaseBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        $this->actionUrl = 'https://tunnistepalvelu.samlink.fi/TupasTunnistus/SHBtupas.html';
        $this->certVersion = '0002';
        $this->receiverId = '1111111111111';
        $this->receiverKey = '11111111111111111111';
        $this->idType = '02';
        $this->keyVersion = '0001';
        $this->algorithm = '03';
        $this->bankNumber = 310;
    }
}
