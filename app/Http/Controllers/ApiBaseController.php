<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
// use App\Helpers\RESTAPIHelper;
// use JWTAuth;
use App\Http\Traits\JWTUserTrait;

class ApiBaseController extends Controller {

	/**
	 * Extract token value from request
	 *
	 * @return string
	 */
	protected function extractToken($request=false) {
		return JWTUserTrait::extractToken($request);
	}

	/**
	 * Return User instance or false if not exist in DB
	 *
	 * @return mixed
	 */
	protected function getUserInstance($request=false) {
		return JWTUserTrait::getUserInstance($request);
	}

}