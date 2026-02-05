<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('users', 'username')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('username', 50)->nullable()->after('name');
            });
        }

        // Backfill usernames for existing users to avoid unique constraint violations
        $users = \DB::table('users')->select('id', 'email')->get();
        foreach ($users as $user) {
            $base = $user->email ? explode('@', $user->email)[0] : 'user';
            $username = $base . $user->id;
            \DB::table('users')->where('id', $user->id)->update([
                'username' => $username,
            ]);
        }

        $indexes = \DB::select("SHOW INDEX FROM users WHERE Key_name = 'users_username_unique'");
        if (count($indexes) === 0) {
            Schema::table('users', function (Blueprint $table) {
                $table->unique('username');
            });
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};
