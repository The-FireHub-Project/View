<?php declare(strict_types = 1);

/**
 * This file is part of the FireHub Project ecosystem
 *
 * @author Danijel Galić <danijel.galic@outlook.com>
 * @copyright 2026-present The FireHub Project - All rights reserved
 * @license https://opensource.org/license/Apache-2-0 Apache License, Version 2.0
 *
 * @php-version >=8.2
 * @package View
 */

namespace FireHub\View;

use FireHub\View\Template\Name;

/**
 * ### Represents a view
 *
 * Encapsulates a logical template name and the presentation data associated with it.
 *
 * A view describes content to be rendered without performing template resolution, rendering, or output emission.
 *
 * <code>
 * $view = new View(
 *     new Name('users.show'),
 *     ['name' => 'John']
 * );
 * </code>
 *
 * @since 1.0.0
 *
 * @template TData of array<non-empty-string, mixed>|object
 */
final readonly class View {

    /**
     * ### Constructor
     * @since 1.0.0
     *
     * @param \FireHub\View\Template\Name $template <p>
     * Logical template name.
     * </p>
     * @param TData $data <p>
     * Presentation data associated with the view.
     * </p>
     */
    public function __construct (
        private Name $template,
        private array|object $data
    ) {}

    /**
     * ### Gets the logical template name
     *
     * <code>
     * $view = new View(new Name('home'), []);
     *
     * $view->template()->value(); // 'home'
     * </code>
     *
     * @since 1.0.0
     *
     * @return \FireHub\View\Template\Name Logical template name.
     */
    public function template ():Name {

        return $this->template;

    }

    /**
     * ### Gets the presentation data
     *
     * <code>
     * $view = new View(
     *     new Name('users.show'),
     *     ['name' => 'John']
     * );
     *
     * $view->data(); // ['name' => 'John']
     * </code>
     *
     * @since 1.0.0
     *
     * @return TData Presentation data associated with the view.
     */
    public function data ():array|object {

        return $this->data;

    }

}