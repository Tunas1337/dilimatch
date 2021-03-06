<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public static function getOwnUUID($email)
    {
        $user = User::where('email', $email)->firstOrFail();
        return $user->uuid;
    }
    public static function isEmailVerified($email)
    {
        $user = User::where('email', $email)->firstOrFail();
        return $user->email_verified_at;
    }
    public static function getName($id)
    {
        $user = User::where('uuid', $id)->firstOrFail();
        $userinfo = json_decode($user->info, true)[0];
        return $userinfo['name'];
    }
    public static function getChatID($uuid) {
        return User::where('uuid', $uuid)->firstOrFail()->id;
    }
    public static function handleChoice(Request $request, $id)
    {
        if (request('action') == 'yay') {
            //TODO: Add current user's UUID to the 'people who yayed' of $id
            $yayedUser = User::where('uuid', $id)->firstOrFail();
            $whoHasYayed = $yayedUser->whoHasYayed;
            #$whoHasYayed = substr($whoHasYayed, 0, -2) . ", \"" . $request->session()->get('uuid') . "\"}]";
            $whoHasYayed = $whoHasYayed . ',' . $request->session()->get('uuid');
            User::where('uuid', $id)->update(['whoHasYayed' => $whoHasYayed]);
            #return $whoHasYayed;

            // Now, check if $id has yayed the current user back
            $whoHasYayed_currentUser = explode(
                ',',
                User::where('uuid', $request->session()->get('uuid'))->firstOrFail()->whoHasYayed
            );
            if (in_array($id, $whoHasYayed_currentUser)) {
                //Update matches of logged in user
                $matches = User::where('uuid', $request->session()->get('uuid'))->firstOrFail()->matches;
                $matches = $matches . ',' . $id;
                User::where('uuid', $request->session()->get('uuid'))->update(['matches' => $matches]);
                //Update matches of liked user in the same way
                $matches = User::where('uuid', $id)->firstOrFail()->matches;
                $matches = $matches . ',' . $request->session()->get('uuid');
                User::where('uuid', $id)->update(['matches' => $matches]);
                vendor\Chatify\MessagesController::addMatch($request->session()->get('uuid'),$id);
                return ("MATCH!!! " . json_encode(['name' => json_decode($yayedUser->info, true)[0]['name']]));
            }
            #return($whoHasYayed_currentUser);
            #return;
        } else if (request('action') == 'nay') {
            //Add nayed user to "nayed" list
            $nayedUsers = User::where('uuid', $request->session()->get('uuid'))->firstOrFail()->nayedUsers;
            $nayedUsers = $nayedUsers . ',' . $id;
            User::where('uuid', $request->session()->get('uuid'))->update(['nayedUsers' => $nayedUsers]);
        }
    }
    public static function getUser(Request $request, $id, $returnName = false, $returnPrefGenders = false)
    {
        #dd(Auth::User());
        $users = User::get();
        if ($id == 'next') {
            $uuid = $request->session()->get('uuid');
            $userCount = $users->count();
            $randInt = rand(1, $userCount-1);
            #$nextUser = User::where('preferredGender', 'M')[$randInt];
            $nextUser = User::get()[$randInt];
            #    dd($nextUser);
            #return User::where('uuid', $nextUser->uuid)->first()->whoHasYayed;
            if ($nextUser->uuid == $uuid or UserController::isEmailVerified($nextUser->email) == null) {
                #return redirect('/users/next');
                return 'no more users';
            }
            $ownGender = User::where('uuid', $uuid)->first()->gender;
            $ownpreferredGenders = str_split(User::where('uuid', $uuid)->first()->preferredGender);
            $gender = User::where('uuid', $nextUser->uuid)->first()->gender;
            $preferredGenders = str_split(User::where('uuid', $nextUser->uuid)->first()->preferredGender);
            $whoHasYayed = User::where('uuid', $nextUser->uuid)->first()->whoHasYayed;
            $matchesArray = explode(',', $whoHasYayed);
            $nayedUsers = User::where('uuid', $uuid)->first()->nayedUsers;
            $nayedUsers_array = explode(',', $nayedUsers);
            #dd($nayedUsers_array);
            #return($matchesArray);
            #$alreadySeen = (in_array($uuid, $matchesArray) and in_array($uuid, $nayedUsers_array));
            if (!in_array($uuid, $matchesArray) and !in_array($nextUser->uuid, $nayedUsers_array) and in_array($ownGender, $preferredGenders) and in_array($gender, $ownpreferredGenders))
                return redirect('/users/' . $nextUser->uuid);
            else
                return 'no more users';
        } else {
            $user = User::where('uuid', $id)->firstOrFail();
            $userinfo = json_decode($user->info, true)[0];
            $name = $returnName ? $userinfo['name'] : 'nuh-uh, not telling you';
            return
                [
                    'bio' => $userinfo['bio'],
                    'interests' => $userinfo['interests'],
                    'preference' => $userinfo['preference'],
                    'uuid' => $id,
                    'gender' => $user->gender,
                    'preferredGenders' => $returnPrefGenders ? str_split($user->preferredGender) : 'NOPE',
                    'name' => $returnName ? $name : 'nuh-uh, not telling you'
                ];
        }
    }
    public static function updateUser(Request $request, $id)
    {
        $name = UserController::getName($id);
        $preferredGendersArray = [request('preferredGender_male'), request('preferredGender_female'), request('preferredGender_other')];
        $own_gender = request('gender');
        $genders_str = '';
        foreach ($preferredGendersArray as $gender) {
            if ($gender != null) $genders_str = $genders_str . $gender;
        }
        if($genders_str == '') return redirect(route("profile",[
            'fail' => true
        ]));
        $newInfo = '[{"bio":"' . request('bio') . '","name":"' . $name . '","interests":"' . request('interests') . '","preference":"' . request('preference') . '"}]';
        User::where('uuid', $id)->update([
            'info' => $newInfo,
            'preferredGender' => $genders_str,
            'gender' => $own_gender
        ]);
    }
}
