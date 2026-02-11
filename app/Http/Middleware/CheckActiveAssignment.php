<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckActiveAssignment
{
    public function handle(Request $request, Closure $next)
    {
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (! session()->has('active_assignment_id')) {

            $assignments = $user->assignments()->where('is_active', true)->get();

            if ($assignments->isEmpty()) {
                Auth::logout();

                return redirect()->route('login')
                    ->withErrors(['user_name' => 'برای این کاربر هیچ نقشی تعریف نشده است.']);
            }

            if ($assignments->count() === 1) {
                $this->activateAssignment($assignments->first());

                return $next($request);
            }

            $last = $assignments->firstWhere('is_last_selected', true);

            if ($last) {
                $this->activateAssignment($last);

                return $next($request);
            }

            return redirect()->route('role.select');
        }

        return $next($request);
    }

    protected function activateAssignment($assignment): void
    {
        $user = Auth::user();

        $user->assignments()->update(['is_last_selected' => false]);
        $assignment->update(['is_last_selected' => true]);
        session(['active_assignment_id' => $assignment->id]);
    }
}
