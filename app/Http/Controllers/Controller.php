<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      x={
 *          "logo": {
 *              "url": "https://via.placeholder.com/190x90.png?text=L5-Swagger"
 *          }
 *      },
 *      title="API Parkir App",
 *      description="Documentation Api Parkir",
 *      @OA\Contact(
 *          email="syaifuddin246@gmail.com"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 *     @OA\Server(
 *      url="http://localhost:8000/",
 *      description="End Point"
 * )
 *  @OA\SecurityScheme(
 *     type="apiKey",
 *     name="Authorization",
 *     in="header",
 *     scheme="https",
 *     securityScheme="Bearer",
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
