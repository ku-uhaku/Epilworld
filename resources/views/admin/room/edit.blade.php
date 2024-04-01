@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => __('Edit'),
        'headerData' => __('Room'),
        'url' => 'admin/room',
        'class' => 'col-lg-7',
    ])



    <div class="container-fluid mt--6 mb-5">
        <div class="row">


            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header border-0">
                        <h3>{{ __('Edit Room') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="nav-wrapper rtl-icon">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab"
                                        href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1"
                                        aria-selected="true"><i class="ni ni-single-02 mr-2"></i>{{ __('Room') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab"
                                        href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2"
                                        aria-selected="false"><i
                                            class="ni ni-time-alarm mr-2"></i>{{ __('Room Timing') }}</a>
                                </li>
                            </ul>
                        </div>
                        <form class="form-horizontal form" action="{{ url('/admin/room/update/' . $room->room_id) }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card shadow">
                                <div class="my-0 mx-auto w-75">
                                    <div class="card-body">
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                                                aria-labelledby="tabs-icons-text-1-tab">
                                                <div class="p-20">



                                                    {{-- name --}}
                                                    <div class="form-group">
                                                        <label class="form-control-label"
                                                            for="name">{{ __('Name') }}</label>
                                                        <input type="text" value="{{ old('name', $room->name) }}"
                                                            name="name" id="name" class="form-control"
                                                            placeholder="{{ __('Salon Name') }}" autofocus>
                                                        @error('name')
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>



                                                    {{-- Services --}}
                                                    <div class="form-group">
                                                        <label class="form-control-label">{{ __('Services') }}</label>
                                                        <select class="form-control select2" multiple="multiple"
                                                            name="services[]" id="services"
                                                            dir="{{ session()->has('direction') && session('direction') == 'rtl' ? 'rtl' : '' }}">
                                                            @foreach ($services as $service)
                                                                <option value="{{ $service->service_id }}"
                                                                    {{ collect(old('services'))->contains($service->section_id) ? 'selected' : '' }}
                                                                    <?php if (in_array($service->service_id, json_decode($room->service_id))) {
                                                                        echo 'selected';
                                                                    } ?>>{{ $service->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('services')
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel"
                                                aria-labelledby="tabs-icons-text-2-tab">
                                                <div class="p-20">
                                                    {{-- Sunday --}}
                                                    <label for="phone"
                                                        class="form-control-label">{{ __('Sunday') }}</label>
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        value="{{ $salon->sunday['open'] == null ? 'Day Off' : old('sunopen', Carbon\Carbon::parse($room->sunday['open'])->format('h:i A')) }}"
                                                                        onclick="salonTimeSunOpen('sun','{{ Carbon\Carbon::parse($salon->sunday['open'])->format('h:i A') }}','{{ Carbon\Carbon::parse($salon->sunday['close'])->format('h:i A') }}')"
                                                                        class="form-control w-75 day-section-sunopen-emp"
                                                                        name="sunopen" id="open"
                                                                        placeholder="{{ __('Opening Time') }}"
                                                                        {{ $salon->sunday['open'] == null && $salon->sunday['close'] == null ? 'disabled' : '' }}
                                                                        {{ $salon->sunday['open'] != null && $salon->sunday['close'] != null ? 'required' : '' }}
                                                                        ?>
                                                                </div>
                                                                @error('sunopen')
                                                                    <div class="invalid-div">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        value="{{ $salon->sunday['open'] == null ? 'Day Off' : old('sunclose', Carbon\Carbon::parse($room->sunday['close'])->format('h:i A')) }}"
                                                                        onclick="salonTimeSunClose('sun','{{ Carbon\Carbon::parse($salon->sunday['open'])->format('h:i A') }}','{{ Carbon\Carbon::parse($salon->sunday['close'])->format('h:i A') }}')"
                                                                        class="form-control w-75 day-section-sunclose-emp"
                                                                        name="sunclose" id="close"
                                                                        placeholder="{{ __('Closing Time') }}"
                                                                        {{ $salon->sunday['open'] == null && $salon->sunday['close'] == null ? 'disabled' : '' }}
                                                                        {{ $salon->sunday['open'] != null && $salon->sunday['close'] != null ? 'required' : '' }} />
                                                                </div>
                                                                @error('sunclose')
                                                                    <div class="invalid-div">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- Monday --}}
                                                    <label for="phone"
                                                        class="form-control-label">{{ __('Monday') }}</label>
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        value="{{ $salon->monday['open'] == null ? 'Day Off' : old('monopen', Carbon\Carbon::parse($room->monday['open'])->format('h:i A')) }}"
                                                                        onclick="salonTimeMonOpen('mon','{{ Carbon\Carbon::parse($salon->monday['open'])->format('h:i A') }}','{{ Carbon\Carbon::parse($salon->monday['close'])->format('h:i A') }}')"
                                                                        class="form-control w-75 day-section-monopen-emp"
                                                                        name="monopen" id="open"
                                                                        placeholder="{{ __('Opening Time') }}"
                                                                        {{ $salon->monday['open'] == null && $salon->monday['close'] == null ? 'disabled' : '' }}
                                                                        {{ $salon->monday['open'] != null && $salon->monday['close'] != null ? 'required' : '' }} />
                                                                </div>
                                                                @error('monopen')
                                                                    <div class="invalid-div">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        value="{{ $salon->monday['close'] == null ? 'Day Off' : old('monclose', Carbon\Carbon::parse($room->monday['close'])->format('h:i A')) }}"
                                                                        onclick="salonTimeMonClose('mon','{{ Carbon\Carbon::parse($salon->monday['open'])->format('h:i A') }}','{{ Carbon\Carbon::parse($salon->monday['close'])->format('h:i A') }}')"
                                                                        class="form-control w-75 day-section-monclose-emp"
                                                                        name="monclose" id="close"
                                                                        placeholder="{{ __('Closing Time') }}"
                                                                        {{ $salon->monday['close'] == null && $salon->monday['close'] == null ? 'disabled' : '' }}
                                                                        {{ $salon->monday['open'] != null && $salon->monday['close'] != null ? 'required' : '' }} />
                                                                </div>
                                                                @error('monclose')
                                                                    <div class="invalid-div">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>


                                                    {{-- Tuesday --}}
                                                    <label for="phone"
                                                        class="form-control-label">{{ __('Tuesday') }}</label>
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        value="{{ $salon->tuesday['open'] == null ? 'Day Off' : old('tueopen', Carbon\Carbon::parse($room->tuesday['open'])->format('h:i A')) }}"
                                                                        onclick="salonTimeTueOpen('tue','{{ Carbon\Carbon::parse($salon->tuesday['open'])->format('h:i A') }}','{{ Carbon\Carbon::parse($salon->tuesday['close'])->format('h:i A') }}')"
                                                                        class="form-control w-75  day-section-tueopen-emp"
                                                                        name="tueopen" id="open"
                                                                        placeholder="{{ __('Opening Time') }}"
                                                                        {{ $salon->tuesday['open'] == null && $salon->tuesday['close'] == null ? 'disabled' : '' }}
                                                                        {{ $salon->tuesday['open'] != null && $salon->tuesday['close'] != null ? 'required' : '' }} />
                                                                </div>
                                                                @error('tueopen')
                                                                    <div class="invalid-div">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    @php
                                                                        $tueCloseValue = $salon->tuesday['close'] == null ? 'Day Off' : Carbon\Carbon::parse($room->tuesday['close'])->format('h:i A') ?? '';
                                                                    @endphp
                                                                    <input type="text"
                                                                        value="{{ old('tueclose', $tueCloseValue) }}"
                                                                        onclick="salonTimeTueClose('tue','{{ Carbon\Carbon::parse($salon->tuesday['open'])->format('h:i A') }}','{{ Carbon\Carbon::parse($salon->tuesday['close'])->format('h:i A') }}')"
                                                                        class="form-control w-75 day-section-tueclose-emp"
                                                                        name="tueclose" id="close"
                                                                        placeholder="{{ __('Closing Time') }}"
                                                                        {{ $salon->tuesday['open'] == null && $salon->tuesday['close'] == null ? 'disabled' : '' }}
                                                                        {{ $salon->tuesday['open'] != null && $salon->tuesday['close'] != null ? 'required' : '' }} />
                                                                </div>
                                                                @error('tueclose')
                                                                    <div class="invalid-div">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>

                                                    {{-- Wednesday --}}
                                                    <label for="phone"
                                                        class="form-control-label">{{ __('Wednesday') }}</label>
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        value="{{ $salon->wednesday['open'] == null ? 'Day Off' : old('wedopen', Carbon\Carbon::parse($room->wednesday['open'])->format('h:i A')) }}"
                                                                        onclick="salonTimeWedOpen('wed','{{ Carbon\Carbon::parse($salon->wednesday['open'])->format('h:i A') }}','{{ Carbon\Carbon::parse($salon->wednesday['close'])->format('h:i A') }}')"
                                                                        class="form-control w-75 day-section-wedopen-emp"
                                                                        name="wedopen" id="open"
                                                                        placeholder="{{ __('Opening Time') }}"
                                                                        {{ $salon->wednesday['open'] == null && $salon->wednesday['close'] == null ? 'disabled' : '' }}
                                                                        {{ $salon->wednesday['open'] != null && $salon->wednesday['close'] != null ? 'required' : '' }} />
                                                                </div>
                                                                @error('wedopen')
                                                                    <div class="invalid-div">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        value="{{ $salon->wednesday['close'] == null ? 'Day Off' : old('wedclose', Carbon\Carbon::parse($room->wednesday['close'])->format('h:i A')) }}"
                                                                        onclick="salonTimeWedClose('wed','{{ Carbon\Carbon::parse($salon->wednesday['open'])->format('h:i A') }}','{{ Carbon\Carbon::parse($salon->wednesday['close'])->format('h:i A') }}')"
                                                                        class="form-control w-75 day-section-wedclose-emp"
                                                                        name="wedclose" id="close"
                                                                        placeholder="{{ __('Closing Time') }}"
                                                                        {{ $salon->wednesday['open'] == null && $salon->wednesday['close'] == null ? 'disabled' : '' }}
                                                                        {{ $salon->wednesday['open'] != null && $salon->wednesday['close'] != null ? 'required' : '' }} />
                                                                </div>
                                                                @error('wedclose')
                                                                    <div class="invalid-div">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- Thursday --}}
                                                    <label for="phone"
                                                        class="form-control-label">{{ __('Thursday') }}</label>
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        value="{{ $salon->thursday['open'] == null ? 'Day Off' : old('thuopen', Carbon\Carbon::parse($room->thursday['open'])->format('h:i A')) }}"
                                                                        onclick="salonTimeThuOpen('thu','{{ Carbon\Carbon::parse($salon->thursday['open'])->format('h:i A') }}','{{ Carbon\Carbon::parse($salon->thursday['close'])->format('h:i A') }}')"
                                                                        class="form-control w-75 day-section-thuopen-emp"
                                                                        name="thuopen" id="open"
                                                                        placeholder="{{ __('Opening Time') }}"
                                                                        {{ $salon->thursday['open'] == null && $salon->thursday['close'] == null ? 'disabled' : '' }}
                                                                        {{ $salon->thursday['open'] != null && $salon->thursday['close'] != null ? 'required' : '' }} />
                                                                </div>
                                                                @error('thuopen')
                                                                    <div class="invalid-div">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        value="{{ $salon->thursday['close'] == null ? 'Day Off' : old('thuclose', Carbon\Carbon::parse($room->thursday['close'])->format('h:i A')) }}"
                                                                        onclick="salonTimeThuClose('thu','{{ Carbon\Carbon::parse($salon->thursday['open'])->format('h:i A') }}','{{ Carbon\Carbon::parse($salon->thursday['close'])->format('h:i A') }}')"
                                                                        class="form-control w-75 day-section-thuclose-emp"
                                                                        name="thuclose" id="close"
                                                                        placeholder="{{ __('Closing Time') }}"
                                                                        {{ $salon->thursday['open'] == null && $salon->thursday['close'] == null ? 'disabled' : '' }}
                                                                        {{ $salon->thursday['open'] != null && $salon->thursday['close'] != null ? 'required' : '' }} />
                                                                </div>
                                                                @error('thuclose')
                                                                    <div class="invalid-div">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>


                                                    {{-- Friday --}}
                                                    <label for="phone"
                                                        class="form-control-label">{{ __('Friday') }}</label>
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        value="{{ $salon->friday['open'] == null ? 'Day Off' : old('friopen', Carbon\Carbon::parse($room->friday['open'])->format('h:i A')) }}"
                                                                        onclick="salonTimeFriOpen('fri','{{ Carbon\Carbon::parse($salon->friday['open'])->format('h:i A') }}','{{ Carbon\Carbon::parse($salon->friday['close'])->format('h:i A') }}')"
                                                                        class="form-control w-75 day-section-friopen-emp"
                                                                        name="friopen" id="open"
                                                                        placeholder="{{ __('Opening Time') }}"
                                                                        {{ $salon->friday['open'] == null && $salon->friday['close'] == null ? 'disabled' : '' }}
                                                                        {{ $salon->friday['open'] != null && $salon->friday['close'] != null ? 'required' : '' }} />
                                                                </div>
                                                                @error('friopen')
                                                                    <div class="invalid-div">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        value="{{ $salon->friday['close'] == null ? 'Day Off' : old('friclose', Carbon\Carbon::parse($room->friday['close'])->format('h:i A')) }}"
                                                                        onclick="salonTimeFriClose('fri','{{ Carbon\Carbon::parse($salon->friday['open'])->format('h:i A') }}','{{ Carbon\Carbon::parse($salon->friday['close'])->format('h:i A') }}')"
                                                                        class="form-control w-75 day-section-friclose-emp"
                                                                        name="friclose" id="close"
                                                                        placeholder="{{ __('Closing Time') }}"
                                                                        {{ $salon->friday['open'] == null && $salon->friday['close'] == null ? 'disabled' : '' }}
                                                                        {{ $salon->friday['open'] != null && $salon->friday['close'] != null ? 'required' : '' }} />
                                                                </div>
                                                                @error('friclose')
                                                                    <div class="invalid-div">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>


                                                    {{-- Saturday --}}
                                                    <label for="phone"
                                                        class="form-control-label">{{ __('Saturday') }}</label>
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        value="{{ $salon->saturday['open'] == null ? 'Day Off' : old('satopen', Carbon\Carbon::parse($room->saturday['open'])->format('h:i A')) }}"
                                                                        onclick="salonTimeSatOpen('sat','{{ Carbon\Carbon::parse($salon->saturday['open'])->format('h:i A') }}','{{ Carbon\Carbon::parse($salon->saturday['close'])->format('h:i A') }}')"
                                                                        class="form-control w-75 day-section-satopen-emp"
                                                                        name="satopen" id="open"
                                                                        placeholder="{{ __('Opening Time') }}"
                                                                        {{ $salon->saturday['open'] == null && $salon->saturday['close'] == null ? 'disabled' : '' }}
                                                                        {{ $salon->saturday['open'] != null && $salon->saturday['close'] != null ? 'required' : '' }} />
                                                                </div>
                                                                @error('satopen')
                                                                    <div class="invalid-div">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="text"
                                                                        value="{{ $salon->saturday['close'] == null ? 'Day Off' : old('satclose', Carbon\Carbon::parse($room->saturday['close'])->format('h:i A')) }}"
                                                                        onclick="salonTimeSatClose('sat','{{ Carbon\Carbon::parse($salon->saturday['open'])->format('h:i A') }}','{{ Carbon\Carbon::parse($salon->saturday['close'])->format('h:i A') }}')"
                                                                        class="form-control w-75 day-section-satclose-emp"
                                                                        name="satclose" id="close"
                                                                        placeholder="{{ __('Closing Time') }}"
                                                                        {{ $salon->saturday['open'] == null && $salon->saturday['close'] == null ? 'disabled' : '' }}
                                                                        {{ $salon->saturday['open'] != null && $salon->saturday['close'] != null ? 'required' : '' }} />
                                                                </div>
                                                                @error('satclose')
                                                                    <div class="invalid-div">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="border-top">
                                                <div class="card-body text-center  rtl-float-none">
                                                    <input type="submit" class="btn btn-primary  rtl-float-none"
                                                        value="{{ __('Save Changes') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
