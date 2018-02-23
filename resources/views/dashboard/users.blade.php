@extends('layout')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Users
            <a href="{{ url('/') }}/register?u={{ base64_encode($user->id) }}&t={{ base64_encode(2) }}" class="btn btn-info" style="float: right;">Create Manager</a>
            <a href="{{ url('/') }}/register?u={{ base64_encode($user->id) }}&t={{ base64_encode(3) }}" class="btn btn-primary" style="float: right;margin-right: 10px;">Create User</a>
        </h4>

        <table class="table mb-0">
            <thead>
            <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @if (count($users) > 0)
                @foreach($users as $key => $user)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ ($user->user_type == 2) ? 'Manager' : 'User' }}</td>
                    <td>
                        <a href="" class="btn btn btn-primary">Edit</a>
                        <a href="" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5"><center>No records</center></td>
                </tr>
                @endif;
            </tbody>
        </table>
    </div>
</div>
@endsection