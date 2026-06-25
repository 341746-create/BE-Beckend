<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gebruiker details') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-0 pt-4 pb-0">
                        <h5 class="card-title mb-0 fw-bold text-dark">{{ __('Details van') }} {{ $user->name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <table class="table table-borderless align-middle">
                                <tbody>
                                    <tr>
                                        <td class="text-muted w-25">{{ __('ID') }}</td>
                                        <td class="fw-bold">{{ $user->id }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">{{ __('Naam') }}</td>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">{{ __('Email') }}</td>
                                        <td><a href="mailto:{{ $user->email }}" class="text-primary text-decoration-none">{{ $user->email }}</a></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">{{ __('Rol') }}</td>
                                        <td>
                                            <span class="badge bg-info text-white px-3 py-2 rounded-pill fs-7">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @if($user->created_at)
                                        <tr>
                                            <td class="text-muted">{{ __('Geregistreerd') }}</td>
                                            <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('praktijkmanagement.userroles') }}" class="btn btn-secondary px-4">{{ __('Terug naar overzicht') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
