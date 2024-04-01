@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => __('Paramétrage des services'),
        'class' => 'col-lg-7',
    ])

    <div class="container-fluid mt--6">
        <div class="row mb-5">
            <div class="col">
                <div class="card pb-4">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="h3">Tableau des Paramétrage zone</span>
                        <div class="">
                            <button class="btn btn-primary addbtn float-right p-2 add_user" id="add_parametrageService"><i
                                    class="fas fa-plus mr-1"></i>{{ __('Add New') }}</button>
                        </div>
                    </div>



                    <div class="card shadow">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort">{{ __('#') }}</th>
                                        <th scope="col" class="sort">{{ __('Name') }}</th>
                                        <th scope="col" class="sort">{{ __('Energie') }}</th>
                                        <th scope="col" class="sort">{{ __('Frequence') }}</th>
                                        <th scope="col" class="sort">{{ __('Refoidissement') }}</th>
                                        <th scope="col" class="sort">{{ __('Gender') }}</th>
                                        <th scope="col" class="sort">{{ __('Service') }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @if (count($parametrageServices) != 0)
                                        @foreach ($parametrageServices as $key => $parametrageService)
                                            <tr>
                                                <th>{{ $key + 1 }}</th>
                                                <td>{{ $parametrageService->name }}</td>
                                                <td>{{ $parametrageService->energie }}</td>
                                                <td>{{ $parametrageService->frequence }}</td>
                                                <td>{{ $parametrageService->refoidissement }}</td>
                                                <td>
                                                    @if ($parametrageService->gender == 0)
                                                        {{ __('Femme') }}
                                                    @else
                                                        {{ __('Homme') }}
                                                    @endif
                                                </td>
                                                <td>{{ $parametrageService->service_name }}</td>

                                                <td class="table-actions">
                                                    <?php
                                                    $base_url = url('/');
                                                    ?>
                                                    <button
                                                        class="btn-white btn shadow-none p-0 m-0 table-action text-primary bg-white"
                                                        onclick="edit_userSerivce({{ $parametrageService->id }},'{{ $parametrageService->name }}','{{ $parametrageService->energie }}','{{ $parametrageService->frequence }}', '{{ $parametrageService->refoidissement }}', '{{ $parametrageService->gender }}', '{{ $parametrageService->service_name }}')"
                                                        data-toggle="tooltip"
                                                        data-original-title="
                                                       
                                                        Modifier l'utilisateur
                                                    ">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button
                                                        class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white"
                                                        onclick="deleteData('admin/parametrage/user_service',{{ $parametrageService->id }},'{{ $base_url }}')"
                                                        data-toggle="tooltip"
                                                        data-original-title="{{ __('Delete Service') }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center">Aucun parametrageService trouvé</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.parametageServices.create')
        @include('admin.parametageServices.edit')
    @endsection
