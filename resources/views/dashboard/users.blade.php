@extends('layout')

@section('scripts')
<script>
    $(document).ready(function(){
        
       $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });

    });

</script>
@stop

@section('content')
<div class="card">
    @include('errors.list')
    <div class="card-body">
        <h4 class="card-title">Users
            @if($user->user_type == 1)
            <a href="{{ url('/') }}/register?u={{ base64_encode($user->id) }}&t={{ base64_encode(2) }}" class="btn btn-info" style="float: right;">Create Manager</a>
            @endif
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
                        <a href="{{ url('/') }}/user/{{ $user->id }}/edit"  class="btn btn btn-primary">Edit</a>
                        <a href="#" data-href="{{ url('/') }}/user/{{ $user->id }}/delete" data-toggle="modal" data-target="#confirm-delete" class="btn btn-danger">Delete</a>
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
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Confirm deletion
            </div>
            <div class="modal-body">
                Are you sure that want to delete this user ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>
@endsection