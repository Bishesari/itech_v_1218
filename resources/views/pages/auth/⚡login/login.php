<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts::auth')]
class Login extends Component
{
    public string $user_name = '';

    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $key = Str::lower($this->user_name ?: 'guest').'|'.request()->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $this->addError('user_name', 'تلاش‌های ناموفق زیاد! یک دقیقه دیگر تلاش کنید.');

            return;
        }

        if (! Auth::attempt([
            'user_name' => $this->user_name,
            'password' => $this->password,
            'is_active' => true,
        ], $this->remember)) {
            RateLimiter::hit($key);
            $this->addError('password', 'نام کاربری یا رمز عبور اشتباه است.');

            return;
        }

        session()->regenerate();
        RateLimiter::clear($key);

        $user = Auth::user();
        $assignments = $user->assignments()->where('is_active', true)->get();

        if ($assignments->isEmpty()) {
            Auth::logout();
            $this->addError('user_name', 'برای این کاربر هیچ نقشی تعریف نشده است.');

            return;
        }

        if ($assignments->count() === 1) {
            $this->activateAssignment($assignments->first());
            $this->redirectIntended('dashboard', navigate: true);

            return;
        }

        $last = $assignments->firstWhere('is_last_selected', true);

        if ($last) {
            $this->activateAssignment($last);
            $this->redirectIntended('dashboard', navigate: true);

            return;
        }

        $this->redirectRoute('role.select', navigate: true);
    }

    protected function activateAssignment($assignment): void
    {
        DB::transaction(function () use ($assignment) {

            $user = auth()->user();

            $user->assignments()->update(['is_last_selected' => false]);
            $assignment->update(['is_last_selected' => true]);

            session(['active_assignment_id' => $assignment->id]);
        });
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
