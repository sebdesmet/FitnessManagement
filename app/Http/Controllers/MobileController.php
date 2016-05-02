<?php
/**
 * Created by PhpStorm.
 * User: Seb
 * Date: 05/03/2016
 * Time: 10:26
 */

namespace App\Http\Controllers;

use App\Client;
use App\Relation;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;


class MobileController extends Controller
{
    public function registerUser(Request $req)
    {

        $Reponse=array ();
        $param = $req::all();
        // Check if the Request has any nullable params or email already used
        if($param['firstname'] != null && $param['lastname'] != null && $param['mail'] != null && $param['phone'] != null
        &&  $param['localisation'] != null &&  $param['password']) {
            // Generate a token
            // Create a new client in the db
            try{
                $client = new \App\Client();
                $client->firstname = $param['firstname'];
                $client->lastname = $param['lastname'];
                $client->email = $param['mail'];
                $client->phone = $param['phone'];
                $client->localisation = $param['localisation'];
                $client->token = $param['token'];
                $client->password = $param['password'];
                $client->save();
                mkdir('picture/'.$param['mail'], 0777, true);
                copy('profile.jpeg','picture/'.$param['mail'].'/profile.jpeg');
                $Reponse["Etat"] = "200";

            }
            catch (QueryException $e){
                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    $Reponse["Etat"] = "1062";
                }
            }

            //$Reponse["Token"] = $token;
        }
        else{
            $Reponse["Etat"] = "401";
        }
        $output[] = $Reponse;
        print(json_encode($output));

    }
    public function registerPictureProfile(Request $req)
    {
        $Reponse=array ();
        $param =$req::all();
        $name = $param["name"];
        $image = $param["image"];
        $user = $param["user"];
        $decodeImage = base64_decode("$image");
        file_put_contents("picture/".$user."/".$name.".JPEG",$decodeImage);
        $Reponse["Etat"] = "200";
        $output[] = $Reponse;
        print(json_encode($output));
    }
    public function getNotification(Request $req)
    {
        $param = $req::all();

        $user = DB::table('clients')
            ->where('email',$param['email'])
            ->get();

        $array = json_decode(json_encode($user), True);
        $id = $array[0]["id"];

        $result = DB::table('relations')
            ->where('id',$id)
            ->where('relation','En attente')
            ->get();
        return $result;
    }
    public function friendRequest(Request $req)
    {
        $Reponse=array ();
        $param = $req::all();
        $relation = new \App\Relation();
        $relation = Relation::where('email',$param["email_manager"])
                            ->where('id',$param["id_client"])
                            ->first();
        if($param["result"] == "Accept"){
            $relation->relation = 'Accept';
            $Reponse["Etat"] = "200";

        }
        else{
            $relation->relation = 'Refuse';
            $Reponse["Etat"] = "201";

        }
        $relation->save();
        $output[] = $Reponse;
        print(json_encode($output));
    }

    public function getWorkout(Request $req){

        $param = $req::all();

        // This is a jointure of 3 tables, then the name,repet,serie and the id are selected
        $result = DB::table('clients')
            ->join('workouts','clients.id','=','workouts.id_client')
            ->join('exercices','exercices.id_workout','=','workouts.id_workout')
            ->where('email',$param['email'])
            ->where('workouts.date_validation','')
            ->select('exercices.name','exercices.repetition','exercices.repos','exercices.serie','exercices.id_workout')
            ->get();
        return result;


    }
}