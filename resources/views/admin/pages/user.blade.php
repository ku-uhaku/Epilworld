@extends('layouts.app')
@section('content')
@include('layouts.top-header', [
'title' => __('User'),
'class' => 'col-lg-7',
])


<div class="container-fluid mt--6 mb-5 only_search">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header border-0">
                    <span class="h3">{{ __('Users table') }}</span>
                    <button class="btn btn-primary addbtn float-right p-2 add_user" id="add_user"><i
                            class="fas fa-plus mr-1"></i>{{ __('Add New') }}</button>
                </div>

                <form action="{{ url('/admin/users') }}" method="post" class="ml-4" id="filter_revene_form">
                    @csrf
                    <div class="row rtl-date-filter-row">
                        <div class="form-group col-3">
                            <input type="text" id="filter_date" value="{{ $pass }}" name="filter_date"
                                class="form-control" placeholder="{{ __('-- Select Date --') }}">

                            @if ($errors->any())
                            <h4 class="text-center text-red mt-2">{{ $errors->first() }}</h4>
                            @endif
                        </div>
                        <div class="form-group col-3">
                            <button type="submit" id="filter_btn" class="btn btn-primary  rtl-date-filter-btn">{{
                                __('Apply') }}</button>
                        </div>
                    </div>
                </form>

                <!-- table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="dataTableUser" class="dataTableUser">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort">{{ __('#') }}</th>
                                <th scope="col" class="sort">{{ __('Image') }}</th>
                                <th scope="col" class="sort">{{ __('Name') }}</th>
                                <th scope="col" class="sort">{{ __('Phone') }}</th>
                                <th scope="col" class="sort">{{ __('Email') }}</th>

                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($users as $key => $user)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>
                                    <img alt="Image placeholder" class="tableimage rounded"
                                        src="{{ asset('storage/images/users/' . $user->image) }}">
                                </td>
                                <td>
                                    <a href="{{ url('admin/booking/') }}?user_name={{ $user->id }}">{{ $user->name }}{{
                                        $user->prenom }}</a>
                                </td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>

                                <td class="table-actions">
                                    @php
                                    $base_url = url('/');
                                    @endphp
                                    <a href="{{ url('admin/users/' . $user->id) }}" class="table-action text-warning"
                                        data-toggle="tooltip" data-original-title="{{ __('View client') }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    {{-- edit --}}
                                    <button class="btn-white btn shadow-none p-0 m-0 table-action text-primary bg-white"
                                        onclick="edit_user({{ $user->id }},'{{ $base_url }}','users')"
                                        data-toggle="tooltip" data-original-title="
                                                   
                                                    Modifier l'utilisateur
                                                ">
                                        <i class="fas fa-edit"></i>
                                    </button>




                                    <a class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white"
                                        href="{{ url('admin/payment/show', ['id' => $user->id]) }}"
                                        data-toggle="tooltip" data-original-title="
                                                    Voire les paiements
                                                ">
                                        <i class="fas fa-coins text-purple"></i>
                                    </a>

                                    <button class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white"
                                        onclick="deleteData('admin/users',{{ $user->id }},'{{ $base_url }}')"
                                        data-toggle="tooltip" data-original-title="
                                                    Supprimer l'utilisateur
                                                ">
                                        <i class="fas fa-trash"></i>
                                    </button>


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
@include('admin.users.edit')
@include('admin.users.create')
@endsection