<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Currency;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [

            [
                "role" => User::SUPERADMIN,
                "username" => "superadministrador",
                "email" => "superadmin@superadmin.com",
                "password" => bcrypt("password"),
                "email_verified_at" => now(),
                "created_at" => now(),

            ],

            [
                "role" => User::ADMIN,
                "username" => "administrador",
                "email" => "admin@admin.com",
                "password" => bcrypt("password"),
                "email_verified_at" => now(),
                "created_at" => now(),

            ],
            [
                "role" => User::EDITOR,
                "username" => "editor",
                "email" => "editor@editor.com",
                "password" => bcrypt("password"),
                "email_verified_at" => now(),
                "created_at" => now(),

            ],
            [
                "role" => User::MEMBER,
                "username" => "miembro",
                "email" => "miembro@miembro.com",
                "password" => bcrypt("password"),
                "email_verified_at" => now(),
                "created_at" => now(),

            ],
            [
                "role" => User::GUEST,
                "username" => "invitado",
                "email" => "invitado@invitado.com",
                "password" => bcrypt("password"),
                "email_verified_at" => now(),
                "created_at" => now(),

            ],
        ];

        foreach ($users as $user) {

            $user = User::create($user);
        }
    }
}
