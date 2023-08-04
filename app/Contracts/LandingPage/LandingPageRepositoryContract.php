<?php

namespace App\Contracts\LandingPage;

use App\Models\LandingPage;

/**
 * Interface by landing page repository
 */
interface LandingPageRepositoryContract
{
    /**
     * Get last landing page
     *
     * @return LandingPage|null
     */
    public function getLast(): ?LandingPage;
}
