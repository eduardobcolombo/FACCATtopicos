@extends('layouts.app')


@section('content')

    <div class="container">
        <h3>Customers</h3>


        @include('errors._check')

        {{--{!! Form::open(['route'=>'admin.customers.update']) !!}--}}
        {!! Form::model($customer, ['route'=>['admin.customers.update',$customer->id]]) !!}

        @include('admin.customers._form')

        {!! Form::close() !!}


    </div>



@endsection