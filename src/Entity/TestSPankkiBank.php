<?php

namespace Tupas\Entity;

/**
 * Defines the test S-Pankki bank.
 *
 * @package Tupas\Entity
 */
final class TestSPankkiBank extends BaseSPankkiBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        parent::__construct();
        $this->certVersion = '0002';
        $this->receiverId = 'SPANKKITUPAS';
        $this->receiverKey = 'SPANKKI';
        $this->idType = '02';
        $this->keyVersion = '0001';
        $this->algorithm = '03';
    }
}
