<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check()) {
            
            /** @var \App\Models\User $user */
           
            $user = Auth::user();

            if ($user->isAdmin()) {
                return $next($request);
            }
        }

       
        return redirect('/')->with('error', 'Bạn không có quyền truy cập trang quản trị.');
    }
}