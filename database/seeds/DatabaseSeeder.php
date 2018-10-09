<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminTableSeeder::class);
        $this->call(AgentTableSeeder::class);
        $this->call(StudentTableSeeder::class);
        $this->call(MbtiPrimaryIusseTableSeeder::class);
        $this->call(MbtiSeniorIusseTableSeeder::class);
        $this->call(MbtiCategoryTableSeeder::class);
        $this->call(CollegelevelTableSeeder::class);
        $this->call(CollegeCategoryTableSeeder::class);
        $this->call(ProvinceControlScoreTableSeeder::class);
        $this->call(ProfessionalCategoryTableSeeder::class);
        $this->call(ProfessionalTableSeeder::class);
        $this->call(ProfessionalDetailTableSeeder::class);
        $this->call(CollegeTableSeeder::class);
        $this->call(CollegeDetailsTableSeeder::class);
    }
}
