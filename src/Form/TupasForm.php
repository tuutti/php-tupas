<?php

namespace Tupas\Form;

use Tupas\Entity\BankInterface;
use Tupas\TupasEncryptionTrait;

class TupasForm implements TupasFormInterface
{
    use TupasEncryptionTrait;

    /**
     * The transaction id.
     *
     * @var string
     */
    protected $transactionId;

    /**
     * The allowed languages.
     *
     * @var array
     */
    protected $languages = ['EN', 'FI', 'SV'];

    /**
     * The current language.
     *
     * @var string
     */
    protected $language = 'EN';

    /**
     * The cancel url.
     *
     * @var string
     */
    protected $cancelUrl;

    /**
     * The rejected url.
     *
     * @var string
     */
    protected $rejectedUrl;

    /**
     * The return url.
     *
     * @var string
     */
    protected $returnUrl;

    /**
     * The bank.
     *
     * @var BankInterface
     */
    protected $bank;

    /**
     * TupasForm constructor.
     *
     * @param BankInterface $bank
     *   The bank.
     */
    public function __construct(BankInterface $bank)
    {
        $this->bank = $bank;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        $values = [
          'A01Y_ACTION_ID' => $this->bank->getActionId(),
          'A01Y_VERS' => $this->bank->getCertVersion(),
          'A01Y_RCVID' => $this->bank->getReceiverId(),
          'A01Y_LANGCODE' => $this->getLanguage(),
          'A01Y_STAMP' => $this->getStamp(),
          'A01Y_IDTYPE' => $this->bank->getIdType(),
          'A01Y_RETLINK' => $this->getReturnUrl(),
          'A01Y_CANLINK' => $this->getCancelUrl(),
          'A01Y_REJLINK' => $this->getRejectedUrl(),
          'A01Y_KEYVERS' => $this->bank->getKeyVersion(),
          'A01Y_ALG' => $this->bank->getAlgorithm(),
        ];
        // Append receiver key.
        $checksum = $values + [$this->bank->getReceiverKey()];

        return $values + ['A01Y_MAC' => $this->checksum($checksum, $this->bank->getAlgorithm())];
    }

    /**
     * {@inheritdoc}
     */
    public function setCancelUrl($url)
    {
        $this->cancelUrl = $url;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCancelUrl()
    {
        return $this->cancelUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function setRejectedUrl($url)
    {
        $this->rejectedUrl = $url;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRejectedUrl()
    {
        return $this->rejectedUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function setReturnUrl($url)
    {
        $this->returnUrl = $url;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function setTransactionId($transaction_id)
    {
        $this->transactionId = $transaction_id;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTransactionId()
    {
        if (!$this->transactionId) {
            $this->transactionId = random_int(100000, 999999);
        }
        return $this->transactionId;
    }

    /**
     * {@inheritdoc}
     */
    public function getStamp()
    {
        return sprintf('%s%s', (new \DateTime())->format('YmdHis'), $this->getTransactionId());
    }

    /**
     * {@inheritdoc}
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * {@inheritdoc}
     */
    public function setLanguages(array $languages)
    {
        $this->languages = array_map(function ($value) {
            return strtoupper($value);
        }, $languages);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLanguage()
    {
        $language = strtoupper($this->language);

        if (in_array($language, $this->getLanguages())) {
            return $language;
        }
        return 'EN';
    }

    /**
     * {@inheritdoc}
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }
}