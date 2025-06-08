<?php

declare(strict_types=1);

namespace Eyeskiller\XssRemove\Cleaner;

/**
 * Array cleaner for removing XSS and SQLi from arrays.
 *
 * @version    2.0.0
 */
class ArrayCleaner extends AbstractCleaner
{
    /**
     * @var StringCleaner
     */
    private StringCleaner $stringCleaner;

    /**
     * Constructor
     *
     * @param bool $addSlashes Whether to use addslashes for additional security
     */
    public function __construct(bool $addSlashes = false)
    {
        parent::__construct($addSlashes);
        $this->stringCleaner = new StringCleaner($addSlashes);
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
     * Cleans a multi-dimensional array of data.
     *
     * @param array $data Array to escape
     * @return array Clean array
     */
    public function clean(array $data): array
    {
        $result = [];

        // Process array recursively
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $result[$key] = $this->clean($value);
            } else {
                $result[$key] = $this->stringCleaner->clean((string)$value);
            }
        }

        return $result;
    }
}
