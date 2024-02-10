<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolController extends Controller
{
    public function update(Request $request, $id){
        $user = User::find($id);
        $user->syncRoles([$request->role]);

        return redirect()->back()->with('mensaje', 'Rol actualizado correctamente');
    }

    public function destroy($id){
        $user = User::find($id);
        $user->removeRole([$id]);

        return redirect()->back()->with('mensaje', 'Rol eliminado correctamente');
    }
}
