<?php

namespace App\Exceptions;

use Exception;

class CategoryNotFoundException extends Exception
{
    function report(){

    }

    function render(){
        return view('errors.404');
    }
}
