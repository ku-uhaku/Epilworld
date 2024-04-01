@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => __('Room'),
        'class' => 'col-lg-7',
    ])

    <div class="container-fluid mt--6 mb-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <span class="h3">{{ __('Room table') }}</span>
                        <div class="">
                            <a class="btn btn-primary addbtn float-right p-2 add_room" id="add_room"
                                href="{{ url('admin/room/create') }}"><i
                                    class="fas fa-plus mr-1"></i>{{ __('Add room') }}</a>
                        </div>
                    </div>
                    <!-- table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort">{{ __('#') }}</th>
                                    <th scope="col" class="sort">{{ __('Name') }}</th>
                                    <th scope="col" class="sort">{{ __('Service') }}</th>
                                    <th scope="col" class="sort">{{ __('Status') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @if (count($rooms) != 0)
                                    @foreach ($rooms as $key => $room)
                                        <tr>
                                            <th>{{ $rooms->firstItem() + $key }}</th>

                                            <td>{{ $room->name }}</td>
                                            <td>
                                                <div class="avatar-group">
                                                    @php $count = 0; @endphp
                                                    @foreach ($room->services as $service)
                                                        @if ($count < 10)
                                                            <a href="#" class="avatar avatar-sm rounded-circle"
                                                                data-toggle="tooltip"
                                                                data-original-title="{{ $service->name }}">
                                                                <img alt="service" class="service_icon"
                                                                    src="{{ asset('storage/images/services/' . $service->image) }}">
                                                            </a>
                                                        @else
                                                            @php $remainingCount = count($room->services) - 10; @endphp
                                                            <span class="avatar avatar-sm rounded-circle"
                                                                data-toggle="tooltip"
                                                                data-original-title="And {{ $remainingCount }} more">
                                                                <!-- You can customize the 'And x more' message as needed -->
                                                                <span>+{{ $remainingCount }}</span>
                                                            </span>
                                                        @break
                                                    @endif
                                                    @php $count++; @endphp
                                                @endforeach
                                            </div>

                                        </td>
                                        <td>
                                            <label class="custom-toggle">
                                                <input type="checkbox" onchange="hideEmp({{ $room->room_id }})"
                                                    {{ $room->status == 0 ? 'checked' : '' }}>
                                                <span class="custom-toggle-slider rounded-circle" data-label-off="No"
                                                    data-label-on="Hide"></span>
                                            </label>
                                        </td>
                                        <td class="table-actions">
                                            @php
                                                $base_url = url('/');
                                            @endphp

                                            <a href="{{ url('admin/room/edit/' . $room->room_id) }}"
                                                class="table-action text-info" data-toggle="tooltip"
                                                data-original-title="
                                                        Modifier la salle
                                                    ">
                                                <i class="fas fa-user-edit"></i>
                                            </a>
                                            <form action="{{ url('admin/room/delete/' . $room->room_id) }}"
                                                method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="table-action text-danger bg-white border-0 cursor-pointer
                                                    "
                                                    data-toggle="tooltip"
                                                    data-original-title="
                                                            Supprimer la salle
                                                        ">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tr>
                            @else
                                <tr>
                                    <th colspan="10" class="text-center">{{ __('No rooms') }}</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="float-right mr-4 mb-1">
                        {{ $rooms->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
