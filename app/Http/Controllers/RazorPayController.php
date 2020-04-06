<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RazorPayController extends Controller
{
    public function dopayment(Request $request) {
        //Input items of form
        $input = $request->all();

        // Please check browser console.
        print_r($input);
        exit;
    }
}
