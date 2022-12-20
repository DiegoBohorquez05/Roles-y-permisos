<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        return 'Listar todos';
    }

    public function show($id){
       return 'Mostrar un cliente';
    }

    public function store(Request $request){
        return 'Crear un cliente';
    }

    public function update(Request $request, $id){
        return 'Actualizar un cliente';
    }

    public function destroy($id){
        return 'Eliminar un cliente';
    }
}
