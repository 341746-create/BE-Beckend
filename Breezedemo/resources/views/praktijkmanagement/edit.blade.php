<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gebruikersrol wijzigen') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-4">{{ __('Wijzig rol voor') }} {{ $user->name }}</h5>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('praktijkmanagement.userroles.update', $user) }}">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3">
                                <label for="role" class="form-label">{{ __('Gebruikersrol') }}</label>
                                <select id="role" name="role" class="form-select">
                                    @foreach ($roles as $value => $label)
                                        <option value="{{ $value }}" {{ old('role', $user->role) === $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('praktijkmanagement.userroles') }}" class="btn btn-outline-secondary">{{ __('Annuleren') }}</a>
                                <button type="submit" class="btn btn-primary">{{ __('Opslaan') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
