<?php

namespace App\Traits;

use Validator;
use Illuminate\Http\Request;

trait ValidateTrait
{
    /**
     * Generic validation method.
     * @return boolean
     */
    public function validate(Request $request, array $rules)
    {
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return false;
        }

        return true;
    }
}
