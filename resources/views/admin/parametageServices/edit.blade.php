<div class="container-fluid sidebar_open @if ($errors->any()) show_sidebar_edit @endif"
    id="edit_parametrageService_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{ __('Paramétrage zone') }}</span>
                    <button type="button" class="edit_parametrageService close">&times;</button>
                </div>
                <form class="form-horizontal" id="create_user_form" method="post" enctype="multipart/form-data"
                    action="{{ url('/admin/parametrage/user_service/update') }}">
                    @method('PUT')
                    @csrf

                    <input type="hidden" name="id">
                    <div class="my-0">
                        <div class="form-group">
                            <label class="form-control-label" for="name">{{ __('Name') }}</label>
                            <input type="text" name="name" value="{{ old('name') }}" id="name"
                                class="form-control" placeholder="" autofocus>
                            <div class="invalid-div "><span class="name"></span></div>
                        </div>

                        <div>
                            <label class="form-control-label" for="name">{{ __('Energie') }}</label>
                            <input type="text" name="energie" value="{{ old('energie') }}" id="energie"
                                class="form-control" placeholder="" autofocus>
                            <div class="invalid-div "><span class="energie"></span></div>
                        </div>

                        <div>
                            <label class="form-control-label" for="name">{{ __('Frequence') }}</label>
                            <input type="text" name="frequence" value="{{ old('frequence') }}" id="frequence"
                                class="form-control" placeholder="" autofocus>
                            <div class="invalid-div "><span class="frequence"></span></div>
                        </div>

                        <div>
                            <label class="form-control-label" for="name">{{ __('Refoidissement') }}</label>
                            <input type="text" name="refoidissement" value="{{ old('refoidissement') }}"
                                id="refoidissement" class="form-control" placeholder="" autofocus>
                            <div class="invalid-div "><span class="refoidissement"></span></div>
                        </div>


                        <div class="form-group">
                            <label class="form-control-label" for="name">{{ __('Gender') }}</label>
                            <select name="gender" id="gender" class="select2 gender">
                                <option value="" disabled selected>{{ __('Select gender') }}</option>
                                <option value="0"> {{ __('Female') }}</option>
                                <option value="1">{{ __('Male') }}</option>

                            </select>
                            <div class="invalid-div "><span class="name"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="name">{{ __('Service') }}</label>
                            <select name="service" id="service" class="select2 ">
                                <option value="" disabled selected>{{ __('Select Service') }}</option>
                                <option value="Laiser"> {{ __('Laiser') }}</option>
                                <option value="Epilation">{{ __('Epilation') }} </option>
                            </select>
                            <div class="invalid-div "><span class="name"></span></div>
                        </div>


                        <div class="text-center">
                            <button type="submit" id="create_btn" {{-- laiser_refroidissement="all_create('create_user_form','users')" --}}
                                class="btn btn-primary mt-4 mb-5 rtl-float-none">{{ __('Create') }}</button>
                        </div>


                        {{-- birthday --}}


                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
