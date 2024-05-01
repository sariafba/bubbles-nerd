<?php

namespace App\Http\Middleware\MyMiddlewares;

use App\Traits\ResponseTrait;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsTeacher
{
    use ResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        dd(auth('api')->payload()->get('user_type') === 'teacher');

        if(auth('api')->payload()->get('user_type') === 'teacher')
            return $next($request);

        return $this->failed('access only for teachers', 422);
    }
}
