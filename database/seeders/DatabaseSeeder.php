<?php

    namespace Database\Seeders;

    use App\Models\Article;
    use App\Models\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         */
        public function run(): void
        {
            // User::factory(10)->create();

            $user = User::factory()->create([
                'name' => 'JuanJota',
                'email' => 'esnola@gmail.com',
                'password' => Hash::make('123456'),
                'is_admin' => 1,
            ]);

            Article::factory(14)
                ->recycle($user)
                ->create();

            Article::factory(15)->create();
        }
    }
