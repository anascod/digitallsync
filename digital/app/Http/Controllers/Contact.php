<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mode_contact;  // Import the mode_contac model

class Contact extends Controller
{
    public function Insertq(Request $request)
{
    $user = new mode_contact;
    $user->username = $request->input('username');
    $user->email = $request->input('email');
    $user->massage = $request->input('massage');
    // Add more attributes as needed

    // Save the model to the database
    $user->save();

}
}
