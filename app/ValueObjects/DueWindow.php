<?php

namespace App\ValueObjects;
/**
 * Value object representing a due window with start and end dates.
 * @package App\ValueObjects
 * @property string|null $start
 * @property string|null $end
 * @method bool isOver() Checks if the due window has passed.
 * @method array jsonSerialize() Serializes the object to an array for JSON representation.
 */
class DueWindow
{
    public function __construct(public ?string $start = null, public ?string $end = null)
    { }

    public function jsonSerialize(): array
    {
        return [
            'start' => $this->start,
            'end' => $this->end,
        ];
    }

    public function isOver(): bool
    {
      return $this->end && now()->greaterThan(new \DateTime($this->end));
    }
}
