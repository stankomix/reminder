@extends('layout')

@section('content')
<div class="card">
    @include('errors.list')
    <div class="card-body">
        <h4 class="card-title">My Report - {{ date('F d, Y') }}</h4>
        <form action="{{ url('/') }}/report/add" method="POST">
            {{ csrf_field() }}
            <div class="col-sm-9">
                <div class="form-group">
                    <label>Weekly Summary</label>
                    <textarea class="form-control" name="summary" {{ ($current) ? '' : 'disabled' }} required="" rows="5" >{{ isset($report->summary) ? $report->summary : '' }}</textarea>
                    <i class="form-group__bar"></i>
                </div>
                
                <div class="form-group">
                    <label>Week's High</label>
                    <textarea class="form-control" name="high" {{ ($current) ? '' : 'disabled' }} rows="5" >{{ isset($report->high) ? $report->high : '' }}</textarea>
                    <i class="form-group__bar"></i>
                </div>
                
                <div class="form-group">
                    <label>Week's Low</label>
                    <textarea class="form-control" name="low" {{ ($current) ? '' : 'disabled' }} rows="5" >{{ isset($report->low) ? $report->low : '' }}</textarea>
                    <i class="form-group__bar"></i>
                </div>
                
                <div class="form-group">
                    <label>General Comments</label>
                    <textarea class="form-control" name="comments" {{ ($current) ? '' : 'disabled' }} rows="5" >{{ isset($report->comments) ? $report->comments : '' }}</textarea>
                    <i class="form-group__bar"></i>
                </div>
                @if ($current)
                <div class="form-group">
                    <button type="submit" class="btn btn-success" value="Update">Submit</button>
                </div>
                @endif
            </div>
        </form>
    </div>
</div>
    
@endsection