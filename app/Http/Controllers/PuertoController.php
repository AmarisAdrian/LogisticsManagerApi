<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Puerto;

class PuertoController extends Controller
{
    public function getPuertos(){
        return Puerto::get();
    }
}