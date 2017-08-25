<?php

namespace Tupas\Entity;

/**
 * Defines the test Danske Bank.
 *
 * @package Tupas\Entity
 */
final class TestDanskeBank extends BaseDanskeBank
{

  /**
   * Constructs a new instance.
   */
    public function __construct()
    {
        parent::__construct();
        $this->certVersion = '0003';
        $this->receiverId = '000000000000';
        $this->receiverKey = 'jumCLB4T2ceZWGJ9ztjuhn5FaeZnTm5HpfDXWU2APRqfDcsrBs8mqkFARzm7uXKd';
        $this->idType = '02';
        $this->keyVersion = '0001';
        $this->algorithm = '03';
    }
}
