<?php

namespace Tupas\Entity;

/**
 * Defines a Danske Bank.
 *
 * @package Tupas\Entity
 */
abstract class BaseDanskeBank extends BaseBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        $this->actionUrl = 'https://verkkopankki.danskebank.fi/SP/tupaha/TupahaApp';
        $this->bankNumber = 800;
    }
}
