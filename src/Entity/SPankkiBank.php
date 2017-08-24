<?php

namespace Tupas\Entity;

/**
 * Defines S-Pankki.
 *
 * @package Tupas\Entity
 */
final class SPankkiBank extends BaseBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        $this->actionUrl = 'https://online.s-pankki.fi/service/identify';
        $this->certVersion = '0002';
        $this->receiverId = 'SPANKKITUPAS';
        $this->receiverKey = 'SPANKKI';
        $this->idType = '02';
        $this->keyVersion = '0001';
        $this->algorithm = '03';
        $this->bankNumber = 390;
    }
}
