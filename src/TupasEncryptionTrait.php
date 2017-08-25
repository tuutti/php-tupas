<?php

namespace Tupas;

trait TupasEncryptionTrait
{
    /**
     * Hash mac based on encryption algorithm.
     *
     * @param string $mac
     *   Plaintext mac.
     * @param string $algorithm
     *   Hashing algorithm.
     *
     * @return string
     *    Hashed MAC.
     */
    protected function hash($mac, $algorithm)
    {
        if ($algorithm === '01') {
            $mac = md5($mac);
        } elseif ($algorithm === '03') {
            $mac = hash('sha256', $mac);
        } else {
            $mac = sha1($mac);
        }
        return strtoupper($mac);
    }

    /**
     * Generate checksum.
     *
     * @param array $parts
     *   Parts used to generate checksum.
     * @param string $algorithm
     *   The hashing algorithm.
     *
     * @return string
     *   Hashed checksum.
     */
    protected function checksum(array $parts, $algorithm)
    {
        return $this->hash(implode('&', $parts) . '&', $algorithm);
    }
}
