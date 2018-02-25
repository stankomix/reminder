@extends('layout')

@section('content')
<div class="card">
    @include('errors.list')
    <div class="card-body">
        <h4 class="card-title">Edit User Account</h4>
        <form action="#" method="POST">
            {{ csrf_field() }}
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" name="first_name" required="" value="{{ $user->first_name }}" class="form-control" placeholder="First Name">
                    <i class="form-group__bar"></i>
                </div>
                
                <div class="form-group">
                    <input type="text" name="last_name" required="" value="{{ $user->last_name }}" class="form-control" placeholder="Last Name">
                    <i class="form-group__bar"></i>
                </div>
                
                <div class="form-group">
                    <input type="text" name="name" value="{{ $user->name }}" required="" class="form-control" placeholder="Username">
                    <i class="form-group__bar"></i>
                </div>
                
                <div class="form-group">
                    <input type="email" name="email" value="{{ $user->email }}" required="" class="form-control" placeholder="Email">
                    <i class="form-group__bar"></i>
                </div>
                
                @if(Auth::user()->user_type == 1)
                
                <div class="form-group">
                    <div class="select">
                        <select name="user_type" class="form-control">
                            <option value="">Select User Type</option>
                            <option {{ isset($user->user_type) && $user->user_type == 2 ? 'selected="selected"' : '' }} value="2">Manager</option>
                            <option {{ isset($user->user_type) && $user->user_type == 3 ? 'selected="selected"' : '' }} value="3">User</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="select">
                        <select name="manager" class="form-control">
                            <option value="">Select Manager</option>
                            @foreach($managers as $manager)
                            <option {{ isset($user->manager) && $user->manager == $manager->id ? 'selected="selected"' : '' }} value="{{ $manager->id }}">{{ $manager->first_name . ' ' . $manager->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
            
                <div class="form-group">
                    <button type="submit" class="btn btn-success" value="Update">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
    
@endsection