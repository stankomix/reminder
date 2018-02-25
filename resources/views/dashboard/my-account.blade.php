@extends('layout')

@section('content')
<div class="card">
    @include('errors.list')
    <div class="card-body">
        <h4 class="card-title">My account</h4>
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
            </div>
            
            <h4 class="card-title">Company</h4>
            
            <div class="col-sm-6">
                <input type="hidden" name="company_id" value="{{ isset($company->id) ? $company->id : '' }}" />
                <div class="form-group">
                    <input type="text" name="company_name" {{ ($user->user_type == 1) ? '' : 'disabled' }} value="{{ isset($company->name) ? $company->name : '' }}" class="form-control" placeholder="Company Name">
                    <i class="form-group__bar"></i>
                </div>
                
                <div class="form-group">
                    <input type="text" name="phone" {{ ($user->user_type == 1) ? '' : 'disabled' }} value="{{ isset($company->phone) ? $company->phone : '' }}" class="form-control" placeholder="Phone">
                    <i class="form-group__bar"></i>
                </div>
                
                <div class="form-group">
                    <input type="text" name="address" {{ ($user->user_type == 1) ? '' : 'disabled' }} value="{{ isset($company->address) ? $company->address : '' }}" class="form-control" placeholder="Address">
                    <i class="form-group__bar"></i>
                </div>
                
                <div class="form-group">
                    <input type="text" name="city" {{ ($user->user_type == 1) ? '' : 'disabled' }} value="{{ isset($company->city) ? $company->city : '' }}" class="form-control" placeholder="City">
                    <i class="form-group__bar"></i>
                </div>
                
                <div class="form-group">
                    <input type="text" name="state" {{ ($user->user_type == 1) ? '' : 'disabled' }} value="{{ isset($company->state) ? $company->state : '' }}" class="form-control" placeholder="State">
                    <i class="form-group__bar"></i>
                </div>
                
                <div class="form-group">
                    <input type="text" name="zip" {{ ($user->user_type == 1) ? '' : 'disabled' }} value="{{ isset($company->zip) ? $company->zip : '' }}" class="form-control" placeholder="Zip Code">
                    <i class="form-group__bar"></i>
                </div>
                
                <div class="form-group">
                    <div class="select">
                        <select name="zone" {{ ($user->user_type == 1) ? '' : 'disabled' }} class="form-control">
                            <option value="">Select Time Zone</option>
                            <option {{ isset($company->zone) && $company->zone == 4 ? 'selected="selected"' : '' }} value="4">-4 GMT</option>
                            <option {{ isset($company->zone) && $company->zone == 5 ? 'selected="selected"' : '' }} value="5">-5 GMT</option>
                            <option {{ isset($company->zone) && $company->zone == 6 ? 'selected="selected"' : '' }} value="6">-6 GMT</option>
                            <option {{ isset($company->zone) && $company->zone == 7 ? 'selected="selected"' : '' }} value="7">-7 GMT</option>
                            <option {{ isset($company->zone) && $company->zone == 8 ? 'selected="selected"' : '' }} value="8">-8 GMT</option>
                            <option {{ isset($company->zone) && $company->zone == 9 ? 'selected="selected"' : '' }} value="9">-9 GMT</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-success" value="Update">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
    
@endsection