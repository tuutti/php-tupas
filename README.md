#php-tupas
[![Build Status](https://travis-ci.org/tuutti/php-tupas.svg?branch=master)](https://travis-ci.org/tuutti/php-tupas) [![codecov](https://codecov.io/gh/tuutti/php-tupas/branch/master/graph/badge.svg)](https://codecov.io/gh/tuutti/php-tupas)

##Install
````
composer require tuutti/php-tupas
````

##Testing

Run tests with phpunit.

````
./vendor/bin/phpunit
````

##Usage
###Building tupas button/form
Create a new class that implements `\Tupas\Entity\BankInterface`.

````php
<?php
class YourBankClass implements \Tupas\Entity\BankInterface {
    // Add required getters and populate required values.
}
...
/** @var \Tupas\Entity\BankInterface $bank */
$bank = new YourBankClass();
...

$form = new \Tupas\Form\TupasForm($bank);
$form->setCancelUrl('http://example.com/tupas/cancel')
    ->setRejectedUrl('http://example.com/tupas/rejected')
    ->setReturnUrl('http://example.com/tupas/return')
    ->setLanguage('FI');
````
Generate and store transaction id in a storage that persists over multiple requests, for example:

````php
<?php
$_SESSION['transaction_id'] = $form->getTransactionId();
````
Note: This is not required, but *highly* recommended as otherwise users can reuse their valid authentication urls as many times they want.

Build your form:
````php
<?php
foreach ($form->build() as $key => $value) {
    // Your form logic should generate a hidden input field:
    // <input type="hidden" name="$key", value="$value">
}
````

Set form action:
````
<form method="..." action="$bank->getActionUrl();">
````

###Validating returning customer
````php
<?php
...
// You should always use the bank number (three first
// characters of B02K_STAMP) to validate the bank.
// Something like:
$bank_number = substr($_GET['B02K_STAMP'], 0, 3);
...

$tupas = new \Tupas\Tupas($bank, $_GET);
// Compare transaction id stored in a persistent storage against
// the one returned by the Tupas service.
if (!$tupas->isValidTransaction($_SESSION['transaction_id'])) {
    // Transaction id validation failed.
}
try {
    $tupas->validate();
}
catch (\Tupas\Exception\TupasGenericException $e) {
    // Validation failed due to missing parameters.
}
catch (\Tupas\Exception\HashMatchException $e) {
    // Validation failed due to hash mismatch.
}
````
Invalidate transaction id after a successful authentication:
````php
<?php
unset($_SESSION['transaction_id']);
````

##Examples
https://github.com/tuutti/tupas


