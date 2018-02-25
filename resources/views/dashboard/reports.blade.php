@extends('layout')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ isset($currectUser) ? $currectUser->first_name . ' ' . $currectUser->last_name : 'My' }} Reports
        @if(!isset($currectUser))
        <a href="{{ url('/') }}/report/add" class="btn btn-primary" style="float: right;margin-right: 10px;">Create Report</a>
        @endif 
        </h4>

        <table class="table mb-0">
            <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @if (count($reports) > 0)
                @foreach($reports as $key => $report)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ date('F d, Y',strtotime($report->created_at)) }}</td>
                    <td>
                        <a href="{{ url('/') }}/report/{{ $report->id }}/edit"  class="btn btn btn-primary">View Report</a>
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