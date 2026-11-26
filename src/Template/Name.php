<?php declare(strict_types = 1);

/**
 * This file is part of the FireHub Project ecosystem
 *
 * @author Danijel Galić <danijel.galic@outlook.com>
 * @copyright 2026-present The FireHub Project - All rights reserved
 * @license https://opensource.org/license/Apache-2-0 Apache License, Version 2.0
 *
 * @php-version >=8.5
 * @package View
 */

namespace FireHub\View\Template;

use FireHub\Core\Type\ValueObject;
use FireHub\View\Template\Exception\InvalidTemplateNameException;
use FireHub\Runtime;

/**
 * ### Logical template name
 *
 * Represents an immutable, engine-independent identifier used to reference a template.
 *
 * A template name consists of one or more dot-separated segments. Each segment may contain ASCII letters, digits,
 * hyphens, and underscores.
 *
 * A logical template name does not represent a filesystem path, file extension, or template source.
 *
 * <code>
 * $name = new Name('users.profile.show');
 * </code>
 *
 * @since 1.0.0
 *
 * @extends \FireHub\Core\Type\ValueObject<non-empty-string>
 */
final readonly class Name extends ValueObject{

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @uses \FireHub\Core\Type\ValueObject::guard() To enforce the invariant that a template name cannot be empty.
     * @uses \FireHub\Runtime\Str\SB\Regex::match() To validate the template name.
     *
     * @param non-empty-string $value <p>
     * Logical template name.
     * </p>
     *
     * @throws \FireHub\View\Template\Exception\InvalidTemplateNameException If the template name is invalid.
     * @throws \FireHub\Core\Exception\FireHubException If the condition is not met.
     * @throws \FireHub\Core\Type\Exception\ValueObjectException If the exception is not a FireHubException.
     *
     * @return void
     */
    public function __construct (
        private string $value
    ) {

        $this->guard(
            fn():bool => Runtime\Str\SB\Regex::match(
                '/\A[A-Za-z0-9_-]+(?:\.[A-Za-z0-9_-]+)*\z/',
                $value
            ),
            fn() => new InvalidTemplateNameException
        );

    }

    /**
     * ### Gets the template name segments
     *
     * <code>
     * $name = new Name('users.profile.show');
     *
     * $name->segments(); // ['users', 'profile', 'show']
     * </code>
     *
     * @since 1.0.0
     *
     * @uses \FireHub\Runtime\Str\SB\Delimiter::explode() To split the template name into segments.
     *
     * @return non-empty-list<non-empty-string> Template name segments.
     */
    public function segments ():array {

        /** @var non-empty-list<non-empty-string> */
        return Runtime\Str\SB\Delimiter::explode($this->value, '.');

    }

    /**
     * {@inheritDoc}
     *
     * <code>
     * $name = new Name('users.show');
     *
     * $name->value(); // 'users.show'
     * </code>
     *
     * @since 1.0.0
     */
    public function value ():string {

        return $this->value;

    }

}