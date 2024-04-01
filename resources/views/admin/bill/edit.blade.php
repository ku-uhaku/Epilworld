<div class="container-fluid sidebar_open @if ($errors->any()) show_sidebar_edit @endif"
    id="edit_bill_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{ __('Update Bill') }}</span>
                    <button type="button" class="edit_bill close">&times;</button>
                </div>
                <form class="form-horizontal" id="edit_bill_form" method="post" enctype="multipart/form-data"
                    action="{{ route('admin.bill.update') }}">

                    @csrf
                    <div class="my-0">
                        <input type="hidden" name="id" id="id" value="">

                        <div class="form-group">
                            <label for="name" class="form-control-label">{{ __('Libellé déponse') }}</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="{{ __('Libellé déponse') }}"{{ old('name') }} />
                            <div class="invalid-div "><span class="name"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="date">{{ __('Date') }}</label>
                            <input type="text" name="date" id="date" class="form-control select_date"
                                placeholder="{{ __('-- Select Date --') }}">
                            <div class="invalid-div"><span class="date"></span></div>
                        </div>


                        <div class="form-group mode_Payment mt-2">
                            <label class="form-control-label">{{ __('mode_Payment') }}</label>
                            <select class="form-control select2 mode_Payment " name="mode_Payment" id="mode_Payment"
                                data-placeholder='{{ __('-- Select mode_Payment --') }}'
                                placeholder='{{ __('-- Select mode_Payment --') }}'
                                dir="{{ session()->has('direction') && session('direction') == 'rtl' ? 'rtl' : '' }}">
                                <option value=""></option>
                                <option value="" disabled selected>
                                    {{ __('Select payment type') }}</option>
                                {{-- cash --}}
                                <option value="cash">{{ __('Cash') }}</option>
                                {{-- cheque --}}
                                <option value="cheque">{{ __('Cheque') }}</option>
                                {{-- bank transfer --}}
                                <option value="bank transfer">{{ __('Bank transfer') }}
                                </option>
                                {{-- credit card --}}
                                <option value="credit card">{{ __('Credit card') }}</option>

                                <option value="treaty">{{ __('Treaty') }}</option>

                                <option value="TPE">{{ __('TPE') }}</option>
                                {{-- other --}}
                                <option value="other">{{ __('Other') }}</option>
                            </select>
                        </div>

                        <div class="form-group ref mt-2">
                            <label for="name" class="form-control-label">{{ __('Réferece payment') }}</label>
                            <input type="text" class="form-control" id="ref" name="ref"
                                placeholder="{{ __('Réferece payment') }}"{{ old('ref') }} />
                            <div class="invalid-div "><span class="ref"></span></div>
                            </select>
                        </div>


                        <div class="form-group">
                            <label class="form-control-label">{{ __('Price') }}</label><br>
                            <input type="text" class="form-control" id="price" name="price"
                                placeholder="{{ __('Price') }}"{{ old('price') }} />
                            <div class="invalid-div "><span class="price"></span></div>
                        </div>


                        <div class="form-group">
                            <label class="form-control-label">{{ __('Tiers') }}</label><br>
                            <input type="text" class="form-control" id="tiers" name="tiers"
                                placeholder="{{ __('Name of tiers') }}"{{ old('tiers') }} />
                            <div class="invalid-div "><span class="tiers"></span></div>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label">{{ __('Remarque') }}</label><br>
                            <textarea name="note" id="note" class="form-control" cols="30" rows="10">
                                
                            </textarea>

                        </div>


                        <div class="text-center">
                            <button type="submit" id="create_btn"
                                class="btn btn-primary rtl-float-none mt-4 mb-5">{{ __('Create') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
