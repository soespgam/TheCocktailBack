<?php

namespace App\Http\Controllers;

use App\Models\Cocktail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Throwable;

class CocktailController extends Controller
{
    public function getCocktails()
    {
        $Cocktails = Cocktail::all();
        return $Cocktails;
    }

    public function getCocktailsApiByLetter(string $letter)
    {
        $cocktailsApiByLetter = Http::get(url: 'https://www.thecocktaildb.com/api/json/v1/1/search.php?f=' . $letter);
        return $cocktailsApiByLetter;
    }

    public function getCocktailsApiById(string $id)
    {
        $cocktailsApiById = Http::get(url: 'www.thecocktaildb.com/api/json/v1/1/lookup.php?i=' . $id);
        return $cocktailsApiById;
    }


    public function create(Request $request)
    {
     
        try {
            $newCocktail = new Cocktail();
            $newCocktail->id = $request->id;
            $newCocktail->name = $request->name;
            $newCocktail->category = $request->category;
            $newCocktail->image = $request->image;
            $newCocktail->instruccions = $request->instruccions;
            $newCocktail->instruccionsEs = $request->instruccionsEs;
            $newCocktail->instruccionsIt = $request->instruccionsIt;
            $newCocktail->instruccionsFr = $request->instruccionsFr;
            $newCocktail->save();
            return response()->json($newCocktail);
        } catch (Throwable $throwableException) {
            $response = [
                'type' => "error",
                'content' => "Ocurrió un error al crear el Cocktail.", $throwableException
            ];
            return $response;
        }
    }

    public function getCoktailBd(string $id){
        $Cocktail_by_id= Cocktail::find($id);

        if(!is_null($Cocktail_by_id)){
            try {
                return response()->json($Cocktail_by_id);

            } catch (Throwable $th) {
                return response()->json([
                    'status'=>false,
                    'message'=>'Ocurrió un error al consultar el coctel', $th->getMessage()
                ]);
            }
        }else{
            return response()->json([
                'status'=>false,
                'message'=>"el coctel no existe."
            ]);
        }
    }

    public function update(Request $request)
    {
        try {
            $editCocktail = Cocktail::find($request->id);
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
        if (isset($id)) {
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
        } else {
            $response = [
                'type' => "error",
                'content' => "el Cocktail que intenta eliminar no existe."
            ];
            return $response;
        }
    }
}
