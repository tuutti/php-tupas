<?php

namespace Tupas\Entity;

/**
 * Defines an Ålandsbanken bank.
 *
 * @package Tupas\Entity
 */
abstract class BaseAlandsbankenBank extends BaseBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        $this->actionUrl = 'https://online.alandsbanken.fi/service/identify';
        $this->bankNumber = 600;
    }
}
