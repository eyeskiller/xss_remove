# XSS/SQLi Remover

A modern PHP library for removing XSS and SQLi vulnerabilities from strings and arrays.

## Requirements

- PHP 8.0 or higher

## Installation

### Using Composer (recommended)

```bash
composer require eyeskiller/xss-remove
```

### Manual Installation

1. Download the repository
2. Include the files in your project
3. Use the autoloader or require the files manually

## Usage

### Object-Oriented Approach (Recommended)

```php
use Eyeskiller\XssRemove\Cleaner\StringCleaner;
use Eyeskiller\XssRemove\Cleaner\ArrayCleaner;
use Eyeskiller\XssRemove\Cleaner\HtmlCleaner;
use Eyeskiller\XssRemove\CleanerFactory;

// Using factory methods (recommended)
$factory = new CleanerFactory();
$stringCleaner = $factory->createStringCleaner();
$arrayCleaner = $factory->createArrayCleaner();
$htmlCleaner = $factory->createHtmlCleaner();

// Or create instances directly
$stringCleaner = new StringCleaner();
$arrayCleaner = new ArrayCleaner();
$htmlCleaner = new HtmlCleaner();

// Clean a single string
$cleanString = $stringCleaner->clean($dirtyString);

// Clean an array (works with multi-dimensional arrays)
$cleanArray = $arrayCleaner->clean($dirtyArray);

// Sanitize HTML while preserving safe tags
$safeHtml = $htmlCleaner->clean($htmlContent);

// Configure cleaners with method chaining
$stringCleaner->setAddSlashes(true);
$cleanString = $stringCleaner->clean($dirtyString);

// Customize HTML allowed tags
$customHtmlCleaner = new HtmlCleaner(false, [
    'p' => ['class' => true],
    'br' => [],
    'strong' => []
]);
$safeHtml = $customHtmlCleaner->clean($htmlContent);
```

### Legacy Approach

```php
use Eyeskiller\XssRemove\Clean;

// Create an instance of the Clean class
$cleaner = new Clean();

// Clean a single string
$cleanString = $cleaner->cleanInput($dirtyString);

// Clean an array (works with multi-dimensional arrays)
$cleanArray = $cleaner->cleanArray($dirtyArray);

// Sanitize HTML while preserving safe tags
$safeHtml = $cleaner->sanitizeHtml($htmlContent);
```

Check the `examples` directory for complete working examples.

### Advanced Usage

#### Adding Slashes for Additional Security

```php
// Object-oriented approach
$stringCleaner = new StringCleaner(true); // Set in constructor
$cleanString = $stringCleaner->clean($dirtyString);

// Or set it after creation
$stringCleaner = new StringCleaner();
$stringCleaner->setAddSlashes(true);
$cleanString = $stringCleaner->clean($dirtyString);

// Legacy approach
$cleaner = new Clean(true); // Set in constructor
$cleanString = $cleaner->cleanInput($dirtyString);
$cleanArray = $cleaner->cleanArray($dirtyArray);

// Or set it after creation
$cleaner = new Clean();
$cleaner->setAddSlashes(true);
$cleanString = $cleaner->cleanInput($dirtyString);
$cleanArray = $cleaner->cleanArray($dirtyArray);
```

#### HTML Purifier Integration

For enhanced HTML sanitization, you can install HTML Purifier as a dependency:

```bash
composer require ezyang/htmlpurifier
```

When HTML Purifier is available, the HTML cleaning methods will automatically use it for better security.

## Class Reference

### StringCleaner

Cleans a single string from XSS and SQLi vulnerabilities.

```php
$cleaner = new StringCleaner($addSlashes = false);
$cleanString = $cleaner->clean($dirtyString);
```

### ArrayCleaner

Cleans a multi-dimensional array from XSS and SQLi vulnerabilities.

```php
$cleaner = new ArrayCleaner($addSlashes = false);
$cleanArray = $cleaner->clean($dirtyArray);
```

### HtmlCleaner

Sanitizes HTML content while preserving safe tags and attributes.

```php
$cleaner = new HtmlCleaner($addSlashes = false, $allowedTags = null);
$safeHtml = $cleaner->clean($htmlContent);
```

### CleanerFactory

Factory class for creating cleaner instances.

```php
$factory = new CleanerFactory();
$stringCleaner = $factory->createStringCleaner($addSlashes = false);
$arrayCleaner = $factory->createArrayCleaner($addSlashes = false);
$htmlCleaner = $factory->createHtmlCleaner($addSlashes = false, $allowedTags = null);
```

## Security Notes

- This library provides protection against common XSS and SQLi attacks, but it's always recommended to use prepared statements for database queries.
- For user input that will be displayed in a web page, always use proper context-specific escaping (HTML, JavaScript, CSS, etc.).
- Consider using Content Security Policy (CSP) headers for additional protection.


## Version History

- 3.0.0: Refactored to use OOP approach with multiple classes
- 2.0.0: Modern PHP 8.0+ compatibility, Composer support, new features
- 1.2.0: Original version
