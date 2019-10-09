# PDF builder into Nette Framework

-----

[![Build Status](https://travis-ci.org/surda/pdf.svg?branch=master)](https://travis-ci.org/surda/pdf)
[![Licence](https://img.shields.io/packagist/l/surda/pdf.svg?style=flat-square)](https://packagist.org/packages/surda/pdf)
[![Latest stable](https://img.shields.io/packagist/v/surda/pdf.svg?style=flat-square)](https://packagist.org/packages/surda/pdf)
[![PHPStan](https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat)](https://github.com/phpstan/phpstan)

## Installation

The recommended way to is via Composer:

```
composer require surda/pdf
```

After that you have to register extension in config.neon:

```yaml
extensions:
    pdf: Surda\Pdf\DI\PdfExtension
```

## Configuration

Default
```yaml
pdf:
    template:
        defaults:
            layout: @@default
        config:
            layout: @@default
```

## Usage

### Builder

```php
/** @var Surda\Pdf\IPdfBuilderFactory @inject */
public $pdfBuilderFactory;
```

```php
// Builder
$builder = $this->pdfBuilderFactory->create();

// Template
$builder->setTemplateFile(__DIR__ . '/path/to/template.latte');
$builder->setParameters([
    'foo' => 'World!',
]);

// Get Mpdf
$mpdf = $builder->getMpdf();

$this->sendResponse(new PdfResponse($mpdf->Output('file.pdf', \MPdf\Output\Destination::DOWNLOAD)));
```

### Template

Each template has many internal variables:

- `$_defaults` - refer default configuration
- `$_config` - refer custom configuration

```html
{layout defaults->layout}

{block #content}
    Hello, {$foo}
{/block}
```