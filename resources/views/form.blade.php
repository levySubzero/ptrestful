@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if(isset($user))
                    <div class="card-header">{{ __('Update User Information') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('info.update', $user->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" required autocomplete="last_name" autofocus>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="age" class="col-md-4 col-form-label text-md-end">{{ __('Age') }}</label>

                                <div class="col-md-6">
                                    <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ $user->age }}" required autocomplete="age">

                                    @error('Age')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="town" class="col-md-4 col-form-label text-md-end">{{ __('Town') }}</label>

                                <div class="col-md-6">
                                    <input id="town" type="text" class="form-control @error('town') is-invalid @enderror" name="town" value="{{ $user->town }}" required autocomplete="town" autofocus>

                                    @error('town')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="town" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                                <select class="form-select form-select-lg mb-3" name="gender" aria-label=".form-select-lg example">
                                    <option {{ is_null($user->gender) ? 'selected' : '' }}>Select Gender</option>
                                    <option value="M" {{ $user->gender == "M" ? 'selected' : '' }}>Male</option>
                                    <option value="F" {{ $user->gender == "F" ? 'selected' : '' }}>Female</option>
                                    <option value="NA" {{ $user->gender == "NA" ? 'selected' : '' }}>Prefer not to say</option>
                                </select>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="card-header">{{ __('Add User Information') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('info.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="" required autocomplete="last_name" autofocus>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="age" class="col-md-4 col-form-label text-md-end">{{ __('Age') }}</label>

                                <div class="col-md-6">
                                    <input id="age" type="number" class="form-control @error('age') is-invalid @enderror" name="age" value="" required autocomplete="age">

                                    @error('Age')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="town" class="col-md-4 col-form-label text-md-end">{{ __('Town') }}</label>

                                <div class="col-md-6">
                                    <input id="town" type="text" class="form-control @error('town') is-invalid @enderror" name="town" value="" required autocomplete="town" autofocus>

                                    @error('town')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="gender" class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                                <select class="form-select form-select-lg mb-3" name="gender" aria-label=".form-select-lg example">
                                    <option selected>Select Gender</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                    <option value="NA">Prefer not to say</option>
                                </select>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
