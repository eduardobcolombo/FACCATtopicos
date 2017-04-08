@extends('layouts.app')


@section('content')

    <div class="container">
        <h3>Customers</h3>

        <p>
            <a href="{{ route('admin.customers.create') }}" class="btn btn-default">New Customer</a>
        </p>



        <table class="table">
            <thread>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Fone</th>
                    <th>email</th>
                    <th>Actions</th>
                </tr>
            </thread>
            <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{$customer->id}}</td>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->phone}}</td>
                    <td>{{$customer->email}}</td>
                    <td>
                        <a href="{{ route('admin.customers.edit',['id'=>$customer->id]) }}">Update</a>
                        <a href="{{ route('admin.customers.destroy',['id'=>$customer->id]) }}">Delete</a>
                    </td>
                </tr>
             @endforeach
            </tbody>
        </table>



    </div>



@endsection