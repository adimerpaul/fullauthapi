<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(){
        return Car::all();
    }
    public function store(Request $request){
        $car = new Car();
        $car->model = $request->model;
        $car->color = $request->color;
        $car->placa = $request->placa;
        $car->fecha = $request->fecha;
        $car->save();
        return $car;
    }
    public function update(Request $request, $id){
        $car = Car::findOrFail($id);
        $car->model = $request->model;
        $car->color = $request->color;
        $car->placa = $request->placa;
        $car->fecha = $request->fecha;
        $car->save();
        return $car;
    }
    public function destroy($id){
        $car = Car::findOrFail($id);
        $car->delete();
        return $car;
    }
}
