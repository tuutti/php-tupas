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
     * {@inheritdoc}
     */
    public function getActionId()
    {
        return $this->actionId;
    }
}
