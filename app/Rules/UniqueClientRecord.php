<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueClientRecord implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $table;
    protected $param1;
    protected $param2;
    protected $param3;
    protected $param4;
    protected $message;

    public function __construct($table, $param1 = null, $param2 = null, $param3 = null, $param4 = null, $message = null)
    {
        /**
         * @table string  - table name
         * @param string  1-4 (param4 is the id of the table) - table column
         */
        $this->table = $table;
        $this->param1 = $param1;
        $this->param2 = $param2;
        $this->param3 = $param3;
        $this->param4 = $param4;
        $this->message = $message;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     * $attribute is the name of field
     */
    public function passes($attribute, $value)
    {
        $param1 = $this->param1;
        $param2 = $this->param2;
        $param3 = $this->param3;
        $param4 = $this->param4;

        $count = DB::table($this->table)
        ->when($param1, function($query) use ($param1) {
            $query->where($param1,app()->request->input($param1));
        })
        ->when($param2, function($query) use ($param2){
            $query->where($param2,app()->request->input($param2));
        })
        ->when($param3, function($query) use ($param3){
            $query->where($param3,app()->request->input($param3));
        })
        ->when($param4, function($query) use ($param4){
            $query->where('id', $param4);
        })
        ->where($attribute, $value)->first();
        //dd($param4);
        return (count($count) == 0 AND $param4 == null) ? true : (count($count) >= 0 AND $param4 != NULL) ? true : false ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message ? $this->message : 'Record date is already exists for this user and company';
    }
}
