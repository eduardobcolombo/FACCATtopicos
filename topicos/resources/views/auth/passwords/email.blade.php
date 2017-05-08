@extends('layouts.app')

@section('content')
    <form class="login" role="form" method="POST" action="{{ route('password.email') }}">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        {{ csrf_field() }}
        <h1>Reset Password</h1>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
        </div>
        <button type="submit">Send Password Reset Link</button>                
    </form>
</body>
</html>

@endsection