@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div style="display: flex; justify-content: start; margin-left: 1rem;">
                        <h5 class="">{{ __('Users') }}</h5>
                    </div>

                    <div class="container table-responsive py-2"> 
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>No.</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Age</th>
                                    <th>Town</th>
                                    <th>Gender</th>
                                    <th width="280px">Action</th>
                                </tr>
                            </thead>    
                            @php $i = 0; @endphp
                            <tbody class="table-light">
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->age }}</td>
                                    <td>{{ $user->town }}</td>
                                    @if($user->gender == 'M')
                                        <td>Male</td>
                                    @elseif($user->gender == 'F')
                                        <td>Female</td>
                                    @else
                                        <td>Unspecified</td>
                                    @endif
                                    <td>
                                        <div class="btn-group">
                                            <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                                            <svg width="80px" height="30px" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7 12C7 13.1046 6.10457 14 5 14C3.89543 14 3 13.1046 3 12C3 10.8954 3.89543 10 5 10C6.10457 10 7 10.8954 7 12Z" fill="#1C274C"/>
                                                <path d="M14 12C14 13.1046 13.1046 14 12 14C10.8954 14 10 13.1046 10 12C10 10.8954 10.8954 10 12 10C13.1046 10 14 10.8954 14 12Z" fill="#1C274C"/>
                                                <path d="M21 12C21 13.1046 20.1046 14 19 14C17.8954 14 17 13.1046 17 12C17 10.8954 17.8954 10 19 10C20.1046 10 21 10.8954 21 12Z" fill="#1C274C"/>
                                            </svg>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('info.add', $user->id) }}">Update</a></li>
                                                <li><a class="dropdown-item" href="{{ route('info.delete', $user->id) }}">Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
