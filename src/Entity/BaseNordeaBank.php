<?php

namespace Tupas\Entity;

/**
 * Defines a Nordea bank.
 *
 * @package Tupas\Entity
 */
abstract class BaseNordeaBank extends BaseBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        $this->actionUrl = 'https://tupas.nordea.fi/cgi-bin/SOLO3011';
        $this->bankNumber = 200;
    }
}
