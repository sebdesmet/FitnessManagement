@extends('../master')
        <!-- Ligne obligatoire pour AJAX -->
<meta name="csrf-token" content="{{ csrf_token() }}" />

@section('content')


<style>
    .maincontent{
        text-align: center;
        width : 100%;
    }
    .info{

        text-align: center;
        display: inline-block;
        width: 45%;
        height: 1000px;
        background-color: whitesmoke;
        font-size: 20px;
        font-weight: bold;
    }

    table {
        width:100%;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    th, td {
        padding: 5px;
        text-align: left;
    }
    table#t01 tr:nth-child(even) {
        background-color: #eee;
    }
    table#t01 tr:nth-child(odd) {
        background-color:#fff;
    }
    table#t01 th	{
        background-color: black;
        color: white;
    }
</style>
<div class="maincontent">
    <div class="info">


        <div class="panel panel-primary">
            <div class="panel-heading">Informations de l'utilisateur</div>
            <div class="panel-body">
                <div style="padding-top:30px;" class="panel-body" >
                    <div style="float: left">
                    <img src="http://localhost/picture/{{$client->email}}/profile.jpeg" alt="ProfilePicture" width="200" height="200" style="border-radius: 50%;"/><br>
                    </div>
                    <div style="float: left;padding: 30px;">

                        <div>
                            <span style="float: left" class="glyphicon glyphicon-user text-muted c-info" data-toggle="tooltip">{{$client->firstname}}</span><br>

                        </div>
                        <div>
                            <span style="float: left" class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip" title="Localisation">{{$client->localisation}}</span><br>
                            </div>
                        <div>
                            <span style="float: left" class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip" title="Phone">{{$client->phone}}</span><br>

                        </div>
                        <div>
                            <span style="float: left" class="glyphicon glyphicon-envelope text-muted c-info" data-toggle="tooltip" title="Mail">{{$client->email}}</span><br>

                        </div>

                    </div>


                </div>
            </div>
        </div>


        <?php
            $workout = DB::table('workouts')->where('id_client',$client->id )->where('date_validation','')->get();
            $showAdd = true;

        ?>
        @if($workout == null)
            <?php $showAdd = true ?>
        @endif
        @if($workout != null)

            <span> Derniers Workout </span><br>
        <table id="t01">
            <tr>
                <th>Workout</th>
                <th>Date de validation</th>

            </tr>

        @foreach($workout as $workout)


            @if($workout->isvalid == false)
                    <?php $showAdd = true ?>
                @endif

                <tr>
                    <td>
                        <?php
                        $exo = DB::table('exercices')->where('id_workout',$workout->id_workout)->get();
                        ?>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Exercice</th>
                                    <th>Serie</th>
                                    <th>Repetition</th>
                                    <th>Repos</th>
                                </tr>
                                </thead>
                                <tbody>
                        @foreach($exo as $exo)


                                    <tr>
                                        <td><b>{{$exo->name}}</b></td>
                                        <td>{{$exo->serie}}</td>
                                        <td>{{$exo->repetition}}</td>
                                        <td>{{$exo->repos}}</td>
                                    </tr>

                            @endforeach
                            </tbody>
                            </table>
                    </td>
                    <td style="text-align:center">

                        @if($workout->date_validation != null)
                            <img src="http://localhost/images/success.png" width="15px" height="15px">
                            @endif
                        @if(!($workout->date_validation != null))

                                <?php $hasworkout = true ?>



                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="btn_up">
                                        Update
                                    </button>
                                    <button type="button" class="btn btn-danger" onclick="DeleteWorkout('{{$workout->id_workout}}','{{$client->id}}')">
                                        Supprimer
                                    </button>


                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Modifier un workout</h4>
                                                </div>
                                                <form>
                                                    {!! csrf_field() !!}
                                                    <div class="modal-body">
                                                        <!-- Formulaire -->


                                                        <div>

                                                            <?php
                                                            $exoUpdate = DB::table('exercices')->where('id_workout',$workout->id_workout)->get();
                                                            $i = count($exoUpdate);
                                                            $i = 1;
                                                            $tab = array();
                                                            ?>
                                                            <div id="workout_update">


                                                            @foreach($exoUpdate as $exoUpdate)
                                                                <div id=divUpdate<?=$i?>>
                                                                        <select id=exoUpdate<?=$i?>>
                                                                            <option selected="selected">
                                                                                {{$exoUpdate->name}}
                                                                            </option>
                                                                        <option value='Curl barre'>Curl barre</option>
                                                                        <option value='Curl incliné'>Curl incliné</option>
                                                                        <option value='Tractions'>Tractions</option>
                                                                        <option value='Rowing buste penché'>Rowing buste penché</option>
                                                                            <option value='Traction supination'>Traction supination</option>
                                                                            <option value='Souleve de terre'>Souleve de terre</option>
                                                                            <option value='Clean & press'>Clean & press</option>
                                                                            <option value='Elevation lateral'>Elevation lateral</option>
                                                                            <option value='Squat frontal'>Squat frontal</option>
                                                                            <option value='Fentes'>Fentes</option>
                                                                            <option value='Developpe incline haltere'>Developpe incline haltere</option>
                                                                            <option value='Developpe couche'>Developpe couche</option>
                                                                            <option value='Pull over'>Pull over</option>
                                                                            <option value='Dips sur banc'>Dips sur banc</option>
                                                                            <option value='Dips leste'>Dips leste</option>
                                                                            <option value='Skull Crusher'>Skull Crusher</option>
                                                                        </select>
                                                                    <select id=serieUpdate<?=$i?>>
                                                                        <option selected="selected">
                                                                            {{$exoUpdate->serie}}
                                                                        </option>
                                                                        <option value='1'>1 Serie</option>
                                                                        <option value='2'>2 Serie</option>
                                                                        <option value='3'>3 Serie</option>
                                                                        <option value='4'>4 Serie</option>
                                                                        </select>
                                                                    <select id=repetUpdate<?=$i?>>
                                                                        <option selected="selected">
                                                                            {{$exoUpdate->repetition}}
                                                                        </option>
                                                                        <option value='1'>1 repet</option>
                                                                        <option value='2'>2</option>
                                                                        <option value='3'>3</option>
                                                                        <option value='4'>4</option>
                                                                        </select>
                                                                    <select id=minuteUpdate<?=$i?>>
                                                                        <option selected="selected">
                                                                            {{$exoUpdate->repos}}
                                                                        </option>
                                                                        <option value='1'>1 min de repos</option>
                                                                        <option value='2'>2</option>
                                                                        <option value='3'>3</option>
                                                                        <option value='4'>4</option>
                                                                        </select>

                                                                    <br>
                                                                    </div>

                                                                    <?php

                                                                    $i++;

                                                                    ?>




                                                                @endforeach
                                                            </div>
                                                                <button type="button" class="btn btn-error" id="btn1" onclick="AddLine_update('workout_update')">+</button>
                                                                <button type="button" class="btn btn-error" id="btn1" onclick="RemoveLine_update('workout_update')">-</button><br/>

                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <input type="button" class="btn btn-primary" onclick="UpdateWorkout('{{$workout->id_workout}}','{{$client->id}}')">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            @endif




                    </td>

                </tr>
            @endforeach
        </table>
        @endif

        @if($showAdd == true)
        <span> Ajouter un workout </span><br>
        <div id="workout">

        </div>
        <button type="button" class="btn btn-error" id="btn1" onclick="AddLine('workout')">+</button><br/>

        <button type="button" class="btn btn-primary" id="btn1" onclick="AddWorkout({{$client->id}})">Confirmer</button><br/>

        @endif

        <span> Graphiques </span><br>
        <?php
        $path = "/Users/Utilisateur/Downloads/TFE/TFE/public/picture/$client->email";
        $files = scandir($path);

        ?>
        @foreach($files as $files)
            @if($files != '.' && $files != '..' && $files != 'profile.jpeg')

                <a href="http://localhost/picture/{{$client->email}}/{{$files}}" data-lightbox="image-1" data-title="My caption"><img src="http://localhost/picture/{{$client->email}}/{{$files}}" alt="Graphique" width="200" height="200" /></a>
            @endif
            @endforeach



    </div>

</div>



@endsection