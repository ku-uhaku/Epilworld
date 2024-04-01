@extends('layouts.app')
@section('content')

    @include('layouts.top-header', [
        'title' => __('Bill'),
        'class' => 'col-lg-7',
    ])

    <div class="container-fluid mt--6 mb-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="h3">{{ __('Bill table') }}</span>
                        <button class="btn btn-primary addbtn float-right p-2 add_bill" id="add_bill"><i
                                class="fas fa-plus mr-1"></i>{{ __('Add New') }}</button>
                    </div>
                    <!-- table -->
                    <form action="{{ url('/admin/bill') }}" method="get">
                        @csrf
                        <div class="row mx-2">
                            <div class="col-6">
                                <div class="d-flex">
                                    <div class="form-group">
                                        <input type="date" class="form-control" name="date">
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary rtl-date-filter-btn">
                                            <i class="fas fa-filter"></i>
                                            {{ __('Filter') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">{{ __('#') }}</th>
                                    <th scope="col" class="sort">{{ __('Name') }}</th>
                                    <th scope="col" class="sort">{{ __('Mode payment') }}</th>


                                    <th scope="col" class="sort">{{ __('Price') }}</th>
                                    <th scope="col" class="sort">{{ __('Tiers') }}</th>
                                    <th scope="col" class="sort">{{ __('Created by') }}</th>


                                    <th scope="col" class="sort">{{ __('Date') }}</th>


                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($bills) != 0)
                                    @foreach ($bills as $key => $bill)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $bill->name }}</td>
                                            <td>{{ $bill->mode_payment }}</td>
                                            <td>{{ $bill->price }}</td>
                                            <td>{{ $bill->tiers }}</td>
                                            <td>{{ $bill->created_by }}</td>

                                            <td>

                                                {{ date('d-m-Y', strtotime($bill->date)) }}
                                            </td>


                                            <?php
                                            $base_url = url('/');
                                            ?>


                                            <td class="table-actions">

                                                <a class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white"
                                                    onclick="editBill(
                                                        {{ $bill->id }},
                                                        '{{ $bill->name }}',
                                                        '{{ $bill->price }}',
                                                        '{{ $bill->date }}',
                                                        '{{ __($bill->mode_payment) }}',
                                                        '{{ $bill->ref_pay }}',
                                                        '{{ $bill->tiers }}',
                                                        '{{ $bill->note }}',
                                                          )">
                                                    <i class="fas fa-user-edit"></i></a>
                                                <button
                                                    class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white"
                                                    onclick="deleteData('admin/bill',{{ $bill->id }},'{{ $base_url }}')"
                                                    data-toggle="tooltip" data-original-title="{{ __('Delete Bill') }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="10" class="text-center">{{ __('No Bills') }}</th>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                        <div class="float-right  mr-4 mb-1">
                            {{ $bills->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.bill.create')
    @include('admin.bill.edit')

@endsection
