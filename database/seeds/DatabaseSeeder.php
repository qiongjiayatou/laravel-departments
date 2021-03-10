<?php

use App\Section;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            SectionsTableSeeder::class,
        ]);

        $users = User::all();

        Section::all()->each(function($section) use ($users) {
            $section->users()->attach(
                $users->where('id', '!=', 1)->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

    }
}
