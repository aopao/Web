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
        $this->call(HollandMajorTableSeeder::class);
        $this->call(HollandDimensionsTableSeeder::class);
        $this->call(HollandProfessionalCodesTableSeeder::class);
        $this->call(ProvinceControlScoreTableSeeder::class);
        $this->call(MajorTableSeeder::class);
        $this->call(MajorSubjectTableSeeder::class);
        $this->call(MajorBachelorJuniorTableSeeder::class);
        $this->call(MajorDetailTableSeeder::class);
        $this->call(CollegeDiplomasTableSeeder::class);
        $this->call(CollegeCategoryTableSeeder::class);
        $this->call(CollegeTableSeeder::class);
        $this->call(CollegeDetailsTableSeeder::class);
    }
}
