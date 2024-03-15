<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        User::create([
            'name' => 'su_admin',
            // 'email' => 'suadmin@example.com',
            'email' => 'ramses.rivas@gmail.com',
            'password' => Hash::make('TecladoJirafaCableFigura'),
            'activo' => 1,
        ]);
        
        $role1 = Role::create(['name' => 'user']);
        $role2 = Role::create(['name' => 'admin']);
        $role3 = Role::create(['name' => 'su_admin']);
        $user = User::find(1);

        if ($user) {
            $user->assignRole($role3);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
