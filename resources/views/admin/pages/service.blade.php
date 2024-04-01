@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => __('Service'),
        'class' => 'col-lg-7',
    ])

    <div class="container-fluid mt--6 mb-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="h3">{{ __('Services table') }}</span>
                        <button class="btn btn-primary addbtn float-right p-2 add_service" id="add_service"><i
                                class="fas fa-plus mr-1"></i>{{ __('Add New') }}</button>

                    </div>
                    <form action="{{ url('/admin/services') }}" method="get" class="col-5 mb-3">
                        <div class="row ml-3">
                            @csrf


                            <select name="cat" class="form-control mr-2 col-4">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->cat_id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary btn-md col-2">
                                {{ __('Filter') }}
                            </button>

                            {{-- clear filter --}}
                            <a href="{{ url('/') }}/admin/services" class="btn btn-primary rtl-date-filter-btn">
                                <i class="fas fa-filter-slash"></i>
                                {{ __('Clear Filter') }}
                            </a>
                        </div>
                    </form>

                    <!-- table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">{{ __('#') }}</th>
                                    <th scope="col" class="sort">{{ __('Image') }}</th>
                                    <th scope="col" class="sort">{{ __('Name') }}</th>
                                    <th scope="col" class="sort">{{ __('Category') }}</th>
                                    <th scope="col" class="sort">{{ __('Time') }}</th>
                                    <th scope="col" class="sort">Nombre de séance</th>
                                    <th scope="col" class="sort">{{ __('Price') }}</th>
                                    <th scope="col" class="sort">{{ __('Status') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($services) != 0)
                                    @foreach ($services as $key => $service)
                                        <tr>
                                            <th>{{ $services->firstItem() + $key }}</th>
                                            <td>
                                                <img src="{{ asset('storage/images/services/' . $service->image) }}"
                                                    class="tableimage rounded">
                                            </td>
                                            <td>{{ $service->name }}</td>
                                            <td>{{ $service->category->name }}</td>
                                            <td>{{ $service->time }} {{ __('Min') }}</td>
                                            <td>{{ $service->NBS }}</td>
                                            <td>{{ $service->price }}{{ $symbol }}</td>
                                            <td>
                                                <label class="custom-toggle">
                                                    <input type="checkbox"
                                                        onchange="hideService({{ $service->service_id }})"
                                                        {{ $service->status == 0 ? 'checked' : '' }}>
                                                    <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                        data-label-on="Hide"></span>
                                                </label>
                                            </td>
                                            <td class="table-actions">
                                                @php
                                                    $base_url = url('/');
                                                @endphp
                                                <button
                                                    class="btn-white btn shadow-none p-0 m-0 table-action text-warning bg-white"
                                                    onclick="show_service({{ $service->service_id }},'{{ $base_url }}')"
                                                    data-toggle="tooltip" data-original-title="{{ __('View Service') }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button
                                                    class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white"
                                                    onclick="edit_service({{ $service->service_id }},'{{ $base_url }}')"
                                                    data-toggle="tooltip" data-original-title="{{ __('Edit Service') }}">
                                                    <i class="fas fa-user-edit"></i>
                                                </button>
                                                <button
                                                    class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white"
                                                    onclick="deleteData('admin/services',{{ $service->service_id }},'{{ $base_url }}')"
                                                    data-toggle="tooltip" data-original-title="{{ __('Delete Service') }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                                @if ($service->price == 0)
                                                    <button type="button"
                                                        class="btn-white btn shadow-none p-0 m-0 table-action text-success bg-white add_mini_service"
                                                        data-toggle="modal" data-target="#eyemodal"
                                                        data-service_id="{{ $service->service_id }}"
                                                        data-original-title="{{ __('Cancel Payment') }}">
                                                        <i class="fas fa-list"></i>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="11" class="text-center">{{ __('No Services') }}</th>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                        <div class="float-right mr-4 mb-1">
                            {{ $services->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="eyemodal" tabindex="-1" role="dialog" aria-labelledby="eyemodalLabel" aria-hidden="true">
        <div class="modal-dialog " style="min-width: 900px" role="document">
            <div class="modal-content">
                <div class="p-2">
                    <h5 class="modal-title" id="eyemodalLabel">{{ __('Show Details') }}</h5>

                </div>
                <input type="hidden" class="my_key">

                <div class="p-2">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <button class=" btn btn-primary addbtn float-right p-2 add_mini-service " id="add_mini-service"
                                data-dismiss="modal" aria-label="Close"><i class="fas fa-plus mr-1"></i>{{ __('Add New') }}
                            </button>
                        </div>
                    </div>
                    <table class="table table-responcive">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('Name') }}</th>

                                <th>{{ __('Time') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (count($services) != 0)
                                @foreach ($services as $key => $service)
                                    @if ($service->price == 0)
                                        <tr>
                                            <th>{{ $services->firstItem() + $key }}</th>
                                            <td>{{ $service->name }}</td>

                                            <td>{{ $service->time }} {{ __('Min') }}</td>
                                            <td>{{ $service->price }}{{ $symbol }}</td>

                                            <td class="table-actions">

                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="11" class="text-center">{{ __('No Services') }}</th>
                                </tr>
                            @endif


                        </tbody>
                    </table>


                </div>

            </div>



        </div>
    </div>



    @include('admin.service.create-mini-service')

    @include('admin.service.edit-mini-service')
    @include('admin.service.create')
    @include('admin.service.show')
    @include('admin.service.edit')

    <script>
        $('.add_mini_service').click(function() {
            // Retrieve the value of data-service_id attribute
            var serviceId = $(this).data('service_id');



            //send request ajax
            $.ajax({
                url: "{{ url('/admin/serviceDetails/index') }}",
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': csrf
                },
                data: {
                    serviceId: serviceId

                },
                success: function(data) {
                    console.log(data);
                    var html = '';
                    for (var i = 0; i < data.data.length; i++) {

                        html += '<tr>';
                        html += '<td>' + (i + 1) + '</td>';
                        html += '<td>' + data.data[i].name + '</td>';

                        html += '<td>' + data.data[i].time + ' Min</td>';
                        html += '<td>' + data.data[i].price + ' {{ $symbol }}</td>';
                        html += '<td class="table-actions">';
                        html +=
                            '<button type="button" class="btn-white btn shadow-none p-0 m-0 table-action text-info bg-white edit_mini_services" onclick="edit_mini_service(' +
                            data.data[i].id + ', \'' + '{{ url('/') }}' +
                            '\')" ><i class="fas fa-user-edit"></i></button>';


                        html += '<form id="deleteForm" action="{!! url('admin/serviceDetails/delete') !!}/' +
                            data.data[i].id + '" method="POST" style="display: inline;">' +
                            '@csrf ' +
                            '<input type="hidden" name="_method" value="DELETE">' +
                            '<button type="submit" class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white" data-toggle="tooltip" data-original-title="{{ __('Delete Service') }}"><i class="fas fa-trash"></i></button>' +
                            '</form>';


                        html += '</td>';
                        html += '</tr>';
                    }
                    $('#eyemodal tbody').html(html);
                }

            });
        });
    </script>
@endsection
