<?php

namespace App\Http\Middleware;

use App\Models\ManagementAccess\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AuthGates
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // get all user by session browser
        // $user = \Auth::user()
        $user = Auth::user();

        //jika tidak ada yang sedang login, maka fungsi validation di bawah tidak akan jalan

        // checking validation middleware
        // system on or not
        // user active or not
        //then do the action
        if (!app()->runningInConsole() && $user) {
            //ngambil data role yang memiliki permission
            $roles              = Role::with('permission')->get();
            $permissionsArray   = [];

            // nested loop
            // looping for role ( where table role )
            foreach ($roles as $role) {
                // looping for permission ( where table permnission_role )
                foreach ($role->permission as $permissions) {
                    $permissionsArray[$permissions->title][] = $role->id;
                }
            }

            // check user role
            foreach ($permissionsArray as $title => $roles) {
                Gate::define($title, function (\App\Models\User $user)
                use ($roles) {
                    //array_intersect adalah 
                    return count(array_intersect($user->role->pluck('id')
                        ->toArray(), $roles)) > 0;
                });
            }
        }

        // return all middleware
        return $next($request);
    }
}
