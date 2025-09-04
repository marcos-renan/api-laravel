<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() : JsonResponse
    {

        //puxar usuarios do BD
        $users = User::orderBy('id')->get();

        //retornar usuarios como json
        return response()->json([
            'status' => true,
            'users' => $users,
        ], 200);
    }

    public function show(User $user) : JsonResponse
    {
        //retorna um unico usuario como json
        return response()->json([
            'status' => true,
            'user' => $user,
        ], 200);
    }

    public function store(UserRequest $request)
    {
        //inicia a transação dos dados para o BD
        DB::beginTransaction();

        try {

            //faz a criação no banco de dados
            $user = User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> $request->password
            ]);

            //faz a alteração no banco de dados
            DB::commit();

            //returna resposta em formato json
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'O usuário foi cadastrado com sucesso!',
            ], 201);

        } catch (Exception $error) {
            //desfaz qualquer alteração
            DB::rollBack();

            //retorna resposta "false", http status 400
            return response()->json([
                'status'=> false,
                'message'=> 'O usuário não foi cadastrado!'
            ], 400);
        }
    }

    public function update(UserRequest $request, User $user) : JsonResponse
    {

        //iniciar transação
        DB::beginTransaction();

        try {
            
            //editar registro
            $user->update([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> $request->password,
            ]);

            //salva no banco de dados
            DB::commit();

            //retorna os dados do usuario editado
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'O usuário foi editado com sucesso!',
            ], 200);


        } catch (Exception $error) {
            //desfaz qualquer alteração
            DB::rollBack();
            
            //retorna resposta "false" http status 400
            return response()->json([
                'status' => false,
                'message' => 'O usuário não foi editado!'
            ], 400);
        }

        //retorna mensagem de erro
        return response()->json([
            'status' => true,
            'user' => $user,
            'message' => 'O usuário foi editado com sucesso!',
        ], 200);
    }

    public function destroy(User $user) : JsonResponse
    {
        try {

            //deleta usuario selecionado
            $user->delete();

            //retorna mensagem de sucesso ao apagar
            return response()->json([
                'status' => true,
                'user' => $user,
                'message' => 'O usuário foi apagado com sucesso!',
            ], 200);
            
        } catch (Exception $error) {

            //retorna o erro e mensagem
            return response()->json([
                'status' => false,
                'message' => 'O usuário não foi apagado!'
            ], 400);
        }
    }

}
