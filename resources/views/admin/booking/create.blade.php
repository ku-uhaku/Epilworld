<div class="container-fluid sidebar_open @if ($errors->any()) show_sidebar_create @endif" id="add_appointment_sidebar">
    <div class="row position-relative">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{ __('Add Appointment') }} </span>
                    <button type="button" class="add_appointment close">&times;</button>
                </div>
                <form class="form-horizontal" id="create_appointment_form" method="post" enctype="multipart/form-data"
                    action="{{ url('/admin/booking/store') }}">
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
                            <select class="form-control select2 check_userr" name="user_id" id="services"
                                dir="{{ session()->has('direction') && session('direction') == 'rtl' ? 'rtl' : '' }}">
                                <option disabled selected value> {{ __('-- Select Client --') }} </option>
                                @foreach ($users as $user)
                                <option value={{ $user->id }}>{{ $user->name }} {{ $user->prenom }}</option>
                                @endforeach
                            </select>

                            <a id="remainingAmount" href="#" class="remaining-amount-link"></a>
                            <div class="invalid-div"><span class="user_id"></span></div>
                        </div>
                        {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#exampleModal">
                            Launch demo modal
                        </button> --}}



                        {{-- Services --}}
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Services') }}</label>
                            <select class="form-control select2 service_class" name="service_id[]" id="service_create"
                                data-placeholder='{{ __(' -- Select Service --') }}' placeholder='{{ __(' -- Select
                                Service --') }}'
                                dir="{{ session()->has('direction') && session('direction') == 'rtl' ? 'rtl' : '' }}">
                                <option value="" disabled selected>---</option>
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
                            <span id="total_time">0 min</span>
                            <!-- Button trigger modal -->


                            {{-- zone --}}
                            <div class="form-group zone mt-2" style="display: none">
                                <label class="form-control-label">{{ __('Zone') }}</label>
                                <select class="form-control select2 zone_id " multiple="multiple" name="zone_id[]"
                                    id="zone_create" data-placeholder='{{ __(' -- Select zone --') }}'
                                    placeholder='{{ __(' -- Select zone --') }}'
                                    dir="{{ session()->has('direction') && session('direction') == 'rtl' ? 'rtl' : '' }}">
                                    @foreach ($services as $service)
                                    @if ($service->is_mini_service == 1)
                                    <option value={{ $service->service_id }} data-time={{ $service->time }}
                                        data-price={{ $service->price }}
                                        data-category={{ $service->category->name }}>

                                        {{ $service->name }}({{ $service->price }}-
                                        {{ $service->time }}{{ __('Min') }} -
                                        {{ $service->category->name }}
                                        )

                                    </option>
                                    @endif
                                    @endforeach
                                </select>


                            </div>

                            <!-- Modal -->



                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="frequency_nb">Nombre de séance</label>
                            <input type="text" class="nbs form-control" name="nbs">
                        </div>
                        <div class="form-group">

                            <label class="form-control-label" for="frequency_nb">Fréquence</label>
                            <div class="d-flex gap-2">
                                <input type="text" value="{{ old('frequency_nb') }}" name="frequency_nb"
                                    id="frequency_nb" class="form-control mr-1 frequency_nb" placeholder="Frequency"
                                    autofocus>

                                <select name="frequency" class="form-control frequency">
                                    <option value="Day">{{ __('Day') }}</option>
                                    <option value="Week">{{ __('Week') }}</option>
                                    <option value="Month">{{ __('Month') }}</option>
                                </select>
                            </div>
                            <div class="invalid-div "><span class="frequency"></span></div>
                        </div>

                        {{-- Services --}}
                        {{-- <div class="form-group">
                            <label class="form-control-label">{{ __('Services') }}</label>
                            <select class="form-control select2 service_class" multiple="multiple" name="service_id[]"
                                id="service_create" data-placeholder='{{ __(' -- Select Service --') }}'
                                placeholder='{{ __(' -- Select Service --') }}'
                                dir="{{ session()->has('direction') && session('direction') == 'rtl' ? 'rtl' : '' }}">
                                @foreach ($services as $service)
                                <option value={{ $service->service_id }} data-time={{ $service->time }}>
                                    {{ $service->name }}({{ $service->price }}-
                                    {{ $service->time }}{{ __('Min') }} )
                                </option>
                                @endforeach
                            </select>
                            <div class="invalid-div"><span class="service_id"></span></div>
                            <span id="total_time">0 min</span>

                        </div> --}}


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
                            <button type="submit" {{-- onclick="all_create('create_appointment_form','booking')" --}}
                                id="create_btn" class="btn btn-primary rtl-float-none mt-4 mb-5">{{ __('Book
                                Appointment') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="create_my_user_form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="my_user_name">{{ __('User Name') }}</label>
                            <input type="text" name="name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="my_phone">{{ __('Phone') }}</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" onclick="create_my_user('create_my_user_form','users')"
                            class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div> --}}
</div>


<script>
    $(document).ready(function() {
        var totalTime = 0;
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
            if (totalTime > 0) {
                totalTime = totalTime * 60;
            } else {
                totalTime = 0;
            }




            // Update the total time in the span element
            $('#total_time').text(secondsToHms(totalTime));
        });

        $('.zone_id').on('change', function() {
            // Initialize total time
            var totalTime = 0;

            // Loop through selected options and calculate total time
            $('.zone_id option:selected').each(function() {

                var serviceTime = parseFloat($(this).data('time'));


                if (!isNaN(serviceTime)) {
                    totalTime += serviceTime;
                }
            });


            //second to mi
            if (totalTime > 0) {
                totalTime = totalTime * 60;
            } else {
                totalTime = 0;
            }

            $('#total_time').text(secondsToHms(totalTime));



            // Update the total time in the span element
        });


        function secondsToHms(seconds) {
            let hours = Math.floor(seconds / 3600);
            let minutes = Math.floor((seconds % 3600) / 60);

            let hoursText = hours > 0 ? hours + 'H' : '';
            let minutesText = minutes > 0 ? minutes + 'min' : '';

            return hoursText + minutesText;
        }



        $('.check_userr').on('change', function() {
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

                    if (result.success) {
                        var remainingAmount = result.data
                            .remaining_amount_to_pay;
                        var id = result.data.id
                        $('.remaining-amount-link').text('En instance: ' +
                            remainingAmount + ' DH');
                        $('.remaining-amount-link').attr('href',
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