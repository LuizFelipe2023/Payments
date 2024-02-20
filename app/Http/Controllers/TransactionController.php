<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index(){
            $transactions = Transaction::all();
            return response()->json(['Transactions: '=>$transactions],201);
    }
    public function findbyId($id){
           $transaction = Transaction::find($id);
           if(!$transaction){
              return response()->json(['error: '=>'Transaction not found'],404);
           }
           return response()->json(['Transaction: '=>$transaction],201);
    }
    public function findbyMethod($method){
           $transaction = Transaction::where('method',$method)->get();
           return response()->json(['Transactions: '=>$transaction]);
    }
    public function store(Request $request){
        $request->validate([
            'price' => 'required|numeric',
            'date' => 'required|date',
            'method' => 'required|string'
        ]);
    
        $transaction = Transaction::create([
            'price' => $request->input('price'),
            'date' => $request->input('date'),
            'method' => $request->input('method')
        ]);
    
        return response()->json(['Transaction created: ' => $transaction], 201);
    }
    public function update(Request $request, $id){
        $transaction = Transaction::find($id);
        if(!$transaction){
            return response()->json(['error: ' => 'Transaction not found'], 404);
        }
    
        $request->validate([
            'price' => 'required|numeric',
            'date' => 'required|date',
            'method' => 'required|string'
        ]);
    
        $transaction->update([
            'price' => $request->input('price'),
            'date' => $request->input('date'),
            'method' => $request->input('method')
        ]);
    
        return response()->json(['Transaction updated: ' => $transaction], 200);
    }
    public function destroy($id){
        $transaction = Transaction::find($id);
        if(!$transaction){
            return response()->json(['error: ' => 'Transaction not found'], 404);
        }
    
        $transaction->delete();
    
        return response()->json(['Transaction deleted.'], 200);
    }
    
}
