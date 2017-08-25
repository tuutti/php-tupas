<?php

namespace Tupas\Entity;

/**
 * Defines a Saastopankki bank.
 *
 * @package Tupas\Entity
 */
abstract class BaseSaastopankkiBank extends BaseBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        $this->actionUrl = 'https://tupas.saastopankki.fi';
        $this->bankNumber = 420;
    }
}
