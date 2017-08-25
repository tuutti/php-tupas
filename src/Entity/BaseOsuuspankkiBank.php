<?php

namespace Tupas\Entity;

/**
 * Defines an Osuuspankki bank.
 *
 * @package Tupas\Entity
 */
abstract class BaseOsuuspankkiBank extends BaseBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        $this->actionUrl = 'https://kultaraha.op.fi/cgi-bin/krcgi';
        $this->bankNumber = 500;
    }
}
