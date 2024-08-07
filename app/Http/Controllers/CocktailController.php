<?php

namespace App\Http\Controllers;

use App\Models\Cocktail;
use Illuminate\Http\Request;
use Throwable;

class CocktailController extends Controller
{
    public function getCocktails(){
        $Cocktails = Cocktail::all();
        return $Cocktails;
    }


    public function create(Request $request)
    {
        try {
            $newCocktail = new Cocktail();
            $newCocktail->name = $request->name;
            $newCocktail->category = $request->category;
            $newCocktail->image = $request->image;
            $newCocktail->email = $request->email;
            $newCocktail->instruccions = $request->instruccions;
            $newCocktail->instruccionsEs = $request->instruccionsEs;
            $newCocktail->instruccionsIt = $request->instruccionsIt;
            $newCocktail->instruccionsFr = $request->instruccionsFr;
            $newCocktail->save();
            return response()->json($newCocktail);

        } catch (Throwable $throwableException) {
            $response = [
                'type' => "error",
                'content' => "Ocurrió un error al crear el Cocktail.",$throwableException
            ];
            return $response;
        }
    }

    public function update(Request $request,$id)
    {
        try {
            $editCocktail = Cocktail::find($id);
            if (isset($editCocktail)) {
                $editCocktail->name = $request->name;
                $editCocktail->category = $request->category;
                $editCocktail->image = $request->image;
                $editCocktail->email = $request->email;
                $editCocktail->instruccions = $request->instruccions;
                $editCocktail->instruccionsEs = $request->instruccionsEs;
                $editCocktail->instruccionsIt = $request->instruccionsIt;
                $editCocktail->instruccionsFr = $request->instruccionsFr;
                $editCocktail->save();
                return response()->json($editCocktail);
            } else {
                $response = [
                    'type' => "error",
                    'content' => "el Cocktail consultado no existe."
                ];
                return $response;
            }
        } catch (Throwable $throwableException) {
            $response = [
                'type' => "error",
                'content' => "Ocurrió un error al actualizar el empleado."
            ];
            return $response;
        }
    }

    public function destroy($id)
    {
        if(isset($id)){
            try {
                $Cocktail = Cocktail::findOrFail($id);
                $Cocktail->delete();
                return response()->json('Cocktail eliminado');
            } catch (Throwable $throwableException) {
                $response = [
                    'type' => "error",
                    'content' => "Ocurrió un error al eliminar el Cocktail."
                ];
            }
        }else{
            $response = [
                'type' => "error",
                'content' => "el Cocktail que intenta eliminar no existe."
            ];
            return $response;
        }
    }
}
