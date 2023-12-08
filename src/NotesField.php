<?php

namespace OptimistDigital\NovaNotesField;

use Nette\Utils\Callback;
use Laravel\Nova\Fields\Field;

class NotesField extends Field
{
    public $component = 'nova-notes-field';

    /**
     * NovaNotesField constructor.
     *
     * @param $name
     * @param null $attribute
     * @param callable|null $resolveCallback
     */
    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->withMeta([
            'placeholder' => null,
            'addingNotesEnabled' => true,
            'fullWidth' => config('nova-notes-field.full_width_inputs', false),
        ]);
    }

    /**
     * Resolve the given attribute from the given resource.
     *
     * @param  mixed  $resource
     * @param  string  $attribute
     * @return mixed
     */
    protected function resolveAttribute($resource, $attribute)
    {
        return $resource->$attribute()->latest()->first();
    }

    /**
     * Sets the placeholder value displayed on the field.
     *
     * @param string $placeholder
     * @return NotesField
     **/
    public function placeholder($placeholder)
    {
        return $this->withMeta(['placeholder' => $placeholder]);
    }

    /**
     * Show or hide the AddNote input.
     *
     * @param bool $addingNotesEnabled
     * @return NotesField
     */
    public function addingNotesEnabled($addingNotesEnabled = true)
    {
        return $this->withMeta(['addingNotesEnabled' => $addingNotesEnabled]);
    }

    /**
     * Show or hide the AddNote input.
     *
     * @param boolean $fullWidth
     * @return NotesField
     **/
    public function fullWidth($fullWidth = true)
    {
        return $this->withMeta(['fullWidth' => $fullWidth]);
    }

    public function anonymize($callback)
    {
        return $this->withMeta(['anonymize' => $callback()]);
    }

    public function suggestions($suggestions)
    {
        return $this->withMeta(['suggestions' => $suggestions]);
    }
}
