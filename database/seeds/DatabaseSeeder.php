<?php

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
        $this->call([StateSeeder::class,
            RoleSeeder::class,
            ClientSeeder::class,
            UserSeeder::class,
            TicketSeeder::class,
            CommentSeeder::class,

        ]);
    }
}
