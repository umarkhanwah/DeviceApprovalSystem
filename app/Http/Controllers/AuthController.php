<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;

class AuthController extends Controller
{
    function register(Request $request){
        $request->validate([
            'name'=>'required| string',
            'email'=> 'required | email | unique:users,email',
            'password'=> 'required | string',
        ]);

        try {
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>  bcrypt( $request->password),
            ]);
            
            return response()->json(['message'=> "User Created ", $user] , 200);
        } catch (\Exception $e) {
            return response()->json(['message'=> "Error  ".$e->getMessage()] , 401);
            
        }       
    }





public function login(Request $request) {
    // 1. Validation
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // 2. Auth Attempt
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $deviceId = $request->device_id; // Jo JS se aa rahi hai

        // Agent library se device ki info nikalna
        $agent = new Agent();
        $deviceName = $agent->browser() . ' on ' . $agent->platform(); 

        // 3. Database mein check karein
        $device = Device::where('user_id', $user->id)
                        ->where('device_id', $deviceId)
                        ->first();

        // 4. Agar device nahi milti ya approved nahi hai
        if (!$device || $device->is_approved == false) {
            
            // Agar pehle se record nahi hai, to save kar lein (taake admin ko dikh sake)
            if (!$device) {
                Device::create([
                    'user_id' => $user->id,
                    'device_id' => $deviceId,
                    'device_name' => $deviceName,
                    'is_approved' => false
                ]);
            }

            // FORAN LOGOUT (Ye aapki main requirement thi)
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('error', 'Apki device approved nahi hai. Admin se rabta karein.');
        }

        // 5. Agar sab theek hai aur device approved hai
        return redirect()->intended('/dashboard')
               ->withCookie(cookie('device_id', $deviceId, 60*24*30));
    }

    return back()->withErrors(['email' => 'Ghalat credentials!']);
}
}




