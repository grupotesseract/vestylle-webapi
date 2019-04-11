<?php

namespace App\Http\Middleware;

use Closure;
use InfyOm\Generator\Utils\ResponseUtil;
use Response;
use Auth;

class ChecaPessoaId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Se a pessoa autenticada nao for a mesma do ID da rota, retornar false
        if ($request->id != Auth::user()->id) {
            return Response::json(ResponseUtil::makeError(['Pessoa autenticada diferente do ID da rota']), 403);
        }

        return $next($request);
    }
}

