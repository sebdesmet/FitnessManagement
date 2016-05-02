<?php
/**
 * Created by PhpStorm.
 * User: Seb
 * Date: 23/01/2016
 * Time: 12:40
 */

namespace App\Http\Controllers;



use App\Client;
use App\Exercice;
use App\Relation;
use App\User;
use App\Workout;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Symfony\Component\Console\Output\ConsoleOutput;

class FitnessController extends Controller
{

    public function home()
    {

        if(Auth::check())
        {
            return view('home');
        }
        else{
            return view('auth/login');
        }

    }

    public function search(Request $req)
    {

        $param = $req::all();
        $users =  USER::where('name', 'LIKE',"%".$param['search']."%")->get();

        foreach ($users as $user)
        {
            var_dump($user->name);
        }
    }


    public function listeUser()
    {
        if(Auth::check())
        {
            $t = Auth::user()->email;
            $client =  DB::select('select * from clients');


            //var_dump($client);


            return view('listeUser', ['client' => $client ]);
        }
        else{
            return view('auth/login');
        }

    }

    public function addUser(Request $req)
    {
        $param = $req::all();
        if(Request::ajax()){
            $relation = new \App\Relation();
            $relation->email = Auth::user()->email;
            $relation->id = $param['id'];
            $relation->relation = 'En attente';
            $relation->save();
            return Request::all();
        }

    }
    public function delUser(Request $req)
    {
        $param = $req::all();
        if(Request::ajax()){
            $relation = DB::table('relations')
                ->where('email', Auth::user()->email)
                ->where('id',$param['id'])
                ->delete();
            return Request::all();
        }

    }
    public function waiting()
    {
        if(Auth::check())
        {
            $t = Auth::user()->email;
            $client = DB::table('relations')
                ->join('clients','clients.id','=','relations.id')
                ->where('relations.email',$t)
                ->where('relations.relation','En attente')
                ->get();
            //var_dump($client);
            return view('waiting', ['client' => $client ]);

        }
        else{
            return view('auth/login');
        }

    }
    public function myuser()
    {
        if(Auth::check())
        {
            $t = Auth::user()->email;
            $client = DB::table('relations')
                ->join('clients','clients.id','=','relations.id')
                ->where('relations.email',$t)
                ->where('relations.relation','Accept')
                ->get();
            //var_dump($client);
            return view('myuser', ['client' => $client ]);

        }
        else{
            return view('auth/login');
        }

    }

    public function getinfouser(Request $req)
    {
        $param = $req::all();
        //var_dump($param);
        $result = DB::table('clients')
            ->where('email',$param['email'])->get();
        return $result;
    }

    public function showUser($id)
    {

        $client = Client::where('id',$id)->first();
        //$client = $client["email"];
        //var_dump($client);
        return view('user', ['client' => $client ]);

    }

    public function addWorkout(Request $req){
        $param = $req::all();
        var_dump($param);
        $workout = new \App\Workout();
        $workout->id_client=$param['id'];
        $workout->isvalid ='no';
        $workout->save();
        $id = $workout->id;

        $i = $param['number'];
        while($i > 0){
            $exercice = new \App\Exercice();
            $exercice->id_workout = $id;
            $exercice->name = $param['name'][$i-1];
            $exercice->serie = $param['serie'][$i-1];
            $exercice->repetition = $param['repetition'][$i-1];
            $exercice->repos = $param['repos'][$i-1];
            $exercice->save();
            $i--;
        }

    }

    public function updateWorkout(Request $req){

        $param = $req::all();
        var_dump($param);
        Exercice::where('id_workout',$param['id_workout'])->delete();
        $count = $param['number'];
        $i = 1;
        while($i <= $count){
            $exercice = new \App\Exercice();
            $exercice->id_workout = $param['id_workout'];
            $exercice->name = $param['name'][$i-1];
            $exercice->serie = $param['serie'][$i-1];
            $exercice->repetition = $param['repetition'][$i-1];
            $exercice->repos = $param['repos'][$i-1];
            $exercice->save();
            $i++;
        }

        $client = Client::where('id',$param['id'])->first();

        return view('user', ['client' => $client ]);

    }

    public function deleteWorkout(Request $req){
        $param = $req::all();
        var_dump($param);
        Exercice::where('id_workout',$param['id_workout'])->delete();
        Workout::where('id_workout',$param['id_workout'])->delete();

    }





}