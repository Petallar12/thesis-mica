<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimezoneController extends Controller
{
public function showTimezone()
{
    return response()->json([
        'timezone' => date_default_timezone_get(), // Return the current PHP timezone
    ]);
}}
