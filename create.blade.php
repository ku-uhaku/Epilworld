<div class="container-fluid sidebar_open @if ($errors->any()) show_sidebar_create @endif"
    id="add_appointment_sidebar">
    <div class="row position-relative">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{ __('Add Appointment') }} </span>
                    <button type="button" class="add_appointment close">&times;</button>
                </div>
                <form class="form-horizontal" id="create_appointment_form" method="post" enctype="multipart/form-data"
                    action="{{ url('/admin/booking/create') }}">
                    @csrf
                    <div class="my-0 ">

                        <?php
                        $id = rand(10000, 99999);
                        ?>

                        <div class="form-group d-none ">
                            <input type="text" name="booking_id" value="#{{ $id }}" id="booking_id"
                                class="form-control  col-10" placeholder="Booking id" readonly>
                        </div>

                        {{-- User --}}
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Client') }}</label>
                            <select class="form-control select2" name="user_id" id="services"
                                dir="{{ session()->has('direction') && session('direction') == 'rtl' ? 'rtl' : '' }}">
                                <option disabled selected value> {{ __('-- Select Client --') }} </option>
                                @foreach ($users as $user)
                                    <option value={{ $user->id }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-div"><span class="user_id"></span></div>
                        </div>

                        {{-- Services --}}
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Services') }}</label>
                            <select class="form-control select2 service_class" multiple="multiple" name="service_id[]"
                                id="service_create" data-placeholder='{{ __('-- Select Service --') }}'
                                placeholder='{{ __('-- Select Service --') }}'
                                dir="{{ session()->has('direction') && session('direction') == 'rtl' ? 'rtl' : '' }}">
                                @foreach ($services as $service)
                                    <option value={{ $service->service_id }} data-time={{ $service->time }}>
                                        {{ $service->name }}({{ $service->price }}{{ $symbol }} -
                                        {{ $service->time }}{{ __('Min') }} )
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-div"><span class="service_id"></span></div>
                            <span id="total_time">0 min</span>

                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="date">{{ __('Date') }}</label>
                            <input type="text" name="date" id="date" class="form-control select_date"
                                placeholder="{{ __('-- Select Date --') }}">
                            <div class="invalid-div"><span class="date"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="start_time">{{ __('Time') }}</label>
                            <div class="d-flex ">
                                <select class="form-control select2 start_time " name="start_time"
                                    dir="{{ session()->has('direction') && session('direction') == 'rtl' ? 'rtl' : '' }}">
                                    <option disabled selected> {{ __('-- Select Time --') }} </option>
                                </select>
                            </div>
                            <div class="invalid-div"><span class=""></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="payment">{{ __('Payment') }}</label>
                            <input type="text" name="payment" id="payment" class="form-control"
                                placeholder="{{ __('Payment') }}">
                            <div class="invalid-div"><span class="payment"></span></div>
                        </div>
                        {{-- rooms --}}
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Room') }}</label>
                            <select class="form-control select2 room_id" name="room_id" id="room_id"
                                dir="{{ session()->has('direction') && session('direction') == 'rtl' ? 'rtl' : '' }}">
                                <option disabled selected> {{ __('-- Select Room --') }} </option>
                            </select>
                            <div class="invalid-div"><span class=""></span></div>
                        </div>
                        {{-- Employees --}} <div class="form-group">
                            <label class="form-control-label">{{ __('Employee') }}</label>
                            <select class="form-control select2 emp_id" name="emp_id" id="emp_id"
                                dir="{{ session()->has('direction') && session('direction') == 'rtl' ? 'rtl' : '' }}">
                                <option disabled selected> {{ __('-- Select Employee --') }} </option>
                            </select>
                            <div class="invalid-div"><span class=""></span></div>
                        </div>
                        <div class="text-center">
                            <button type="button" onclick="all_create('create_appointment_form','booking')"
                                id="create_btn"
                                class="btn btn-primary rtl-float-none mt-4 mb-5">{{ __('Book Appointment') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // Update total time when a service is selected or deselected
        $('#service_create').on('change', function() {
            // Initialize total time
            var totalTime = 0;

            // Loop through selected options and calculate total time
            $('#service_create option:selected').each(function() {
                var serviceTime = parseFloat($(this).data('time'));
                if (!isNaN(serviceTime)) {
                    totalTime += serviceTime;
                }
            });

            //second to mi
            totalTime = secondsToHms(totalTime * 60);

            // Update the total time in the span element
            $('#total_time').text(totalTime);
        });

        function secondsToHms(seconds) {
            let hours = Math.floor(seconds / 3600);
            let minutes = Math.floor((seconds % 3600) / 60);

            let hoursText = hours > 0 ? hours + 'H' : '';
            let minutesText = minutes > 0 ? minutes + 'min' : '';

            return hoursText + minutesText;
        }

    });
</script>
