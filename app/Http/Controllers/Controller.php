<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="API untuk Tubes Pemrograman",
 *     version="1.0.0"
 * ),
 *  @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      in="header",
 *      name="Authorization",
 *      bearerFormat="Bearer {token}",
 *      description="Masukkan token"
 *  ),
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
