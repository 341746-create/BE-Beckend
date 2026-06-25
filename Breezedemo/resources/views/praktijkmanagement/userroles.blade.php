<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Praktijkmanagement Home') }}
        </h2>
    </x-slot>

    <div class="container py-5">


        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h5 class="mb-0">{{ __('Gebruikersrollen') }}</h5>
                                <small class="text-muted">{{ __('Ingelogde praktijkmanagement gebruiker ID:') }} {{ $praktijkmanagementId }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('Naam') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Gebruikersrol') }}</th>
                                        <th>{{ __('Verwijder') }}</th>
                                        <th>{{ __('Wijzig') }}</th>
                                        <th>{{ __('Details') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>
                                                @if ($user->id !== $praktijkmanagementId)
                                                    <form action="{{ route('praktijkmanagement.userroles.destroy', $user) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Weet je zeker dat je deze gebruiker wilt verwijderen?') }}')">{{ __('Verwijderen') }}</button>
                                                    </form>
                                                @else
                                                    <span class="text-muted">{{ __('Niet toegestaan') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->id !== $praktijkmanagementId)
                                                    <a href="{{ route('praktijkmanagement.userroles.edit', $user) }}" class="btn btn-sm btn-success">{{ __('Wijzig') }}</a>
                                                @else
                                                    <span class="text-muted">{{ __('Niet toegestaan') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('praktijkmanagement.userroles.show', $user) }}" class="btn btn-sm btn-warning">{{ __('Details') }}</a>
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
</x-app-layout>
