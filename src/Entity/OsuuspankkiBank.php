<?php

namespace Tupas\Entity;

/**
 * Defines Osuuspankki.
 *
 * @package Tupas\Entity
 */
final class OsuuspankkiBank extends BaseBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        $this->actionUrl = 'https://kultaraha.op.fi/cgi-bin/krcgi';
        $this->certVersion = '0003';
        $this->receiverId = 'Esittelymyyja';
        $this->receiverKey = 'Esittelykauppiaansalainentunnus';
        $this->idType = '02';
        $this->keyVersion = '0001';
        $this->algorithm = '03';
        $this->bankNumber = 500;
    }
}
