@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Activity Logs</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Activity</th>
                    <th>Route</th>
                    <th>Date/Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($activityLogs as $key => $log)
                    <tr>
                        <td>{{ $activityLogs->firstItem() + $key }}</td>
                        <td>{{ $log->user->name }}</td>
                        <td>{{ $log->activity }}</td>
                        <td>{{ $log->route }}</td>
                        <td>{{ $log->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $activityLogs->links() }}
    </div>
@endsection
