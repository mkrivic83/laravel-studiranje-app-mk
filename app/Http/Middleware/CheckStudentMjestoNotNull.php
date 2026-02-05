<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStudentMjestoNotNull
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $student = $request->route('student');

        if ($student && $student->mjesto === null) {
            return response('Prikaz studenta nije dozvoljen jer mjesto stanovanja nije definirano.', 403);
        }
        return $next($request);
    }
}
