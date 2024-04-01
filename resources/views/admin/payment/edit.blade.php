<div class="container-fluid sidebar_open @if ($errors->any()) show_sidebar_edit @endif"
    id="edit_payment_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{ __('Edit Payment') }}</span>
                    <button type="button" class="edit_payment close">&times;</button>
                </div>
                <form class="form-horizontal" id="edit_payment_form" method="post" enctype="multipart/form-data">

                    @csrf
                    <div class="my-0">

                        <input type="hidden" name="id" id="id">
                        <input type="hidden" class="booking_id" name="booking_id">
                        {{-- total --}}
                        <div class="form-group">
                            <label class="form-control-label" for="total">{{ __('Amount') }}</label>
                            <input type="text" value="{{ $booking->payment }}" disabled name="total" id="total"
                                class="form-control" placeholder="{{ __('Total Price') }}" autofocus>
                            @error('total')
                                <div class="invalid-div">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="amount_edit" class="form-control-label">{{ __('Amount') }} </label>
                            <input type="text" value="{{ old('amount') }}" class="form-control" name="amount_edit"
                                id="amount_edit" placeholder="{{ __('amount_edit') }}">
                            @error('amount_edit')
                                <div class="invalid-div">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="payment_date_edit" class="form-control-label">{{ __('Payment date') }} </label>
                            <input type="date" value="{{ old('payment_date') }}" class="form-control"
                                name="payment_date_edit" id="payment_date_edit" placeholder="{{ __('payment date') }}">
                            @error('payment_date_edit')
                                <div class="invalid-div">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="rest" class="form-control-label">{{ __('Rest to pay') }}</label>
                            <input type="text" value="{{ old('rest') ?? $restToPay }}" class="form-control"
                                name="rest" id="rest">

                            @error('rest')
                                <div class="invalid-div">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- payment-type --}}
                        <div class="form-group">
                            <label for="edit_payment_type" class="form-control-label">{{ __('Payment type') }} </label>
                            <select type="select" value="{{ old('payment_type') }}" class="form-control select2"
                                name="edit_payment_type" id="edit_payment_type" placeholder="{{ __('Payment type') }}">
                                {{-- select payment type --}}
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
                                {{-- other --}}
                                <option value="other">{{ __('Other') }}</option>
                            </select>
                            @error('edit_payment_type')
                                <div class="invalid-div">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- payment-reference --}}
                        <div class="form-group">
                            <label for="edit_payment_reference" class="form-control-label">{{ __('Payment refernce') }}
                            </label>
                            <input type="text" value="{{ old('payment_reference') }}" class="form-control"
                                name="edit_payment_reference" id="edit_payment_reference"
                                placeholder="{{ __('Payment refernce') }}">
                            @error('edit_payment_reference')
                                <div class="invalid-div">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- edit_collection_date --}}
                        <div class="form-group">
                            <label for="edit_collection_date" class="form-control-label">{{ __('collection date') }}
                            </label>
                            <input type="date" value="{{ old('edit_collection_date') }}" class="form-control"
                                name="edit_collection_date" id="edit_collection_date"
                                placeholder="{{ __('edit_collection_date') }}">
                            @error('edit_collection_date')
                                <div class="invalid-div">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="text-center">
                            <button type="button" onclick="edit_my_payment('edit_payment_form')" id="edit_btn"
                                class="btn btn-primary rtl-float-none mt-4 mb-5">{{ __('Edit') }}</button>
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
