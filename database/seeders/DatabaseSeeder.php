<?php

    namespace Database\Seeders;

    use App\Models\Article;
    use App\Models\Role;
    use App\Models\User;
    use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Seed the application's database.
         */
        public function run(): void
        {
            // User::factory(10)->create();
            $adminRole = Role::create(['name' => 'admin']);
            $authorRole = Role::create(['name' => 'author']);
            $editorRole = Role::create(['name' => 'editor']);

            $adminUser = User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
            ]);

            $adminUser->roles()->attach($adminRole);

            $authorUser = User::factory()->create([
                'name' => 'Author',
                'email' => 'author@gmail.com',
            ]);

            $authorUser->roles()->attach($authorRole);

            $editorUser = User::factory()->create([
                'name' => 'Editor',
                'email' => 'editor@gmail.com',
            ]);

            $editorUser->roles()->attach($editorRole);

            $authorEditorUser = User::factory()->create([
                'name' => 'AuthorEditor',
                'email' => 'ae@example.com',
            ]);

            $authorEditorUser->roles()->attach($authorRole);
            $authorEditorUser->roles()->attach($editorRole);


            Article::factory(10)
                ->recycle($authorUser)
                ->create();

            Article::factory(10)
                ->recycle($authorEditorUser)
                ->create();
        }
    }
