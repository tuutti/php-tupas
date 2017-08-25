<?php

namespace Tupas\Entity;

/**
 * Defines an Aktia bank.
 *
 * @package Tupas\Entity
 */
abstract class BaseAktiaBank extends BaseBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        $this->actionUrl = 'https://auth.aktia.fi/tupastest';
        $this->bankNumber = 410;
    }
}
