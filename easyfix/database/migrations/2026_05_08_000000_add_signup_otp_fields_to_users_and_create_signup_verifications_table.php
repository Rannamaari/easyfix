<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('username', 50)->nullable()->unique()->after('name');
            });
        }

        if (! Schema::hasColumn('users', 'phone_verified_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->timestamp('phone_verified_at')->nullable()->after('email_verified_at');
            });
        }

        $driver = DB::getDriverName();
        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE users MODIFY email VARCHAR(255) NULL');
        } elseif ($driver === 'pgsql') {
            DB::statement('ALTER TABLE users ALTER COLUMN email DROP NOT NULL');
        }

        DB::table('users')
            ->orderBy('id')
            ->get(['id', 'name', 'email', 'phone', 'username'])
            ->each(function ($user) {
                if (! empty($user->username)) {
                    return;
                }

                $base = null;
                if (! empty($user->email)) {
                    $base = explode('@', $user->email)[0];
                } elseif (! empty($user->phone)) {
                    $base = 'user' . preg_replace('/\D+/', '', $user->phone);
                } elseif (! empty($user->name)) {
                    $base = preg_replace('/[^a-z0-9]+/i', '', strtolower($user->name));
                }

                $base = trim((string) $base) ?: 'user';
                $candidate = substr($base, 0, 40);

                while (DB::table('users')->where('username', $candidate)->where('id', '!=', $user->id)->exists()) {
                    $candidate = substr($base, 0, 34) . random_int(100000, 999999);
                }

                DB::table('users')->where('id', $user->id)->update([
                    'username' => $candidate,
                ]);
            });

        Schema::create('signup_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            $table->enum('signup_method', ['email', 'phone'])->default('phone');
            $table->string('name')->nullable();
            $table->string('username', 50)->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 30);
            $table->string('address_type', 20)->nullable();
            $table->string('address_line1')->nullable();
            $table->string('address_line2')->nullable();
            $table->string('password')->nullable();
            $table->string('otp_hash');
            $table->timestamp('otp_expires_at')->nullable();
            $table->timestamp('otp_sent_at')->nullable();
            $table->unsignedSmallInteger('attempts')->default(0);
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();

            $table->index('phone');
            $table->index('email');
            $table->index('username');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('signup_verifications');

        if (Schema::hasColumn('users', 'phone_verified_at')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('phone_verified_at');
            });
        }
    }
};
