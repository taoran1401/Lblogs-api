<?php

namespace App\Http\Middleware;

use App\Logic\Common\TokenLogic;
use Carbon\Carbon;
use Firebase\JWT\JWT;
use Taoran\Laravel\Exception\ApiException;
use Closure;

class AdminAuth
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
        $data = TokenLogic::get(request()->input('token'));
        if (empty($data['admin_id'])) {
            throw new ApiException('你还没有登录或登录已过期', 'NO LOGIN');
        }
        return $next($request);
    }
}
