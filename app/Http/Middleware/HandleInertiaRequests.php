<?php

namespace App\Http\Middleware;

use App\Models\Axle;
use App\Models\Certificate;
use App\Models\TypeSituation;
use App\Models\User;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        if (isset(auth()->user()->id)) {
            $user = User::with('roles')->find(auth()->user()->id);
            $isStudent = $user->hasRole('student');
        } else {
            $user = null;
            $isStudent = false;
        }

        if ($isStudent) {
            $axleWithCount = Axle::all();
            $axleWithCount->map(function ($item, $key) use ($user) {
                $item->total_validated_minutes =  (int) $item->certificates()
                    ->where('user_id', $user->id)
                    ->sum('validated_hours_in_minutes');
                return $item;
            });
        } else {
            $axleWithCount = [];
        }

        return array_merge(parent::share($request), [
            'hasHole' => [
                'admin' => isset($user) ? $user->hasRole('admin') : false,
                'validator' => isset($user) ? $user->hasRole('validator') : false,
                'student' => isset($user) ? $user->hasRole('student') : false,
            ],

            'flash' => [
                'success' => fn () => $request->session()->get('success')
            ],

            'axleWithCount' => $axleWithCount,
        ]);
    }
}
