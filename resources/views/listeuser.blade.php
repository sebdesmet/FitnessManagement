
@extends('../master')
<!-- Ligne obligatoire pour AJAX -->
<meta name="csrf-token" content="{{ csrf_token() }}" />

@section('content')

<style>
    @import url(//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css);


    .panel > .list-group .list-group-item:first-child {
        /*border-top: 1px solid rgb(204, 204, 204);*/
    }
    @media (max-width: 767px) {
        .visible-xs {
            display: inline-block !important;
        }
        .block {
            display: block !important;
            width: 100%;
            height: 1px !important;
        }
    }



    .c-search > .form-control {
        border-radius: 0px;
        border-width: 0px;
        border-bottom-width: 1px;
        font-size: 1.3em;
        padding: 12px 12px;
        height: 44px;
        outline: none !important;
    }
    .c-search > .form-control:focus {
        outline:0px !important;
        -webkit-appearance:none;
        box-shadow: none;
    }
    .c-search > .input-group-btn .btn {
        border-radius: 0px;
        border-width: 0px;
        border-left-width: 1px;
        border-bottom-width: 1px;
        height: 44px;
    }


    .c-list {
        padding: 0px;
        min-height: 44px;
    }
    .title {
        display: inline-block;
        font-size: 1.7em;
        font-weight: bold;
        padding: 5px 15px;
    }
    ul.c-controls {
        list-style: none;
        margin: 0px;
        min-height: 44px;
    }

    ul.c-controls li {
        margin-top: 8px;
        float: left;
    }

    ul.c-controls li a {
        font-size: 1.7em;
        padding: 11px 10px 6px;
    }
    ul.c-controls li a i {
        min-width: 24px;
        text-align: center;
    }

    ul.c-controls li a:hover {
        background-color: rgba(51, 51, 51, 0.2);
    }

    .c-toggle {
        font-size: 1.7em;
    }

    .name {
        font-size: 1.7em;
        font-weight: 700;
    }

    .c-info {
        padding: 5px 10px;
        font-size: 1.25em;
    }

</style>
    <div class="container">


        <div class="row">
            <div class="col-xs-12 col-sm-offset-3 col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading c-list">
                        <span class="title">Liste des utilisateurs</span>
                        <ul class="pull-right c-controls">
                            <li><a href="#" class="hide-search" data-command="toggle-search" data-toggle="tooltip" data-placement="top" title="Search"><i class="fa fa-ellipsis-v"></i></a></li>
                        </ul>
                    </div>

                    <div class="row" style="display: none;">
                        <div class="col-xs-12">
                            <div class="input-group c-search">
                                <input type="text" class="form-control" id="contact-list-search">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search text-muted"></span></button>
                            </span>
                            </div>
                        </div>
                    </div>

                    <ul class="list-group" id="contact-list">

                        @foreach($client as $client)

                        <li class="list-group-item" id='{{$client->firstname}}'>
                            <div class="col-xs-12 col-sm-3">
                                <img src="http://localhost/picture/{{$client->email}}/profile.jpeg" alt="ProfilePicture" class="img-responsive img-circle" />
                            </div>
                            <div class="col-xs-12 col-sm-9">
                                <span class="name">{{$client->firstname}}</span><button type="button" class="btn btn-success" id="btn1" onclick="AddUser('{{$client->firstname}}','{{$client->id}}')">Ajouter</button><br/>
                                <span class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip" title="Localisation"></span>
                                <span>{{$client->localisation}}</span><br>
                                <span class="visible-xs"> <span class="text-muted">LOOOOOL</span><br/></span>
                                <span class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip" title="Phone"></span>
                                <span>{{$client->phone}}</span><br>

                                <span class="visible-xs"> <span class="text-muted">{{$client->phone}}</span><br/></span>
                                <span class="fa fa-comments text-muted c-info" data-toggle="tooltip" title="E-mail"></span>
                                <span> {{$client->email}}</span>
                                <span class="visible-xs"> <span class="text-muted">{{$client->email}}</span><br/></span>
                            </div>
                            <div class="clearfix"></div>
                        </li>

                            @endforeach

                    </ul>
                </div>
            </div>
        </div>



        <!-- JavaScrip Search Plugin -->




    </div>

@endsection


