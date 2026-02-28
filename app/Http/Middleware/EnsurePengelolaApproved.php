<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsurePengelolaApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if ($user->role !== 'pengelola') {
            abort(403);
        }

        if (!$user->is_approved) {
            return redirect()
                ->route('dashboard')
                ->with('warning', 'Akun pengelola Anda masih menunggu persetujuan admin.');
        }

        return $next($request);
    }
}
