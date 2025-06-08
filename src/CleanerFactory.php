<?php

declare(strict_types=1);

namespace Eyeskiller\XssRemove;

use Eyeskiller\XssRemove\Cleaner\ArrayCleaner;
use Eyeskiller\XssRemove\Cleaner\HtmlCleaner;
use Eyeskiller\XssRemove\Cleaner\StringCleaner;

/**
 * Factory class for creating cleaner instances.
 *
 * @version    2.0.0
 */
class CleanerFactory
{
    /**
     * Create a string cleaner instance
     *
     * @param bool $addSlashes Whether to use addslashes for additional security
     * @return StringCleaner
     */
    public function createStringCleaner(bool $addSlashes = false): StringCleaner
    {
        return new StringCleaner($addSlashes);
    }

    /**
     * Create an array cleaner instance
     *
     * @param bool $addSlashes Whether to use addslashes for additional security
     * @return ArrayCleaner
     */
    public function createArrayCleaner(bool $addSlashes = false): ArrayCleaner
    {
        return new ArrayCleaner($addSlashes);
    }

    /**
     * Create an HTML cleaner instance
     *
     * @param bool $addSlashes Whether to use addslashes for additional security
     * @param array|null $allowedTags Custom allowed tags configuration
     * @return HtmlCleaner
     */
    public function createHtmlCleaner(bool $addSlashes = false, ?array $allowedTags = null): HtmlCleaner
    {
        return new HtmlCleaner($addSlashes, $allowedTags);
    }
}
