@extends('../master')

@section('content')


    <div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Sign Up</div>

            </div>
            <div class="panel-body" >
                <form id="signupform" class="form-horizontal" role="form" method="POST" action="/auth/register">
                    {!! csrf_field() !!}

                                        @if (count($errors) > 0)
                        <div style="color:red;">
                            Il y'a un/des problemes pour la creation de votre compte :
                            <ul>
                                @foreach ($errors->all() as $error) <li >{{ $error }}</li>
                                @endforeach </ul>
                        </div>
                    @endif


                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">Username</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="name" placeholder="Username">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="firstname" class="col-md-3 control-label">Email</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-md-3 control-label">Password</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-md-3 control-label">Confirmation Password</label>
                        <div class="col-md-9">
                            <input type="password" class="form-control"  name="password_confirmation" placeholder="Password">
                        </div>
                    </div>


                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-md-offset-3 col-md-9">
                            <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i> &nbsp Register</button>

                        </div>
                    </div>






                </form>
            </div>
        </div>



</div>

@endsection