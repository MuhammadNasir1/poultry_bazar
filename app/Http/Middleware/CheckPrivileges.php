<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CheckPrivileges
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = session('user_details');
        // Check if user role is superadmin, bypass privileges check if true
        if ($user['user_role'] == 'superadmin') {
            return $next($request);  // Allow full access
        }

        // Access decoded privileges directly
        $privileges = json_decode($user['user_privileges'], true)['permissions'] ?? [];

        $routeToPrivilege = [
            'media/blogs' => 'Blogs',
            'media/diseases' => 'Diseases',
            'media/consultancy' => 'Consultancy',
            'Cities' => 'City',
            'modules' => 'Modules',
            'operators' => 'Operators',
            'subscription' => 'Subscription',
            'queries' => 'Queries',
            'markets' => 'Markets',
            'marketupdates' => 'MarketsUpdates',
            'media' => 'Media',
            'categories' => 'Categories',
            'setting' => 'Setting',
            'notification' => 'Notification',
        ];

        // Get the requested route name
        $currentRoute = $request->path();
        foreach ($routeToPrivilege as $route => $privilegeName) {
            // Convert the route to a regular expression pattern, escaping slashes and adding delimiters
            $routePattern = '/^' . str_replace('/', '\/', $route) . '($|\/)/';
            // Check if the current route matches the pattern
            if (preg_match($routePattern, $currentRoute)) {
                $permission = $privileges[$privilegeName]['view'] ?? null;
                // dd($privileges[$privilegeName]['view']);

                if ($permission !== "on") {
                    return redirect()->back();
                }

                break; // Exit the loop if a match is found
            }
        }
        return $next($request);
    }
}
