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


            </tbody>
        </table>



    </div>



@endsection