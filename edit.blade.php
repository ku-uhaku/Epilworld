<div class="container-fluid sidebar_open @if ($errors->any()) show_sidebar_edit @endif"
    id="edit_appointment_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{ __('Edit Appointment') }}</span>
                    <button type="button" class="edit_appointment close">&times;</button>
                </div>
                <form class="form-horizontal" id="edit_appointment_form" method="post" enctype="multipart/form-data"
                    action="{{ url('admin/booking/upsdate') }}">

                    @csrf
                    <div class="my-0">

                        <div class="form-group d-none">
                            <label class="form-control-label" for="booking_id">{{ __('Booking id') }}</label>
                            <input type="text" name="booking_id" id="booking_id" class="form-control booking_id"
                                placeholder="Booking id" readonly>
                            <input type="text" name="id" class="id" id="id">
                        </div>

                        {{-- User --}}
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Client') }}</label>
                            <select class="form-control select2" name="user_id"
                                dir="{{ session()->has('direction') && session('direction') == 'rtl' ? 'rtl' : '' }}">
                                <option disabled selected value> {{ __('-- Select Client --') }} </option>
                                @foreach ($users as $user)
                                    <option value={{ $user->id }}>
                                        {{ $user->name }}</option>
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-div"><span class="user_id"></span></div>

                        </div>

                        {{-- Services --}}
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Services') }}</label>
                            <select class="form-control select2 service_class" multiple="multiple" name="service_id[]"
                                data-placeholder='{{ __('-- Select Service --') }}'
                                placeholder='{{ __('-- Select Service --') }}' id="service_id"
                                dir="{{ session()->has('direction') && session('direction') == 'rtl' ? 'rtl' : '' }}">
                                @foreach ($services as $service)
                                    <option value={{ $service->service_id }}>
                                        {{ $service->name }}({{ $service->price }}{{ $symbol }} -
                                        {{ $service->time }}{{ __('Min') }} )</option>
                                @endforeach
                            </select>
                            <div class="invalid-div"><span class="service_id"></span></div>

                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="date">{{ __('Date') }}</label>
                            <input type="text" name="date" id="date" class="form-control select_date"
                                placeholder="{{ __('-- Select Date --') }}">
                            <div class="invalid-div"><span class="date"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="start_time">{{ __('Time') }}</label>
                            <select class="form-control select2 start_time" name="start_time" id="start_time"
                                dir="{{ session()->has('direction') && session('direction') == 'rtl' ? 'rtl' : '' }}">
                                <option disabled selected> {{ __('-- Select Time --') }} </option>
                            </select>
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
                                <option value=""> {{ __('-- Select Room --') }} </option>
                            </select>
                            <div class="invalid-div"><span class=""></span></div>
                        </div>



                        {{-- Employees --}}
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Employee') }}</label>
                            <select class="form-control select2 emp_id" name="emp_id" id="emp_id"
                                dir="{{ session()->has('direction') && session('direction') == 'rtl' ? 'rtl' : '' }}">
                                <option value=""> {{ __('-- Select Employee --') }} </option>
                            </select>
                            <div class="invalid-div"><span class=""></span></div>
                        </div>




                        <div class="text-center">
                            <button type="button" onclick="all_edit('edit_appointment_form','booking')" id="create_btn"
                                class="btn btn-primary rtl-float-none mt-4 mb-5">{{ __('Book Appointment') }}</button>
                        </div>

                        <hr>
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Change the status') }}</label>
                            <select class="form-control my_status_payment_select" name="selector" id="selectorr"
                                onchange="changeStatuss(document.getElementById('id').value)">

                                <option value="Cancel" {{ $booking->booking_status == 'Cancel' ? 'selected' : '' }}>
                                    {{ __('Cancel') }}
                                </option>
                                <option value="Réservée"
                                    {{ $booking->booking_status == 'Réservée' ? 'selected' : '' }}>
                                    {{ __('Réservée') }}
                                </option>
                                <option value="in session"
                                    {{ $booking->booking_status == 'in session' ? 'selected' : '' }}>
                                    {{ __('in session') }}
                                </option>
                                <option value="Approved"
                                    {{ $booking->booking_status == 'Approved' ? 'selected' : '' }}>
                                    {{ __('Approved') }}</option>
                                <option value="Completed"
                                    {{ $booking->booking_status == 'Completed' ? 'selected' : '' }}>
                                    {{ __('Completed') }}</option>
                            </select>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.select2').select2({
            dir: "{{ session()->has('direction') && session('direction') == 'rtl' ? 'rtl' : '' }}",
            width: '100%'
        });
    });
</script>

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
