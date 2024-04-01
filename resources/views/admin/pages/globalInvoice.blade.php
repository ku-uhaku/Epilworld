@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => __('Global facture'),
        'class' => 'col-lg-7',
    ])

    <div class="container-fluid mt--6 mb-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="h3">{{ __('Global facture') }}</span>
                    </div>
                    <!-- table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">{{ __('#') }}</th>
                                    <th scope="col" class="sort">{{ __('User Name') }}</th>
                                    <th scope="col" class="sort">{{ __('Created_at') }}</th>

                                    <th></th>
                                </tr>
                            </thead>

                            <tbody class="list">
                                @if (count($invoices) != 0)
                                    @foreach ($invoices as $key => $invoice)
                                        <tr>
                                            <th>{{ $invoices->firstItem() + $key }}</th>
                                            <td>{{ $invoice->user->name }}</td>
                                            <td>{{ $invoice->created_at }}</td>

                                            <td class="table-actions">
                                                @php
                                                    $base_url = url('/');
                                                @endphp
                                                <a class="btn-white btn shadow-none p-0 m-0 table-action text-warning bg-white"
                                                    href="{{ $base_url . '/admin/global_invoice/show/' . $invoice->id }}"
                                                    data-toggle="tooltip" data-original-title="{{ __('View Invoice') }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>

                                                {{-- edit invoice --}}

                                                <button
                                                    class="btn-white btn shadow-none p-0 m-0 table-action text-primary bg-white"
                                                    href="" data-toggle="tooltip"
                                                    onclick="editGlobalInvoice('{{ $invoice->id }}')"
                                                    data-original-title="{{ __('Edit') }}">
                                                    <i class="fas fa-edit"></i>
                                                </button>

                                                <form action="{{ url('/admin/globalInvoice/delete/' . $invoice->id) }}"
                                                    method="post" class="d-inline-block">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white">
                                                        <i class="fas fa-trash-alt" data-toggle="tooltip"
                                                            data-original-title="{{ __('Delete') }}"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">
                                            <h3 class="text-center">{{ __('No Global Invoice Found') }}</h3>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>




                        </table>
                        <div class="float-right mr-4 mb-1">
                            {{ $invoices->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.booking.edit_global_invoice')
@endsection
