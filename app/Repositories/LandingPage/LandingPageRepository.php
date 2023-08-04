<?php

namespace App\Repositories\LandingPage;

use App\Contracts\LandingPage\LandingPageRepositoryContract;
use App\Models\LandingPage;

class LandingPageRepository implements LandingPageRepositoryContract
{

    /**
     * @param LandingPage $landingPageModel
     */
    public function __construct(protected LandingPage $landingPageModel)
    {
    }

    /**
     * Get last landing page
     *
     * @return LandingPage|null
     */
    public function getLast(): ?LandingPage
    {
        $landingPage = $this->landingPageModel->latest()->first();
        if (!$landingPage) {
            return null;
        }
        return $landingPage->load('landingPageServices', 'landingPageCards');
    }
}
