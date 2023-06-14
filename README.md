# InvoiceXpress integration for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/square-bit/invoicexpress-for-laravel.svg?style=flat-square)](https://packagist.org/packages/square-bit/invoicexpress-for-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/square-bit/invoicexpress-for-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/square-bit/invoicexpress-for-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/square-bit/invoicexpress-for-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/square-bit/invoicexpress-for-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/square-bit/invoicexpress-for-laravel.svg?style=flat-square)](https://packagist.org/packages/square-bit/invoicexpress-for-laravel)

Integrate your Laravel application with [InvoiceXpress](https://invoicexpress.com/)' API

## Concept

This package can be used on 2 different layers:
- via the provided Models.
- interacting directly with the API endpoint.

Using the former allows you to **transparently** create, update and delete entities both in your application's database and in InvoiceXpress.


## Installation

You can install the package via composer:

```bash
composer require square-bit/invoicexpress-for-laravel
```

Optionally, you can publish and run the migrations:

```bash
php artisan vendor:publish --tag="invoicexpress-for-laravel-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="invoicexpress-for-laravel-config"
```

This is the contents of the published config file:

```php
return [
    'account' => [
        'name' => env('IX_ACCOUNT_NAME'),
        'api_key' => env('IX_API_KEY'),
    ],
    'service_endpoint' => 'app.invoicexpress.com',
    'eloquent' => [
        'persist' => false,
    ],
];
```
`IX_ACCOUNT_NAME` is your InvoiceXpress account name (the XXX in https://XXX.app.invoicexpress.com).

`IX_API_KEY` is the API key you can get from your InvoiceXpress account settings page.

`persist` defines whether to store the entities in your database, when using the "Model" layer. Default is `false`.
If you set it to `true`, make sure you ran the migrations.

## Usage

### Option 1 - Via the model layer
With this approach, the package handles **both local and remote changes to the entities.**

This however is **not enabled by default**. To enable it:
- publish and run the migrations (see _Installation_)
- set `persist => true` in the config file (see _Installation_)

You can get a specific Item and update it:
```php
use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\Model\IxItem;

$item = IxItem::find(1234);
$item->description = "a serious description";
$item->save();
```
Or you can create one:
```php
$data = ItemData::from([...]);
$item = (new IxItem())->fromData($data)
    ->save();
```
Or even delete it:
```php
$item->delete();
```
---

#### Invoice lifecycle:
```php
$invoice = (new IxInvoice())
    ->setClient(IxClient::findOrFail(1234)) // set the invoice's client
    ->addItem(IxItem::find(2345)) // add an IxItem model
    ->addItem(ItemData::from([....])) // you can also add from an ItemData
    ->addItems([  // or from an array
        ItemData::from([...]),
        IxItem::find(3579),
        ...
    ])
    ->save(); // creates the new invoice (locally and in InvoiceXpress)
    ->finalizeDocument() // formally registers the invoice
    ->email(); // email the invoice to the client
    
$receipt = $invoice
    ->pay() // issue a receipt of payment
    ->email(); // email that receipt to the client;
```
---
### Option 2 - Directly using the endpoints
With this approach, **only remote changes are handled**. If you want, you'll have to manage local changes (in your database) manually. 

You can get a specific Item and update it:
```php
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

$itemsEndpoint = InvoiceXpress::items();

$itemData = $itemsEndpoint->get(1234);
$itemData->description = "a serious description";
$itemsEndpoint->update($itemData);
```
Or you can create one:
```php
$data = ItemData::from([...]);
$itemData = InvoiceXpress::items()->create($itemData);
```
Or even delete it:
```php
InvoiceXpress::items()->delete(1234);
```

#### Invoice lifecycle:

```php
use Squarebit\InvoiceXpress\API\Data\ClientData;
use Squarebit\InvoiceXpress\API\Data\InvoiceData;
use Squarebit\InvoiceXpress\API\Data\ItemData;
use Squarebit\InvoiceXpress\API\Enums\EntityTypeEnum;
use Squarebit\InvoiceXpress\Facades\InvoiceXpress;

$invoiceEndpoint = InvoiceXpress::invoices();
$invoiceEndpoint->create(
    EntityTypeEnum::Invoice,
    InvoiceData::from([
        ...
        'client' => ClientData::from([
            ...
        ]),
        'items' => [
            ItemData::from([])
        ]
    ]))
    ->setClient(IxClient::findOrFail(1234)) // set the invoice's client
    ->setClient(IxClient::findOrFail(1234)) // or set it from the
    ->addItem(IxItem::find(2345)) // add an IxItem model
    ->addItem(ItemData::from([....])) // you can also add from an ItemData
    ->addItems([  // or from an array
        ItemData::from([...]),
        IxItem::find(3579),
        ...
    ])
    ->save(); // creates the new invoice (locally and in InvoiceXpress)
    ->finalizeDocument() // formally registers the invoice
    ->email(); // email the invoice to the client
    
$receipt = $invoice
    ->pay() // issue a receipt of payment
    ->email(); // email that receipt to the client;
```

### You can mix both options, if you want
```php
$itemsEndpoint = InvoiceXpress::items();

// get an Item by querying the endpoint directly
$itemData = $itemsEndpoint->get(1234);

// create an IxItem model with that data and update it
$item = (new IxItem())->fromData($itemData);
$item->description = 'a more serious description';

// send the modifed data to InvoiceXpress
$itemsEndpoint->update($item->getData());
```
---
### Available entities
| InvoiceXpress entity         | Model class         | Endpoint class    |
|------------------------------|---------------------|-------------------|
| Items                        | IxItem              | ItemsEndpoint     |
| Taxes                        | IxTax               | TaxesEndpoint     |
| Clients                      | IxIClient           | ClientsEndpoint   |
| Invoices (Invoice)           | IxInvoice           | InvoicesEndpoint  |
| Invoices (SimplifiedInvoice) | IxSimplifiedInvoice | InvoicesEndpoint  |
| Invoices (InvoiceReceipt)    | IxInvoiceReceipt    | InvoicesEndpoint  |
| Invoices (Receipt)           | IxReceipt           | InvoicesEndpoint  |
| Invoices (CreditNote)        | IxCreditNote        | InvoicesEndpoint  |
| Invoices (DebitNote)         | IxDebitNote         | InvoicesEndpoint  |
| Invoices (CashInvoice)       | IxCashInvoice       | InvoicesEndpoint  |
| Invoices (VatMossInvoice)    | IxVatMossInvoice    | InvoicesEndpoint  |
| Invoices (VatMossReceipt)    | IxVatMossReceipt    | InvoicesEndpoint  |
| Invoices (VatMossCreditNote) | IxVatMossCreditNote | InvoicesEndpoint  |
| Estimates (Quote)            | IxQuote             | EstimatesEndpoint |
| Estimates (Proforma)         | IxProforma          | EstimatesEndpoint |
| Estimates (FeesNote)         | IxFeesNote          | EstimatesEndpoint |
| Guides (Shipping)            | IxShipping          | GuidesEndpoint    |
| Guides (Transport)           | IxTransport         | GuidesEndpoint    |
| Guides (Devolution)          | IxDevolution        | GuidesEndpoint    |
| Sequences                    | IxSequence          | SequencesEndpoint |
| SAF-T                        | -                   | SaftEndpoint      |

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Squarebit, Lda](https://github.com/square-bit)
- [All Contributors](../../contributors)
- [Spatie's Laravel Data](https://github.com/spatie/laravel-data)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
