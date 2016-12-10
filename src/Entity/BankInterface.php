<?php

namespace Tupas\Entity;

/**
 * Interface BankInterface.
 *
 * @package Tupas\Entity
 */
interface BankInterface
{
    /**
     * Gets the action id.
     *
     * @return int
     *   The action id.
     */
    public function getActionId();

    /**
     * Gets the action url.
     *
     * @return string
     *   The url to Tupas service.
     */
    public function getActionUrl();

    /**
     * Gets the certification version.
     *
     * @return string
     *   The certification version.
     */
    public function getCertVersion();

    /**
     * Gets the receiver id.
     *
     * @return string
     *   The receiver id.
     */
    public function getReceiverId();

    /**
     * Gets the receiver key.
     *
     * @return string
     *   The receiver key.
     */
    public function getReceiverKey();

    /**
     * Gets the id type.
     *
     * @return string
     *   The id type.
     */
    public function getIdType();

    /**
     * Gets the key version.
     *
     * @return string
     *   The key version.
     */
    public function getKeyVersion();

    /**
     * Gets the used hashing algorithm.
     *
     * @return string
     *   The algorithm.
     */
    public function getAlgorithm();

    /**
     * Gets the bank number.
     *
     * @return int
     *   The bank number.
     */
    public function getBankNumber();
}
