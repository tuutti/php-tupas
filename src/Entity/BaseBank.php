<?php

namespace Tupas\Entity;

/**
 * Class BaseBank.
 *
 * @package Tupas\Entity
 */
abstract class BaseBank implements BankInterface
{
    /**
     * The action id.
     *
     * All the banks use the same action id.
     *
     * @var int
     */
    protected $actionId = 701;

    /**
     * The url to Tupas service.
     *
     * @var string
     */
    protected $actionUrl;

    /**
     * The certificate version.
     *
     * @var string
     */
    protected $certVersion;

    /**
     * The receiver id.
     *
     * @var string
     */
    protected $receiverId;

    /**
     * The receiver key.
     *
     * @var string
     */
    protected $receiverKey;

    /**
     * The id type.
     *
     * @var string
     */
    protected $idType;

    /**
     * The key version.
     *
     * @var string
     */
    protected $keyVersion;

    /**
     * The hashing algorithm.
     *
     * @var string
     */
    protected $algorithm;

  /**
   * The bank number.
   *
   * @var int
   */
    protected $bankNumber;

    /**
     * {@inheritdoc}
     */
    public function getActionId()
    {
        return $this->actionId;
    }

    public function getActionUrl()
    {
        return $this->actionUrl;
    }

    public function getCertVersion()
    {
        return $this->certVersion;
    }

    public function getReceiverId()
    {
        return $this->receiverId;
    }

    public function getReceiverKey()
    {
        return $this->receiverKey;
    }

    public function getIdType()
    {
        return $this->idType;
    }

    public function getKeyVersion()
    {
        return $this->keyVersion;
    }

    public function getAlgorithm()
    {
        return $this->algorithm;
    }

    public function getBankNumber()
    {
        return $this->bankNumber;
    }
}
