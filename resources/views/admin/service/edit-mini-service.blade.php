<div class="container-fluid sidebar_open @if ($errors->any()) show_sidebar_create @endif"
    id="edit_mini-service_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{ __('Edit mini Service') }}</span>
                    <button type="button" class="edit_mini-service_close">&times;</button>
                </div>
                <form class="form-horizontal" id="edit_mini_service_form" method="post" enctype="multipart/form-data"
                    action="{{ url('/admin/serviceDetails/update') }}">
                    @csrf
                    <div class="my-0">
                        <input type="text" name="my_id">

                        <div class="form-group">
                            <label class="form-control-label" for="name">{{ __('Service Name') }}</label>
                            <input type="text" value="{{ old('name') }}" name="name" id="name"
                                class="form-control" placeholder="{{ __('Service Name') }}" autofocus>
                            <div class="invalid-div "><span class="name"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="image">{{ __('Image') }}</label><br>
                            <input type="file" value="{{ old('image') }}" name="image" id="image"
                                accept="image/*" onchange="loadFile(event)"><br>
                            <img id="output" class="mt-3 offer_size h-50 w-50">
                            <div class="invalid-div "><span class="image"></span></div>
                        </div>


                        <div class="form-group">
                            <label class="form-control-label" for="image">{{ __('Service For') }}</label><br>
                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" id="Male" name="gender" value="Male"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="Male">{{ __('Male') }}</label>
                            </div>
                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" id="Female" name="gender" value="Female"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="Female">{{ __('Female') }}</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="Both" name="gender" value="Both"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="Both">{{ __('Both') }}</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="price">{{ __('Service Price') }}</label>
                            <input type="text" value="{{ old('price') }}" name="price" id="price"
                                class="form-control" placeholder="{{ __('Service Price') }}">
                            <div class="invalid-div "><span class="price"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="time">{{ __('Service Time (Minutes)') }}</label>
                            <input type="text" value="{{ old('time') }}" name="time" id="time"
                                class="form-control" placeholder="{{ __('Service Time') }}">
                            <div class="invalid-div "><span class="time"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="service_id">{{ __('Select Category') }}</label>
                            <select class="form-control" name="service_id" value="{{ old('service_id') }}">
                                @foreach ($services as $service)
                                    @if ($service->price == 0)
                                        <option value="{{ $service->service_id }}">{{ $service->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <div class="invalid-div "><span class="cat_id"></span></div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="NBS">Nombre de séance</label>
                            <input type="text" value="{{ old('NBS') ? old('NBS') : 1 }}" name="NBS"
                                id="NBS" class="form-control" placeholder="Nombre de séance" autofocus>

                            <div class="invalid-div "><span class="NBS"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for=" ">Frequency</label>
                            <div class="d-flex gap-2">
                                <input type="text" value="{{ old('frequency_nb') ? old('frequency_nb') : 1 }}"
                                    name="frequency_nb" id="frequency_nb" class="form-control mr-1"
                                    placeholder="Frequency" autofocus>

                                <select name="frequency" class="form-control">
                                    <option value="Day">{{ __('Day') }}</option>
                                    <option value="Week">{{ __('Week') }}</option>
                                    <option value="Month">{{ __('Month') }}</option>
                                </select>
                            </div>
                            <div class="invalid-div "><span class="frequency"></span></div>
                        </div>



                        <div class="text-center">
                            <button type="submit" id="create_btn"
                                class="btn btn-primary mt-4 mb-5 rtl-float-none">{{ __('Edit') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
