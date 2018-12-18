<?php

namespace App;

use App\Traits\FormattedDates;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use FormattedDates;

    protected $guarded = [];

    public function map()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'color' => $this->color,
            'created_at' => $this->created_at,
            'created_at_formatted' => $this->created_at_formatted,
            'created_at_human' => $this->created_at_human,
            'created_at_timestamp' => $this->created_at_timestamp,
            'updated_at' => $this->updated_at,
            'updated_at_formatted' => $this->updated_at_formatted,
            'updated_at_human' => $this->updated_at_human,
            'updated_at_timestamp' => $this->updated_at_timestamp,
            'full_search' => $this->full_search
        ];
    }

    public function getFullSearchAttribute()
    {
        return "$this->id $this->name $this->color $this->description";
    }
}
