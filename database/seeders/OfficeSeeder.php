<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Office;
use Illuminate\Support\Facades\DB;

class OfficeSeeder extends Seeder
{
    public function run(): void
    {
        // Clear table first
        DB::statement('SET CONSTRAINTS ALL DEFERRED;');
        Office::truncate();
        DB::statement('SET CONSTRAINTS ALL IMMEDIATE;');

        $offices = [
            [
                'office_name' => 'Office of the City Mayor (CMO)',
                'logo' => 'logos/OCM LOGO.png'
            ],
            [
                'office_name' => 'Office of the City Mayor-Library Services (CMO-LS)',
                'logo' => null
            ],
            [
                'office_name' => 'Office of the City Mayor-Ligao Community College (CMO-LCC)',
                'logo' => null
            ],
            [
                'office_name' => 'City General Services Office (CGSO)',
                'logo' => null
            ],
            [
                'office_name' => 'Office of the City Local Civil Registrar (CLCR)',
                'logo' => 'logos/CLCR LOGO.png'
            ],
            [
                'office_name' => 'City Treasurer\'s Office (CTO)',
                'logo' => null
            ],
            [
                'office_name' => 'Office of the City Treasurer\'s Office-Operation Economic Enterprise (CTO-OEE)',
                'logo' => null
            ],
            [
                'office_name' => 'City Assessor\'s Office (CAO)',
                'logo' => 'logos/CAO LOGO.png'
            ],
            [
                'office_name' => 'Business Processing Licensing Office (BPLO)',
                'logo' => null
            ],
            [
                'office_name' => 'City Environment and Natural Resources Office (CENRO)',
                'logo' => null
            ],
            [
                'office_name' => 'City Engineering\'s Office (CEO)',
                'logo' => null
            ],
            [
                'office_name' => 'City Cooperative and Development Office (CCDO)',
                'logo' => null
            ],
            [
                'office_name' => 'City Legal Office (CLO)',
                'logo' => null
            ],
            [
                'office_name' => 'Admin Office (AO)',
                'logo' => null
            ],
            [
                'office_name' => 'City Health Office (CHO)',
                'logo' => 'logos/CHO LOGO.png'
            ],
            [
                'office_name' => 'Office of the City Agriculturist (OCA)',
                'logo' => null
            ],
            [
                'office_name' => 'Office of the City Veterinarian (OCV)',
                'logo' => null
            ],
            [
                'office_name' => 'Office of the City Social Welfare and Development Officer (CSWDO)',
                'logo' => 'logos/CSWDO LOGO.png'
            ],
            [
                'office_name' => 'Public Employment Service Office (PESO)',
                'logo' => null
            ],
            [
                'office_name' => 'Office of the City Planning Coordinator (CPC)',
                'logo' => null
            ],
            [
                'office_name' => 'Office of the City Disaster Risk Reduction Management Officer (CDRRMO)',
                'logo' => null
            ],
            [
                'office_name' => 'Office of the City Human Resource Management Officer (CHRMO)',
                'logo' => null
            ],
            [
                'office_name' => 'City Accounting Office (CAO)',
                'logo' => null
            ],
            [
                'office_name' => 'City Budget Office (CBO)',
                'logo' => null
            ],
        ];

        foreach ($offices as $office) {
            Office::create($office);
        }

        $this->command->info('Offices seeded successfully!');
    }
}