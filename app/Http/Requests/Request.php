<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class Request extends FormRequest
{

	/**
	 * Override FormRequest to response API errors in proper way
	 *
	 * @param  array  $errors
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function response(array $errors)
	{

	    if(stripos(request()->getRequestUri(), '/api') === 0)
			return new JsonResponse(['message' => current($errors)[0]], 422);
		else
			return new JsonResponse(['error' => current($errors)[0]], 422);

	}
}
