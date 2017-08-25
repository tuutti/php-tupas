<?php

namespace Tupas\Entity;

/**
 * Defines the test Nordea bank.
 *
 * @package Tupas\Entity
 */
final class TestNordeaBank extends BaseNordeaBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        parent::__construct();
        $this->certVersion = '0002';
        $this->receiverId = '87654321';
        $this->receiverKey = 'LEHTI';
        $this->idType = '02';
        $this->keyVersion = '0001';
        $this->algorithm = '03';
    }
}
