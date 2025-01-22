@extends('layouts.layout')

@section('title', 'Task')

@section('content')

<form action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">New Task</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input
                                type="text"
                                class="form-control"
                                id="title"
                                name="title"
                                placeholder="Enter Title"
                                />
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="birth_place">Description</label>
                                <input
                                type="text"
                                class="form-control"
                                id="description"
                                name="description"
                                placeholder="Enter Description"
                                />
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <div class="selectgroup-pills">
                                    <label class="selectgroup-item">
                                        <input
                                        type="radio"
                                        name="status_id"
                                        value="1"
                                        class="selectgroup-input"
                                        checked=""
                                        />
                                        <span class="selectgroup-button">Pending</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input
                                        type="radio"
                                        name="status_id"
                                        value="2"
                                        class="selectgroup-input"
                                        />
                                        <span class="selectgroup-button">In-Progress</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input
                                        type="radio"
                                        name="status_id"
                                        value="3"
                                        class="selectgroup-input"
                                        />
                                        <span class="selectgroup-button">Completed</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    <div class="card-action">
                        <button type="submit" class="btn btn-success">Submit</button>
                        {{-- <button class="btn btn-danger">Cancel</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection