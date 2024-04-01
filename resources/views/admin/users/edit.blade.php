<div class="container-fluid sidebar_open @if ($errors->any()) show_sidebar_edit @endif"
    id="edit_user_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{ __('Edit Client') }}</span>
                    <button type="button" class="edit_user close">&times;</button>
                </div>
                <form class="form-horizontal" id="edit_user_form" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="my-0">

                        <input type="hidden" name="id" id="id" value="{{ old('id') }}">



                        <div class="form-group">
                            <label class="form-control-label" for="prenom">{{ __('Prénom') }}</label>
                            <input type="text" name="prenom" value="{{ old('prenom') }}" id="prenom"
                                class="form-control" placeholder="{{ __('User first name') }}" autofocus>
                            <div class="invalid-div "><span class="prenom"></span></div>
                        </div>


                        <div class="form-group">
                            <label class="form-control-label" for="name">{{ __('Name') }}</label>
                            <input type="text" name="name" value="{{ old('name') }}" id="name"
                                class="form-control" placeholder="{{ __('User name') }}" autofocus>
                            <div class="invalid-div "><span class="name"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="email">{{ __('Email') }}</label><br>
                            <input type="text" name="email" value="{{ old('email') }}" id="email"
                                class="form-control" placeholder="{{ __('Email editress') }}">
                            <div class="invalid-div "><span class="email"></span></div>
                        </div>

                        <div class="form-group d-none">
                            <label class="form-control-label" for="password">{{ __('Password') }}</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="{{ __('Password') }}" value="12345678">
                            <div class="invalid-div "><span class="password"></span></div>
                        </div>

                        <div class="form-group d-none">
                            <label class="form-control-label" for="code">{{ __('Country Code') }}</label><br>
                            <input type="number" min="1" name="code" value="{{ old('code') }}"
                                id="code" class="form-control" placeholder="{{ __('Country Code') }}">
                            <div class="invalid-div "><span class="code"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="phone">{{ __('Phone no.') }}</label><br>
                            <input type="text" name="phone" value="{{ old('phone') }}" id="phone"
                                class="form-control" placeholder="{{ __('Phone number') }}">
                            <div class="invalid-div "><span class="phone"></span></div>
                        </div>

                        {{-- birthday --}}
                        <div class="form-group">
                            <label class="form-control-label" for="phone">{{ __('Date of birth') }}</label><br>
                            <input type="date" name="birthday" value="{{ old('birthday') }}" id="birthday"
                                class="form-control" placeholder="{{ __('Date of birth') }}">
                            <div class="invalid-div "><span class="birthday"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="name">{{ __('Gender') }}</label>
                            <select name="gender" id="edit_gender" class="select2 gender" @readonly(true) disabled>

                                <option value="0"> {{ __('Female') }}</option>
                                <option value="1">{{ __('Male') }}</option>

                            </select>
                            <div class="invalid-div "><span class="name"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="origin">{{ __('Customer Origin') }}</label>

                            <select name="origin" id="edit_origin" class="select2 origin">
                                <option value="Social networks"> {{ __('Social networks') }}</option>
                                <option value="Passing through">{{ __('Passing through') }}</option>
                                <option value="Site web">{{ __('Site web') }}</option>
                                <option value="Sponsorship">{{ __('Sponsorship') }}</option>
                                <option value="Other">{{ __('Other') }}</option>

                            </select>
                            <div class="invalid-div "><span class="origin"></span></div>
                        </div>

                        <div class="form-group practice" style="display:none">
                            <label class="form-control-label" for="praticienne">{{ __('Name of practice') }}</label>
                            <input type="text" name="praticienne" value="{{ old('praticienne') }}"
                                id="praticienne" class="form-control" placeholder="{{ __('Name of practice') }}">
                            <div class="invalid-div "><span class="praticienne"></span></div>
                        </div>

                        <div class="gender_choisen">
                            <div class="laiser form-group">
                                <div class="laiser_container">
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <button title="Ajouter un parametrage pour la laiser" type="button"
                                        id="add_laiser"
                                        class=" add_laiser
                                        btn btn-primary
                                        ">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>


                            <div class="epilation form-group">
                                <div class="epulation_container">
                                </div>
                                <div class="d-flex justify-content-end mt-3">
                                    <button title="Ajouter un parametrage pour la Lumière pulsée" type="button"
                                        id="add_epulation"
                                        class=" add_epulation
                                        btn btn-primary
                                        ">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>

                            </div>
                        </div>

                        {{-- review --}}
                        <div class="form-group">
                            <label class="form-control-label"
                                for="review">{{ __('Informations importantes sur le client') }}</label><br>
                            <textarea name="review" class="form-control" rows="6" id="review"></textarea>
                            <div class="invalid-div "><span class="review"></span></div>
                        </div>




                        <div class="text-center">
                            <button type="submit" id="edit_btn" {{-- onclick="all_edit('edit_user_form','users')" --}}
                                class="btn btn-primary mt-4 mb-5 rtl-float-none">{{ __('Edit') }}</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
