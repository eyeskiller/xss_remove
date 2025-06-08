<?php

declare(strict_types=1);

namespace Eyeskiller\XssRemove\Cleaner;

/**
 * Abstract base class for all cleaners
 *
 * @version    2.0.0
 */
abstract class AbstractCleaner
{
    /**
     * Whether to use addslashes for additional security
     */
    protected bool $addSlashes = false;

    /**
     * Constructor
     *
     * @param bool $addSlashes Whether to use addslashes for additional security
     */
    public function __construct(bool $addSlashes = false)
    {
        $this->addSlashes = $addSlashes;
    }

    /**
     * Set whether to use addslashes
     *
     * @param bool $addSlashes Whether to use addslashes
     * @return self
     */
    public function setAddSlashes(bool $addSlashes): self
    {
        $this->addSlashes = $addSlashes;
        return $this;
    }

    /**
     * Get whether addslashes is enabled
     *
     * @return bool
     */
    public function getAddSlashes(): bool
    {
        return $this->addSlashes;
    }
}
