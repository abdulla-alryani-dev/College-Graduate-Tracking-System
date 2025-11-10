<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\TechnicalTool;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfferRequiredToolsSeeder extends Seeder
{
    public function run()
    {
        DB::table('offer_required_tools')->truncate();

        // Static attachment data for 5 offers and 5 tools
        $attachments = [
            // Offer 1 (Laravel Developer) - requires tools 1,2,3
            1 => [
                1 => ['proficiency_level' => 'expert', 'is_mandatory' => true],   // PHP
                2 => ['proficiency_level' => 'expert', 'is_mandatory' => true],   // Laravel
                3 => ['proficiency_level' => 'advanced', 'is_mandatory' => true]  // MySQL
            ],
            // Offer 2 (Frontend Developer) - requires tools 4,5
            2 => [
                4 => ['proficiency_level' => 'expert', 'is_mandatory' => true],  // JavaScript
                5 => ['proficiency_level' => 'advanced', 'is_mandatory' => true] // React
            ],
            // Offer 3 (Full Stack) - requires tools 1,4,5
            3 => [
                1 => ['proficiency_level' => 'advanced', 'is_mandatory' => true],
                4 => ['proficiency_level' => 'intermediate', 'is_mandatory' => true],
                5 => ['proficiency_level' => 'basic', 'is_mandatory' => false]
            ],
            // Offer 4 (DevOps) - requires tools 2,3
            4 => [
                2 => ['proficiency_level' => 'intermediate', 'is_mandatory' => false],
                3 => ['proficiency_level' => 'basic', 'is_mandatory' => true]
            ],
            // Offer 5 (Junior Developer) - requires tool 5
            5 => [
                5 => ['proficiency_level' => 'basic', 'is_mandatory' => false]
            ]
        ];

        foreach ($attachments as $offerId => $tools) {
            $offer = Offer::find($offerId);

            if ($offer) {
                $offer->requiredTools()->attach($tools);
                $this->command->info("Attached tools to Offer ID {$offerId}");
            } else {
                $this->command->error("Offer ID {$offerId} not found!");
            }
        }
    }
}
