@extends('layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ ucfirst(config('app.name')) }} @lang('global.app_login')</div>
                <div class="panel-body">
                    
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>@lang('global.app_whoops')</strong> @lang('global.app_there_were_problems_with_input'):
                            <br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal"
                          role="form"
                          method="POST"
                          action="{{ url('login') }}">
                        <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">@lang('Usuario')</label>

                            <div class="col-md-6">
                                <input type="text"
                                       class="form-control"
                                       name="email"
                                       value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">@lang('Contraseña')</label>

                            <div class="col-md-6">
                                <input type="password"
                                       class="form-control"
                                       name="password">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit"
                                        class="btn btn-primary"
                                        style="margin-right: 15px;">
                                    @lang('global.app_login')
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection