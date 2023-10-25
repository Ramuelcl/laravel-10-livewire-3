<?php

namespace Database\Seeders;

use App\Models\User;
// use App\Models\backend\UserSetting;
// use App\Models\backend\Perfil;

// agregamos
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
// Spatie
// use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\PermissionRegistrar;
// use Spatie\Permission\Models\model_has_roles;
// use Spatie\Permission\Models\model_has_permissions;

class UserSeeder extends Seeder
{
    // The User model requires this trait
    use HasRoles;

    public function __construct()
    {
        $users = [
            'admin' => [
                'name' => 'Super Admin',
                'email' => 'admin@email.com',
                'profile_photo_path' => 'images/avatars/admin.png',
                'email_verified_at' => now(),
                // 'password' => Hash::make('0Admin'), //bcrypt('0Admin')
                'password' => '0Admin', //bcrypt('0Admin')
                'remember_token' => Str::random(10),
                // 'role' => 'Super-admin',
                'is_active' => true,
            ],
            'guest' => [
                'name' => 'guest',
                'email' => 'guest@email.com',
                'profile_photo_path' => 'images/avatars/guest.png',
                'email_verified_at' => now(),
                'password' => 'guest', //bcrypt('guest')
                'remember_token' => Str::random(10),
                // 'role' => 'guest',
                'is_active' => 1,
            ],
            'guest' => [
                'name' => 'ramuel',
                'email' => 'ramuelcl@gmail.com',
                'profile_photo_path' => 'images/avatars/admin.png',
                'email_verified_at' => now(),
                'password' => '1Ramuel', //bcrypt('guest')
                'remember_token' => Str::random(10),
                // 'role' => 'guest',
                'is_active' => 1,
            ],
        ];
        //
        // dd($users);
        //
        foreach ($users as $user) {
            $u = User::create($user);
            if ($user['name'] === 'Super Admin' || $user['email'] === 'ramuelcl@gmail.com') {
                // dump('creando ' . $user['name']);
                $u->assignRole([
                    'Super-Admin', 'admin'
                ]);

                // All current roles will be removed from the user and replaced by the array given
                // $user->syncRoles(['super-admin']);
                $theme = 'light';
                $language = 'es-ES';
            } else {
                // dump('creando ' . $user['name']);
                $u->assignRole('guest');

                $theme = 'dark';
                $language = 'fr-FR';
            }
            //guardar un registro de configuracion para el usuario
            \App\Models\backend\UserSetting::create([
                'user_id' => $u['id'],
                'theme' => $theme,
                'language' => $language,
            ]);
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = User::factory()
        //     // ->has(App\Models\backend\UserSetting::factory()->count(1), 'App\Models\backend\UserSetting')
        //     ->count(48)
        //     ->create();

        // factory(App\User::class, 25)->create()->each(function ($user) {
        //     $user->profile()->save(factory(App\UserProfile::class)->make());
        // });

        // $roles = Role::all()->pluck('name')->toArray();
        // User::factory(98)
        //     ->create()
        //     ->each(function ($user) use ($roles) {
        //         $user->assignRole(array_rand($roles, rand(1, 4)));

        //         App\Models\backend\UserSetting::factory()->create([
        //             'user_id' => $user->id,
        //         ]);
        //         // Perfil::factory()->create([
        //         //     'user_id' => $user->id,
        //         // ]);
        //     });

        $roles = ['admin', 'client', 'seller', 'JobTime'];

        User::factory(1)
            ->create(
                [
                    'name' => 'admin',
                    'email' => 'admin@mail.com',
                ]
            )
            ->each(function ($user) {
                $user->assignRole('admin');

                \App\Models\backend\UserSetting::factory()->create([
                    'user_id' => $user->id,
                ]);
                // Perfil::factory()->create([
                //     'user_id' => $user->id,
                // ]);
            });
        User::factory(1)
            ->create(
                [
                    'name' => 'cliente',
                    'email' => 'cliente@mail.com',
                ]
            )
            ->each(function ($user) {
                $user->assignRole('client');

                \App\Models\backend\UserSetting::factory()->create([
                    'user_id' => $user->id,
                ]);
                // Perfil::factory()->create([
                //     'user_id' => $user->id,
                // ]);
            });
        User::factory(1)
            ->create(
                [
                    'name' => 'job',
                    'email' => 'job@mail.com',
                ]
            )
            ->each(function ($user) {
                $user->assignRole('JobTime');

                \App\Models\backend\UserSetting::factory()->create([
                    'user_id' => $user->id,
                ]);
                // Perfil::factory()->create([
                //     'user_id' => $user->id,
                // ]);
            });
        User::factory(1)
            ->create(
                [
                    'name' => 'vendedor',
                    'email' => 'vendedor@mail.com',
                ]
            )
            ->each(function ($user) {
                $user->assignRole('seller');

                \App\Models\backend\UserSetting::factory()->create([
                    'user_id' => $user->id,
                ]);
                // Perfil::factory()->create([
                //     'user_id' => $user->id,
                // ]);
            });
    }
}
