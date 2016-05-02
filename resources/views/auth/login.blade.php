
@extends('../master')


@section('content')





    <div class="container">
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
            <div class="panel panel-info" >
                <div class="panel-heading">
                    <div class="panel-title">Sign In</div>
                    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="{{ url('/password/email') }}">Forgot password?</a></div>
                </div>

                <div style="padding-top:30px" class="panel-body" >

                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>

                    <form id="loginform" class="form-horizontal" role="form" method="POST" action="/auth/login">
                        {!! csrf_field() !!}


                        @if (count($errors) > 0)
                            <div style="color:red;">
                                Connexion refusee:
                                <ul>
                                    @foreach ($errors->all() as $error) <li >{{ $error }}</li>
                                    @endforeach </ul>
                            </div>
                        @endif
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="login-username" type="text" class="form-control" name="email" value="" placeholder="username or email">
                        </div>

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="login-password" type="password" class="form-control" name="password" placeholder="password">
                        </div>



                        <div style="margin-top:10px" class="form-group">
                            <!-- Button -->

                            <div class="col-sm-12 controls" >
                                <button id="btn-login" href="#" class="btn btn-success" type="submit">Login</button>

                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-12 control">
                                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                    Don't have an account!
                                    <a href="{{ url('/auth/register') }}">Register</a>
                                </div>
                            </div>
                        </div>
                    </form>



                </div>
            </div>
        </div>

    </div>

@endsection
