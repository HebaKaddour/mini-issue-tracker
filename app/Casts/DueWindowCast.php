<?php

namespace App\Casts;

use App\ValueObjects\DueWindow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
/** */
/**
 * Casts the due_window attribute to and from a JSON string.
 * this custom cast handles the conversion between the DueWindow value object and its JSON representation in the database.
 * @package App\Casts
 *
 */
class DueWindowCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        $data = json_decode($value, true);
        return new DueWindow($data['start'] ?? null, $data['end'] ?? null);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed{
        if ($value instanceof DueWindow) {
            return json_encode($value->jsonSerialize());
        }
        return json_encode($value);
    }
}
