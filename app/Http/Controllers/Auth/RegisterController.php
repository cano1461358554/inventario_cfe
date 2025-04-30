<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'RP' => ['required', 'string', 'max:255', 'unique:users'],
            'tipo_usuario' => ['required', 'string', 'in:admin,encargado,empleado'], // Validar valores permitidos
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'RP' => $data['RP'],
            'tipo_usuario' => $data['tipo_usuario'],
            'password' => Hash::make($data['password']),
        ]);

        // Asignar rol basado en tipo_usuario
        $this->assignUserRole($user, $data['tipo_usuario']);

        return $user;
    }

    /**
     * Asigna el rol correspondiente al usuario
     */
    protected function assignUserRole(User $user, string $tipoUsuario)
    {
        // Verificar si el rol existe, si no, crearlo
        $role = Role::firstOrCreate(['name' => $tipoUsuario]);

        // Asignar el rol al usuario
        $user->assignRole($role);

        // Si es el primer usuario, asegurarse que sea admin
        if(User::count() === 1 && $tipoUsuario !== 'admin') {
            $adminRole = Role::firstOrCreate(['name' => 'admin']);
            $user->syncRoles([$adminRole]);
        }
    }

    public function username()
    {
        return 'RP';
    }

    /**
     * Sobrescribir el método registered para redirigir según el rol
     */
//    protected function registered($request, $user)
//    {
//        if ($user->hasRole('admin')) {
//            return redirect()->route('admin.dashboard');
//        } elseif ($user->hasRole('encargado')) {
//            return redirect()->route('encargado.dashboard');
//        }elseif ($user->hasRole('empleado')) {
//            return redirect()->route('empleado.dashboard');
//        }
//        return redirect($this->redirectTo);
//    }
    protected function registered($request, $user)
    {
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('encargado')) {
            return redirect()->route('encargado.dashboard');
        }
        return redirect()->route('empleado.dashboard');
    }
}
