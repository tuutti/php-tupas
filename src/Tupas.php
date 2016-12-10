<?php

namespace Tupas;

use Tupas\Entity\BankInterface;
use Tupas\Exception\HashMatchException;
use Tupas\Exception\TupasGenericException;

/**
 * Class Tupas.
 *
 * @package Tupas
 */
class Tupas
{
    use TupasEncryptionTrait;

    /**
     * The tupas bank.
     *
     * @var BankInterface
     */
    protected $bank;

    /**
     * The array of return values.
     * @var array
     */
    protected $values;

    /**
     * Tupas constructor.
     * @param BankInterface $bank
     *   The bank.
     * @param array $values
     *   The array of return values.
     */
    public function __construct(BankInterface $bank, array $values = [])
    {
        $this->bank = $bank;
        $this->values = $values;
    }

    /**
     * Gets the value.
     *
     * @param string $key
     *   The key used to fetch the value.
     *
     * @return mixed|null
     */
    protected function get($key)
    {
        return isset($this->values[$key]) ? $this->values[$key] : null;
    }

    /**
     * Validate mac from return parameters.
     *
     * @return bool
     *   Returns true if valid.
     *
     * @throws HashMatchException
     * @throws TupasGenericException
     */
    public function validate()
    {
        if (!$this->get('B02K_MAC')) {
            throw new TupasGenericException('Missing B02K_MAC argument.');
        }
        // Make sure url arguments are processed in correct order.
        $parameters = [
            'B02K_VERS',
            'B02K_TIMESTMP',
            'B02K_IDNBR',
            'B02K_STAMP',
            'B02K_CUSTNAME',
            'B02K_KEYVERS',
            'B02K_ALG',
            'B02K_CUSTID',
            'B02K_CUSTTYPE',
        ];
        $parts = [];
        foreach ($parameters as $key) {
            if (!$value = $this->get($key)) {
                throw new TupasGenericException(sprintf('Missing %s argument.', $key));
            }
            $parts[] = $value;
        }
        // Validate customer type and append required values.
        if (in_array($this->get('B02K_CUSTTYPE'), ['08', '09'])) {
            foreach (['B02K_USRID', 'B02K_USERNAME'] as $key) {
                if (!$value = $this->get($key)) {
                    throw new TupasGenericException(sprintf('Missing %s argument', $key));
                }
                $parts[] = $value;
            }
        }
        // Append rcv key.
        $parts[] = $this->bank->getReceiverKey();

        if ($this->checksum($parts, $this->bank->getAlgorithm()) !== $this->get('B02K_MAC')) {
            throw new HashMatchException('The hash does not match with given B02K_MAC.');
        }
        return true;
    }

    /**
     * Validates transaction id.
     *
     * @param int $transaction_id
     *   The transaction id.
     *
     * @return bool
     *   True if valid, false if not valid.
     */
    public function isValidTransaction($transaction_id)
    {
        // Stamp cannot be empty.
        if (!$value = $this->get('B02K_STAMP')) {
            return false;
        }
        $timestamp = substr($value, -6);

        return $transaction_id === $timestamp;
    }
}
