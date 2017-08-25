<?php

namespace Tupas\Entity;

/**
 * Defines the test Osuuspankki bank.
 *
 * @package Tupas\Entity
 */
final class TestOsuuspankkiBank extends BaseOsuuspankkiBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        parent::__construct();
        $this->certVersion = '0003';
        $this->receiverId = 'Esittelymyyja';
        $this->receiverKey = 'Esittelykauppiaansalainentunnus';
        $this->idType = '02';
        $this->keyVersion = '0001';
        $this->algorithm = '03';
    }
}
