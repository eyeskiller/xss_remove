<?php

declare(strict_types=1);

namespace Eyeskiller\XssRemove\Cleaner;

/**
 * HTML cleaner for sanitizing HTML content while preserving safe tags.
 *
 * @version    2.0.0
 */
class HtmlCleaner extends AbstractCleaner
{
    /**
     * @var array Allowed HTML tags and their attributes
     */
    private array $allowedTags = [
        'a' => ['href' => true, 'title' => true, 'target' => true, 'rel' => true],
        'p' => ['class' => true],
        'br' => [],
        'em' => [],
        'strong' => [],
        'ul' => ['class' => true],
        'ol' => ['class' => true],
        'li' => ['class' => true],
        'h1' => ['class' => true],
        'h2' => ['class' => true],
        'h3' => ['class' => true],
        'h4' => ['class' => true],
        'h5' => ['class' => true],
        'h6' => ['class' => true],
        'blockquote' => ['cite' => true],
        'code' => [],
        'pre' => [],
        'div' => ['class' => true, 'id' => true],
        'span' => ['class' => true],
        'img' => ['src' => true, 'alt' => true, 'title' => true, 'width' => true, 'height' => true, 'class' => true],
        'table' => ['class' => true, 'width' => true],
        'tr' => ['class' => true],
        'td' => ['class' => true, 'colspan' => true, 'rowspan' => true],
        'th' => ['class' => true, 'colspan' => true, 'rowspan' => true, 'scope' => true],
        'thead' => [],
        'tbody' => [],
        'tfoot' => []
    ];

    /**
     * @var StringCleaner
     */
    private StringCleaner $stringCleaner;

    /**
     * Constructor
     *
     * @param bool $addSlashes Whether to use addslashes for additional security
     * @param array|null $allowedTags Custom allowed tags configuration
     */
    public function __construct(bool $addSlashes = false, ?array $allowedTags = null)
    {
        parent::__construct($addSlashes);
        $this->stringCleaner = new StringCleaner($addSlashes);

        if ($allowedTags !== null) {
            $this->allowedTags = $allowedTags;
        }
    }

    /**
     * Set allowed HTML tags and attributes
     *
     * @param array $allowedTags Allowed tags configuration
     * @return self
     */
    public function setAllowedTags(array $allowedTags): self
    {
        $this->allowedTags = $allowedTags;
        return $this;
    }

    /**
     * Get allowed HTML tags and attributes
     *
     * @return array
     */
    public function getAllowedTags(): array
    {
        return $this->allowedTags;
    }

    /**
     * Set whether to use addslashes
     *
     * @param bool $addSlashes Whether to use addslashes
     * @return self
     */
    public function setAddSlashes(bool $addSlashes): self
    {
        parent::setAddSlashes($addSlashes);
        $this->stringCleaner->setAddSlashes($addSlashes);
        return $this;
    }

    /**
     * Sanitizes HTML content while preserving safe tags.
     *
     * @param string $html HTML content to sanitize
     * @return string Sanitized HTML
     */
    public function clean(string $html): string
    {
        // Use HTML Purifier if available (recommended to add as a dependency)
        if (class_exists('\HTMLPurifier')) {
            $config = \HTMLPurifier_Config::createDefault();
            $purifier = new \HTMLPurifier($config);
            return $purifier->purify($html);
        }

        // Basic sanitization using strip_tags with allowed tags
        $allowedTagsString = '';
        foreach ($this->allowedTags as $tag => $attributes) {
            $allowedTagsString .= "<$tag>";
        }

        $cleanHtml = strip_tags($html, $allowedTagsString);

        // Apply additional XSS protection
        return $this->stringCleaner->clean($cleanHtml);
    }
}
