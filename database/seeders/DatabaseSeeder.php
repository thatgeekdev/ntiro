<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Job;
use App\Models\Employer;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(300)->create();
        $users = User::all()->shuffle(); //to shuffle orrandomize the users

        for ($i=0; $i <20 ; $i++) { 
            Employer::factory()->create([
                'user_id' => $users->pop()->id //will return one of the user of the collection and also remove it from the list
            ]);
        }

        $employers = Employer::all();

        for ($i=0; $i <20 ; $i++) { 
            Job::factory()->create([
                'employer_id' => $employers->random()->id //will return one of the user of the collection and also remove it from the list
            ]);
        }

        // Job::factory(10)->create();

        User::factory()->create([
            'name' => 'Jose Jaime',
            'email' => 'josejaimematsimbe@gmail.com',
        ]);

        foreach ($users as $user) {
            $jobs = \App\Models\Job::inRandomOrder()->take(rand(0, 4))->get();

            foreach ($jobs as $job) {
                \App\Models\JobApplication::factory()->create([
                    'job_id' => $job->id,
                    'user_id' => $user->id
                ]);
            }
        }
    }
}
