<?php

namespace App\Http\Middleware;

use App\Models\Master\User\Detail;
use App\Models\Master\User\User;
use App\Supports\Notification\ToastSupport;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserDetailComplete
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var User $user */
        $user = auth()->user();
        /** @var Detail $detail */
        $detail = $user->detail;

        // check if user detail complete
        try {
            Validator::make($detail->toArray(), [
                'university_id' => ['required', 'filled'],
                'student_id' => ['required', 'filled'],
                'faculty_id' => ['required', 'filled'],
                'study_program_id' => ['required', 'filled'],
                'phone' => ['required', 'filled'],
            ])->validate();
        } catch (ValidationException $e) {
            ToastSupport::add("Lengkapi data sebelum melanjutkan transaksi");
            if (Route::currentRouteName() !== 'profile') {
                return redirect(route('profile'));
            }
        }

        return $next($request);
    }
}
