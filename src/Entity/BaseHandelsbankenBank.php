<?php

namespace Tupas\Entity;

/**
 * Defines a Handelsbanken bank.
 *
 * @package Tupas\Entity
 */
abstract class BaseHandelsbankenBank extends BaseBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        $this->actionUrl = 'https://tunnistepalvelu.samlink.fi/TupasTunnistus/SHBtupas.html';
        $this->bankNumber = 310;
    }
}
