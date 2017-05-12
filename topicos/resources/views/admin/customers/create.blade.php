@extends('layouts.app')
@section('content')

    <div class="cadastro">
        <h1>Customers</h1>
        @include('errors._check')

        {!! Form::open(['route'=>'admin.customers.store']) !!}

        @include('admin.customers._form')

        {!! Form::close() !!}
    </div>

@endsection