<?php

namespace Tupas\Form;

use Tupas\Entity\BankInterface;
use Tupas\TupasEncryptionTrait;
use Webmozart\Assert\Assert;

class TupasForm implements TupasFormInterface
{
    use TupasEncryptionTrait;

    /**
     * The transaction date-time.
     *
     * @var \DateTime
     */
    protected $dateTime;

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
    protected $allowedLanguages = ['EN', 'FI', 'SV'];

    /**
     * The current language.
     *
     * @var string
     */
    protected $language;

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
     * Constructs a new instance.
     *
     * @param BankInterface $bank
     *   The bank.
     * @param string $defaultLanguage
     *   The ISO-639 1 code of the default user interface language.
     * @param \DateTime $dateTime
     *   The transaction date-time or NULL to use the current date-time.
     */
    public function __construct(BankInterface $bank, $defaultLanguage = 'en', \DateTime $dateTime = null)
    {
        $this->bank = $bank;
        $this->setLanguage($defaultLanguage);
        $this->dateTime = $dateTime ?: new \DateTime();
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
     * Asserts a valid URl.
     *
     * @param mixed $url
     *   The URL
     *
     * @return null
     *
     * @throws \InvalidArgumentException
     *   Thrown if the value is not a valid URl.
     */
    private function assertValidUrl($url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException(sprintf('"%s" is not a valid URL.', $url));
        }
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function setCancelUrl($url)
    {
        $this->assertValidUrl($url);
        $this->cancelUrl = $url;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCancelUrl()
    {
        Assert::string($this->cancelUrl);
        return $this->cancelUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function setRejectedUrl($url)
    {
        $this->assertValidUrl($url);
        $this->rejectedUrl = $url;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRejectedUrl()
    {
        Assert::string($this->rejectedUrl);
        return $this->rejectedUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function setReturnUrl($url)
    {
        $this->assertValidUrl($url);
        $this->returnUrl = $url;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getReturnUrl()
    {
        Assert::string($this->returnUrl);
        return $this->returnUrl;
    }

    /**
     * {@inheritdoc}
     */
    public function setTransactionId($transaction_id)
    {
        Assert::integer($transaction_id);
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
        $transactionId = (string)$this->getTransactionId();
        $transactionId = str_repeat('0', 6 - strlen($transactionId)) . $transactionId;
        return sprintf('%s%s', $this->dateTime->format('YmdHis'), $transactionId);
    }

    /**
     * {@inheritdoc}
     */
    public function getLanguage()
    {
        return $this->language ? $this->language : $this->defaultLanguage;
    }

    /**
     * {@inheritdoc}
     */
    public function setLanguage($language)
    {
        $language = strtoupper($language);
        Assert::oneOf($language, $this->allowedLanguages);
        $this->language = $language;
        return $this;
    }
}
