<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ExtendableModel extends \Illuminate\Database\Eloquent\Model
{
    private $_model;

    public function __construct(array $attributes = [])
    {
        // model name in singular form, lowercase
        $this->_model = strtolower(class_basename($this));
        parent::__construct($attributes);
    }

    /**
     * OVERRIDE of Dynamically retrieve attributes on the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        // first, try built-in laravel behaviour
        if (array_key_exists($key, $this->attributes)) {
            return $this->getAttribute($key);
        } else {
            // look for our own custom fields
            $custom_column = DB::table('custom_columns')
                ->select('name', $key)
                ->where('model', '=', $this->_model)
                ->get();

            dd($custom_column);
            return "frietpan";
        }

    }


    public static function GetCustomFieldNames() {
        $all_custom_fields = DB::table('custom_columns')
            ->select('name')
            ->where('model', '=', strtolower(class_basename(get_called_class())))
            ->get();

        return $all_custom_fields;
    }
}
