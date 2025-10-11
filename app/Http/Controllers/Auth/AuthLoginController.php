<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthLoginController extends Controller
{
    public function authLogin(Request $request)
    {
        //validação
        $request->validate(
            [
                'email' => 'required|email',
                'senha' => 'required'
            ],
            [
                'email.required' => 'Email obrigatorio.',
                'email.email' => 'Endereço de email invalido.',
                'senha.required' => 'Digite sua senha.',
            ]
        );

        //dados do input
        $email = $request->input('email');
        $senha = $request->input('senha');

        //busca usuário
        $user = User::where('email', $email)
            ->first();

        //checar se os dados existem no BD
        if (!$user or !password_verify($senha, $user->password)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Usuário ou senha incorreta');
        }

        //cria sessão do usuário
        session([
            'user' => [
                'id' => $user->id,
                'firstName' => $user->firstName,
                'lastName' => $user->lastName,
                'email' => $user->email
            ]
        ]);

        return redirect()->to('dashboard');
    }
}
