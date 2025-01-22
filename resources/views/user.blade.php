@extends('layouts.layout')

@section('title', 'User Management')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">User Management</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table 
                    id="basic-datatables"
                    class="display table table-striped table-hover">
                    <thead>
                        <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role }}</td>
                            <td class="text-center">
                                <button class="btn btn-black btn-sm">Default</button>
                                <button class="btn btn-danger btn-sm">Danger</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3">No data available</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
