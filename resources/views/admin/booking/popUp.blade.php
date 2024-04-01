<div class="container-fluid sidebar_open @if ($errors->any()) show_sidebar_create @endif" id="popUp_sidebar">
    <div class="row position-relative">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{ __('Add Appointment') }} </span>
                    <button type="button" class="popUp_btn close">&times;</button>
                </div>

                <div class="my-0 ">


                    <form action="" id="popUp_form">
                        {{-- User --}}
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Client') }}</label>
                            <select class="form-control select2 check_userr" name="user_id" id="user_popUp"
                                dir="{{ session()->has('direction') && session('direction') == 'rtl' ? 'rtl' : '' }}">
                                <option disabled selected value> {{ __('-- Select Client --') }} </option>
                                @foreach ($users as $user)
                                <option value={{ $user->id }}>{{ $user->name }} {{ $user->prenom }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-div"><span class="user_id"></span></div>
                            <a id="remainingAmount" href="#" class="remaining-amount-link"></a>
                        </div>

                        {{-- Services --}}
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Services') }}</label>
                            <select class="form-control select2 service_class" name="service_id[]" id="service_popUp"
                                data-placeholder='{{ __(' -- Select Service --') }}' placeholder='{{ __(' -- Select
                                Service --') }}'
                                dir="{{ session()->has('direction') && session('direction') == 'rtl' ? 'rtl' : '' }}">
                                @foreach ($services as $service)
                                @if ($service->is_mini_service != 1)
                                <option value={{ $service->service_id }} data-time={{ $service->time }}
                                    data-price={{ $service->price }}
                                    data-category={{ $service->category->name }}>

                                    {{ $service->name }}({{ $service->price }}-
                                    {{ $service->time }}{{ __('Min') }} - {{ $service->category->name }}
                                    )

                                </option>
                                @endif
                                @endforeach
                            </select>
                            <div class="invalid-div"><span class="service_id"></span></div>
                            <span id="total_timee">0 min</span>

                        </div>



                        <div class="form-group">
                            <label class="form-control-label" for="date">{{ __('Date') }}</label>
                            <input type="text" name="date" id="my_date" class="form-control select_date"
                                placeholder="{{ __('-- Select Date --') }}">
                            <div class="invalid-div"><span class="date"></span></div>
                        </div>


                        <input type="hidden" id="my_start_time">
                        <input type="hidden" id="my_emp_id">

                    </form>

                    <div class="text-center">
                        <button type="button" id="popUP_btn" class="btn btn-primary rtl-float-none mt-4 mb-5">{{
                            __('Book Appointment') }}</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        // Update total time when a service is selected or deselected
        $('#service_popUp').on('change', function() {
            // Initialize total time
            var totalTime = 0;

            // Loop through selected options and calculate total time
            $('#service_popUp option:selected').each(function() {
                var serviceTime = parseFloat($(this).data('time'));
                if (!isNaN(serviceTime)) {
                    totalTime += serviceTime;
                }
            });

            //second to mi
            totalTime = secondsToHms(totalTime * 60);

            // Update the total time in the span element
            $('#total_timee').text(totalTime);
        });

        function secondsToHms(seconds) {
            let hours = Math.floor(seconds / 3600);
            let minutes = Math.floor((seconds % 3600) / 60);

            let hoursText = hours > 0 ? hours + 'H' : '';
            let minutesText = minutes > 0 ? minutes + 'min' : '';

            return hoursText + minutesText;
        }

        // $('#popUP_btn').click(function() {
        //     var user_id = $('#user_popUp').val();
        //     var services = $('#service_popUp').val();
        //     var service_id = services.join();
        //     var date = $('#my_date').val();
        //     var start_time = $('#my_start_time').val();
        //     var my_emp_id = $('#my_emp_id').val();

        //     add_new_booking_for_emp(user_id, service_id, date, start_time, my_emp_id)

        // });

        $('#popUP_btn').click(function() {
            var user_id = $('#user_popUp').val();
            var services = $('#service_popUp').val();
            var service_id = services;
            var date = $('#my_date').val();
            var start_time = $('#my_start_time').val();
            var my_emp_id = $('#my_emp_id').val();

            add_new_booking_for_emp(user_id, service_id, date, start_time, my_emp_id)

        });

        $('.check_userrr').on('change', function() {
            var selectedValue = $(this).val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': csrf
                },
                type: "POST",
                url: 'booking/checkuser',
                data: {
                    user_id: selectedValue,
                    _token: csrf
                },
                success: function(result) {
                    console.log(result)
                    if (result.success) {
                        var remainingAmount = result.data.remaining_amount_to_pay;
                        var id = result.data.id
                        $('#remainingAmountt').text('En instance: ' + remainingAmount +
                            ' DH');
                        $('#remainingAmountt').attr('href',
                            '{{ url('/admin/payment/show/') }}/' + id);


                        // Add your URL here
                    } else {
                        console.error(result.msg);
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        });


    });
</script>