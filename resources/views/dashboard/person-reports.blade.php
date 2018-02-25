@extends('layout')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Reports
        </h4>

        <table class="table mb-0">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                @if (count($reports) > 0)
                @foreach($reports as $key => $report)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $report->first_name . ' ' . $report->last_name }}</td>
                    <td>
                        <a href="{{ url('/') }}/reports/{{ $report->user }}"  class="btn btn btn-primary">View Reports</a>
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