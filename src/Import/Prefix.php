<?php
/**
 * Spiral Framework.
 *
 * @license   MIT
 * @author    Anton Titov (Wolfy-J)
 */

namespace Spiral\Stempler\Import;

use Spiral\Stempler\ImportInterface;

/**
 * Namespace importer provides ability to include multiple elements using common namespace prefix.
 *
 * Example: namespace:folder/* => namespace:folder/name
 */
class Prefix implements ImportInterface
{
    /**
     * @var string
     */
    private $prefix = '';

    /**
     * @var string
     */
    private $target = '';

    /**
     * @param string $prefix
     * @param string $target
     */
    public function __construct(string $prefix, string $target)
    {
        $this->prefix = $prefix;
        $this->target = $target;
    }

    /**
     * {@inheritdoc}
     */
    public function importable(string $element, array $token): bool
    {
        $element = strtolower($element);

        return strpos($element, $this->prefix) === 0;
    }

    /**
     * {@inheritdoc}
     */
    public function resolvePath(string $element, array $token): ?string
    {
        $element = substr($element, strlen($this->prefix));

        return str_replace('*', str_replace('.', '/', $element), $this->target);
    }
}