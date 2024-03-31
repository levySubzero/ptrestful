@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Users\' info') }}</div>

                <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>No.</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Age</th>
                        <th>Town</th>
                        <th>Gender</th>
                        <th width="280px">Action</th>
                    </tr>
                    @php $i = 0; @endphp
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->age }}</td>
                        <td>{{ $user->town }}</td>
                        <td>{{ $user->gender }}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Small button
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('info.add', $user->id) }}">Update</a></li>
                                    <li><a class="dropdown-item" href="{{ route('info.delete', $user->id) }}">Delete</a></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
