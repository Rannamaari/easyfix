<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateLocalAdminUser extends Command
{
    protected $signature = 'local:admin';

    protected $description = 'Create or reset the default local-only admin account';

    public function handle(): int
    {
        if (! app()->environment('local')) {
            $this->error('This command is only available in the local environment.');

            return self::FAILURE;
        }

        $email = env('DEV_ADMIN_EMAIL', 'admin@easyfix.local');
        $username = env('DEV_ADMIN_USERNAME', 'localadmin');
        $password = env('DEV_ADMIN_PASSWORD', 'Admin123!');
        $phone = env('DEV_ADMIN_PHONE', '7770000');
        $name = env('DEV_ADMIN_NAME', 'Local Admin');

        $user = User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'username' => $username,
                'phone' => $phone,
                'role' => 'admin',
                'password' => Hash::make($password),
                'email_verified_at' => now(),
                'phone_verified_at' => now(),
            ]
        );

        $this->info('Local admin account is ready.');
        $this->table(
            ['Field', 'Value'],
            [
                ['Login URL', url('/admin/login')],
                ['Email', $email],
                ['Username', $username],
                ['Password', $password],
                ['Role', $user->role],
            ]
        );

        $this->newLine();
        $this->comment('Tip: You can override these with DEV_ADMIN_* values in your local .env file.');

        return self::SUCCESS;
    }
}
