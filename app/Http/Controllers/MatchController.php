<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\UserController;

class MatchController extends Controller
{
    function populateMatches(Request $request) {
        //get user uuid
        //get matches for that UUID
        //make a nice little array
        //send that off to the view
        $matches = User::where('uuid',$request->session()->get('uuid'))->firstOrFail()->matches;
        if($matches == "null") {
            return(view('matches', ['matches' => "none"]));
        }
        else {
            $matches_array = explode(',',$matches);
            array_shift($matches_array);
            #dd($whoHasYayed_array);
            foreach($matches_array as $match_uuid) {
                $match = UserController::getUser($request, $match_uuid, true);
                $display_array[] = $match;
            }
            return(view('matches', ['matches' => $display_array]));
        }
    }
}
