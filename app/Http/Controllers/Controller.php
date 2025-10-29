<?php

namespace App\Http\Controllers;

// PASTIKAN SEMUA 'use' STATEMENT INI ADA
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController; // <-- Paling Penting

// PASTIKAN ANDA ME-EXTEND 'BaseController'
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}