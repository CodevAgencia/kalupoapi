<?php

namespace Database\Seeders;

use App\Models\LandingPage;
use App\Models\LandingPageCard;
use App\Models\LandingPageService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class LandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $landingPage = LandingPage::factory()->create($this->dataLandingPage()->toArray());

        LandingPageService::factory()->create(['title' => 'COMPRAS', 'landing_page_id' => $landingPage->id]);
        LandingPageService::factory()->create(['title' => 'SERVICIOS', 'landing_page_id' => $landingPage->id]);

        LandingPageCard::factory(5)->create(['landing_page_id' => $landingPage->id]);
    }

    public function dataLandingPage(): Collection
    {
        return collect(
            [
                'title_banner_one' => 'hoy gatos y perros',
                'title_banner_two' => 'en super descuento',
                'title_one' => 'Todo lo que necesitas para tu mascota',
                'title_two' => 'Pedidos programados',
                'title_three' => 'Tus peludos nos prefieren',
            ]
        );
    }
}
