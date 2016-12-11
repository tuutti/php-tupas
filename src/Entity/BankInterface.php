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
     * Gets the action id (A01Y_ACTION_ID).
     *
     * Example value: 701.
     *
     * @return int
     *   The action id.
     */
    public function getActionId();

    /**
     * Gets the action url.
     *
     * This is url to the Tupas service.
     *
     * Example: https://auth.aktia.fi/tupastest.
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
     * Gets the receiver id (A01Y_RCVID).
     *
     * Example: 3333333333333.
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
     * Gets the id type (A01Y_IDTYPE).
     *
     * Example: 02.
     *
     * @return string
     *   The id type.
     */
    public function getIdType();

    /**
     * Gets the key version (A01Y_KEYVERS).
     *
     * Example: 0001.
     *
     * @return string
     *   The key version.
     */
    public function getKeyVersion();

    /**
     * Gets the used hashing algorithm (A01Y_ALG).
     *
     * 01 = md5, 02 = sha1, 03 = sha256.
     *
     * @return string
     *   The algorithm.
     */
    public function getAlgorithm();

    /**
     * Gets the bank number.
     *
     * This will be used to validate the bank when
     * returning from the Tupas service.
     *
     * Example: 410 for Aktia.
     *
     * @return int
     *   The bank number.
     */
    public function getBankNumber();
}
