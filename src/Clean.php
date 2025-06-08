<?php

declare(strict_types=1);

namespace Eyeskiller\XssRemove;

use Eyeskiller\XssRemove\Cleaner\ArrayCleaner;
use Eyeskiller\XssRemove\Cleaner\HtmlCleaner;
use Eyeskiller\XssRemove\Cleaner\StringCleaner;

/**
 * Clean class for removing XSS and SQLi from strings and arrays.
 *
 * This class provides backward compatibility with the original methods.
 * For new code, it's recommended to use the OOP approach with the Cleaner classes directly.
 *
 * @version    2.0.0
 * @deprecated Use the Cleaner classes directly instead
 */
class Clean
{
    /**
     * @var StringCleaner
     */
    private StringCleaner $stringCleaner;

    /**
     * @var ArrayCleaner
     */
    private ArrayCleaner $arrayCleaner;

    /**
     * @var HtmlCleaner
     */
    private HtmlCleaner $htmlCleaner;

    /**
     * Constructor
     *
     * @param bool $addSlashes Whether to use addslashes for additional security
     */
    public function __construct(bool $addSlashes = false)
    {
        $this->stringCleaner = new StringCleaner($addSlashes);
        $this->arrayCleaner = new ArrayCleaner($addSlashes);
        $this->htmlCleaner = new HtmlCleaner($addSlashes);
    }

    /**
     * Set whether to use addslashes
     *
     * @param bool $addSlashes Whether to use addslashes
     * @return self
     */
    public function setAddSlashes(bool $addSlashes): self
    {
        $this->stringCleaner->setAddSlashes($addSlashes);
        $this->arrayCleaner->setAddSlashes($addSlashes);
        $this->htmlCleaner->setAddSlashes($addSlashes);
        return $this;
    }

    /**
     * Escapes all possible XSS attacks from a string.
     *
     * @param string $data String to escape
     * @param bool $addSlashes Whether to use addslashes for additional security
     * @return string Clean string
     */
    public function cleanInput(string $data, bool $addSlashes = false): string
    {
        if ($addSlashes) {
            $this->stringCleaner->setAddSlashes(true);
        }
        return $this->stringCleaner->clean($data);
    }

    /**
     * Cleans a multi-dimensional array of data.
     *
     * @param array $data Array to escape
     * @param bool $addSlashes Whether to use addslashes for additional security
     * @return array Clean array
     */
    public function cleanArray(array $data, bool $addSlashes = false): array
    {
        if ($addSlashes) {
            $this->arrayCleaner->setAddSlashes(true);
        }
        return $this->arrayCleaner->clean($data);
    }

    /**
     * Sanitizes HTML content while preserving some safe tags.
     *
     * @param string $html HTML content to sanitize
     * @return string Sanitized HTML
     */
    public function sanitizeHtml(string $html): string
    {
        return $this->htmlCleaner->clean($html);
    }
}
