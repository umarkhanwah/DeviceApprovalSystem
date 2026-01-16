<?php

namespace App\Http\Middleware;

use App\Models\Device;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceApproval
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            $user = Auth::user();

            $device_id = $request->cookie("device_id") ;


            $isApproved = Device::where('user_id' , $user->id)
            ->where('device_id' , $device_id)->where('is_approved', true)->exist();

            if (!$isApproved) {
                Auth::logout(); 
                return redirect()->route('login')->with('error', 'Unauthorized device!');
            }
            return $next($request);

        }
        
    }
}
