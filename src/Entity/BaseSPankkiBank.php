<?php

namespace Tupas\Entity;

/**
 * Defines an S-Pankki bank.
 *
 * @package Tupas\Entity
 */
abstract class BaseSPankkiBank extends BaseBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        $this->actionUrl = 'https://online.s-pankki.fi/service/identify';
        $this->bankNumber = 390;
    }
}
