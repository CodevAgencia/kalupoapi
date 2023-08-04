<?php

namespace App\Http\Controllers;

use App\Contracts\LandingPage\LandingPageRepositoryContract;
use Illuminate\Http\JsonResponse;

class LandingPageController extends Controller
{

    /**
     * @param LandingPageRepositoryContract $landingPageRepositoryContract
     */
    public function __construct(protected LandingPageRepositoryContract $landingPageRepositoryContract)
    {
    }

    /**
     * Handle the incoming request.
     *
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $landingPage = $this->landingPageRepositoryContract->getLast();
        return response()->json($landingPage);
    }
}
