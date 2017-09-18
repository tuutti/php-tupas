<?php

namespace Tupas\Form;

interface TupasFormInterface
{

    /**
     * Builds the form array.
     *
     * @return array
     *   The array of form values.
     */
    public function build();

    /**
     * Sets the cancellation url (A01Y_CANLINK).
     *
     * @param string $url
     *   The url.
     *
     * @return $this
     */
    public function setCancelUrl($url);

    /**
     * Gets the cancel url (A01Y_CANLINK).
     *
     * @return string
     *   The absolute url to the cancel page.
     */
    public function getCancelUrl();

    /**
     * Sets the rejected url (A01Y_REJLINK).
     *
     * @param string $url
     *   The url.
     *
     * @return $this
     */
    public function setRejectedUrl($url);

    /**
     * Gets the rejected url (A01Y_REJLINK).
     *
     * @return string
     *   The absolute url to the rejected page.
     */
    public function getRejectedurl();

    /**
     * Sets the return url (A01Y_RETLINK).
     *
     * @param string $url
     *   The url.
     *
     * @return $this
     */
    public function setReturnUrl($url);

    /**
     * Gets the return url (A01Y_RETLINK).
     *
     * @return string
     *   The absolute url to the return page.
     */
    public function getReturnUrl();

    /**
     * Sets the transaction ID.
     *
     * @param string $transactionId
     *   The transaction ID.
     *
     * @return $this
     */
    public function setTransactionId($transactionId);

    /**
     * Gets the transaction ID.
     *
     * This is used to make request unique and to validate
     * returning customer.
     *
     * By default this is a random zero-padded number between 0 and 999999.
     *
     * @return string
     *   The transaction ID.
     */
    public function getTransactionId();

    /**
     * Generates an unique stamp based on transaction id (A01Y_STAMP).
     *
     * Date (yyyymmddhhiiss) + transaction id (6 digit int).
     * For example: 20160612142352123456.
     *
     * @return string
     *   The unique stamp.
     */
    public function getStamp();

    /**
     * Sets the language code.
     *
     * @param string $language
     *   The language code.
     *
     * @return $this
     */
    public function setLanguage($language);

    /**
     * Gets the Tupas service language code (A01Y_LANGCODE).
     *
     * @return string
     *   The language code.
     */
    public function getLanguage();
}
