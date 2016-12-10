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
     * Sets the cancellation url.
     *
     * @param string $url
     *   The url.
     *
     * @return $this
     */
    public function setCancelUrl($url);

    /**
     * Gets the cancel url.
     *
     * @return string
     *   The absolute url to the cancel page.
     */
    public function getCancelUrl();

    /**
     * Sets the rejected url.
     *
     * @param string $url
     *   The url.
     *
     * @return $this
     */
    public function setRejectedUrl($url);

    /**
     * Gets the rejected url.
     *
     * @return string
     *   The absolute url to the rejected page.
     */
    public function getRejectedurl();

    /**
     * Sets the return url.
     *
     * @param string $url
     *   The url.
     *
     * @return $this
     */
    public function setReturnUrl($url);

    /**
     * Gets the return url.
     *
     * @return string
     *   The absolute url to the return page.
     */
    public function getReturnUrl();

    /**
     * Sets the transaction id.
     *
     * @param int $transaction_id
     *   The transaction id.
     *
     * @return $this
     */
    public function setTransactionId($transaction_id);

    /**
     * Gets the transaction id.
     *
     * @return int
     *   The transaction id.
     */
    public function getTransactionId();

    /**
     * Generates an unique stamp based on transaction id.
     *
     * @return string
     *   The unique stamp.
     */
    public function getStamp();

    /**
     * Sets array of allowed languages.
     *
     * @param array $languages
     *   The allowed languages.
     *
     * @return $this
     */
    public function setLanguages(array $languages);

    /**
     * Gets array of allowed languages.
     *
     * @return array
     *   The array of allowed languages.
     */
    public function getLanguages();

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
     * Gets the Tupas service language code.
     *
     * @return string
     *   The language code.
     */
    public function getLanguage();
}
