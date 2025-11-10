@extends(config('laravelusers.laravelUsersBladeExtended'))

@section('template_title')
    {!! trans('laravelusers::laravelusers.create-new-user') !!}
@endsection

@section('template_linked_css')
    @if(config('laravelusers.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('laravelusers.datatablesCssCDN') }}">
    @endif
    @if(config('laravelusers.fontAwesomeEnabled'))
        <link rel="stylesheet" type="text/css" href="{{ config('laravelusers.fontAwesomeCdn') }}">
    @endif
    @include('laravelusers::partials.styles')
    @include('laravelusers::partials.bs-visibility-css')
@endsection

@section('content')
    <div class="container">
        @if(config('laravelusers.enablePackageBootstapAlerts'))
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    @include('laravelusers::partials.form-status')
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <div class="pull-right">
                                <a href="{{ route('users') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="{!! trans('laravelusers::laravelusers.tooltips.back-users') !!}">
                                    @if(config('laravelusers.fontAwesomeEnabled'))
                                        <i class="fas fa-fw fa-reply-all" aria-hidden="true"></i>
                                    @endif
                                    {!! trans('laravelusers::laravelusers.buttons.back-to-users') !!}
                                </a>
                            </div>
                            {!! trans('laravelusers::laravelusers.create-new-user') !!}
                        </div>
                    </div>
                    <div class="card-body">
                        {!! Form::open(array('route' => 'users.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                            {!! csrf_field() !!}
                            <div class="form-group has-feedback row {{ $errors->has('email') ? ' has-error ' : '' }}">
                                <div class="col-md-10">
                                    <div class="input-group">
                                        {!! Form::text('email', NULL, array('id' => 'email', 'class' => 'form-control', 'placeholder' => trans('laravelusers::forms.create_user_ph_email'))) !!}
                                        <div class="input-group-append">
                                            <label for="email" class="input-group-text">
                                                @if(config('laravelusers.fontAwesomeEnabled'))
                                                    <i class="fa fa-fw {!! trans('laravelusers::forms.create_user_icon_email') !!}" aria-hidden="true"></i>
                                                @else
                                                    {!! trans('laravelusers::forms.create_user_label_email') !!}
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                @if(config('laravelusers.fontAwesomeEnabled'))
                                    {!! Form::label('email', trans('laravelusers::forms.create_user_label_email'), array('class' => 'col-md-2 control-label')); !!}
                                @endif
                            </div>
                            <div class="form-group has-feedback row {{ $errors->has('name') ? ' has-error ' : '' }}">
                                <div class="col-md-10">
                                    <div class="input-group">
                                        {!! Form::text('name', NULL, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('laravelusers::forms.create_user_ph_username'))) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="name">
                                                @if(config('laravelusers.fontAwesomeEnabled'))
                                                    <i class="fa fa-fw {!! trans('laravelusers::forms.create_user_icon_username') !!}" aria-hidden="true"></i>
                                                @else
                                                    {!! trans('laravelusers::forms.create_user_label_username') !!}
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                @if(config('laravelusers.fontAwesomeEnabled'))
                                    {!! Form::label('name', trans('laravelusers::forms.create_user_label_username'), array('class' => 'col-md-2 control-label')); !!}
                                @endif
                            </div>
                            @if($rolesEnabled)
                                <div class="form-group has-feedback row {{ $errors->has('role') ? ' has-error ' : '' }}">

                                    <div class="col-md-10">
                                    <div class="input-group">
                                        <select class="custom-select form-control" name="role" id="role">
                                            <option value="">{!! trans('laravelusers::forms.create_user_ph_role') !!}</option>
                                            @if ($roles)
                                                @foreach($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="role">
                                                @if(config('laravelusers.fontAwesomeEnabled'))
                                                    <i class="{!! trans('laravelusers::forms.create_user_icon_role') !!}" aria-hidden="true"></i>
                                                @else
                                                    {!! trans('laravelusers::forms.create_user_label_username') !!}
                                                @endif
                                            </label>
                                        </div>
                                    </div>

                                    @if ($errors->has('role'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                    @endif
                                    </div>
                                    @if(config('laravelusers.fontAwesomeEnabled'))
                                        {!! Form::label('role', trans('laravelusers::forms.create_user_label_role'), array('class' => 'col-md-2 control-label')); !!}
                                    @endif
                                </div>
                            @endif



                        <div class="form-group has-feedback row {{ $errors->has('status') ? ' has-error ' : '' }}">

                            <div class="col-md-10">
                                <div class="input-group">
                                    <select class="custom-select form-control" name="status" id="status" required onchange="updateStatusIcon()">
                                        <option value="">اختر حالة المستخدم</option>
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="banned" {{ old('status') == 'banned' ? 'selected' : '' }}>Banned</option>
                                    </select>

                                    <div class="input-group-append">
                                        <label class="input-group-text" for="status">
                                            @if(config('laravelusers.fontAwesomeEnabled'))
                                                <!-- Icon will be dynamically changed using JavaScript -->
                                                <i id="status-icon" class="fas fa-circle" style="color: #e0a800;" aria-hidden="true"></i>
                                            @else
                                                Status
                                            @endif
                                        </label>
                                    </div>
                                </div>

                                <!-- Error message for status -->
                                @if ($errors->has('status'))
                                    <span class="help-block text-danger">
                <strong>{{ $errors->first('status') }}</strong>
            </span>
                                @endif
                            </div>

                            @if(config('laravelusers.fontAwesomeEnabled'))
                                {!! Form::label('status', 'حالة المستخدم', ['class' => 'col-md-2 control-label']) !!}
                            @endif

                        </div>

                        <script>
                            function updateStatusIcon() {
                                var status = document.getElementById('status').value;
                                var icon = document.getElementById('status-icon');

                                // Change icon color based on selected status
                                if (status === 'approved') {
                                    icon.style.color = 'green';  // Green for approved
                                } else if (status === 'pending') {
                                    icon.style.color = '#e0a800';  // Yellow for pending
                                } else if (status === 'banned') {
                                    icon.style.color = 'red';  // Red for banned
                                } else {
                                    icon.style.color = '#e0a800';  // Default to yellow if nothing is selected
                                }
                            }
                        </script>



                            <div class="form-group has-feedback row {{ $errors->has('password') ? ' has-error ' : '' }}">

                                <div class="col-md-10">
                                    <div class="input-group">
                                        {!! Form::password('password', array('id' => 'password', 'class' => 'form-control ', 'placeholder' => trans('laravelusers::forms.create_user_ph_password'))) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="password">
                                                @if(config('laravelusers.fontAwesomeEnabled'))
                                                    <i class="fa fa-fw {!! trans('laravelusers::forms.create_user_icon_password') !!}" aria-hidden="true"></i>
                                                @else
                                                    {!! trans('laravelusers::forms.create_user_label_password') !!}
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                @if(config('laravelusers.fontAwesomeEnabled'))
                                    {!! Form::label('password', trans('laravelusers::forms.create_user_label_password'), array('class' => 'col-md-2 control-label')); !!}
                                @endif
                            </div>
                            <div class="form-group has-feedback row {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}">

                                <div class="col-md-10">
                                    <div class="input-group">
                                        {!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => trans('laravelusers::forms.create_user_ph_pw_confirmation'))) !!}
                                        <div class="input-group-append">
                                            <label class="input-group-text" for="password_confirmation">
                                                @if(config('laravelusers.fontAwesomeEnabled'))
                                                    <i class="fa fa-fw {!! trans('laravelusers::forms.create_user_icon_pw_confirmation') !!}" aria-hidden="true"></i>
                                                @else
                                                    {!! trans('laravelusers::forms.create_user_label_pw_confirmation') !!}
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                @if(config('laravelusers.fontAwesomeEnabled'))
                                    {!! Form::label('password_confirmation', trans('laravelusers::forms.create_user_label_pw_confirmation'), array('class' => 'col-md-2 control-label')); !!}
                                @endif
                            </div>
                            {!! Form::button(trans('laravelusers::forms.create_user_button_text'), array('class' => 'btn btn-success margin-bottom-1 mb-1 float-left','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('template_scripts')
    @if(config('laravelusers.tooltipsEnabled'))
        @include('laravelusers::scripts.tooltips')
    @endif
@endsection
