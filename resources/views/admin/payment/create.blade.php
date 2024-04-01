@extends('layouts.app')
@section('content')
    @include('layouts.top-header', [
        'title' => 'Créer un paiement',
        'headerData' => 'Recette',
        'url' => 'admin/payment',
        'class' => 'col-lg-7',
    ])

    <div class="container-fluid mt--5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0 text-center">
                        <span class="h3">{{ __('Add payment') }}</span>
                    </div>
                    <div class="mx-4 ">
                        <div class="nav-wrapper">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab"
                                        href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1"
                                        aria-selected="true"><i class="fas fa-coins mr-2"></i>Paiement</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab"
                                        href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2"
                                        aria-selected="false"><i
                                            class="fas fa-clock mr-2"></i>{{ __('payments history') }}</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card shadow">
                            <div class="my-0 mx-auto w-75">
                                <div class="card-body">
                                    <form class="form-horizontal form" action="{{ url('admin/payment/store') }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel"
                                                aria-labelledby="tabs-icons-text-1-tab">
                                                <div class="p-20">

                                                    {{-- header to put name of client and the status of payment --}}
                                                    <div class="d-flex justifiy-content-center align-items-center gap-3">

                                                        <h2 class="text-center">{{ $booking->user->name }}</h2>
                                                        {{-- get last payment status --}}



                                                    </div>

                                                    <h3>{{ __('About the services') }}</h3>
                                                    {{-- services --}}


                                                    @foreach ($services as $service)
                                                        <ul class="list-group list-group-flush">
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                                <div>
                                                                    <img src="{{ asset('storage/images/services/' . $service->image) }}"
                                                                        alt="" width="50px" height="50px"
                                                                        class="rounded-circle mr-2">
                                                                    {{ $service->name }}
                                                                </div>

                                                                <span class="badge badge-primary badge-pill">
                                                                    {{ $service->price }} {{ $symbol }}
                                                                </span>
                                                            </li>
                                                        </ul>
                                                    @endforeach





                                                    <input type="hidden" name="booking_id"
                                                        value="{{ $booking->booking_id }}">
                                                    <input type="hidden" name="id" value="{{ $booking->id }}">


                                                    {{-- total --}}
                                                    <div class="form-group">
                                                        <label class="form-control-label"
                                                            for="total">{{ __('Amount to pay') }}</label>
                                                        <input type="text" value="{{ $booking->payment }}" disabled
                                                            name="total" id="total" class="form-control"
                                                            placeholder="{{ __('Total Price') }}" autofocus>
                                                        @error('total')
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    {{-- email --}}
                                                    <div class="form-group">
                                                        <label for="amount" class="form-control-label">Montant </label>
                                                        <input type="text"value="{{ old('amount') ?? $restToPay }}"
                                                            class="form-control" name="amount" id="amount"
                                                            placeholder="{{ __('amount') }}">
                                                        @error('amount')
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    {{-- payment-date --}}
                                                    <div class="form-group">
                                                        <label for="payment_date"
                                                            class="form-control-label">{{ __('Payment date') }} </label>
                                                        <input type="date" value="{{ old('date') ?? date('Y-m-d') }}"
                                                            class="form-control" name="payment_date" id="payment_date"
                                                            placeholder="{{ __('payment date') }}">
                                                        @error('payment_date')
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    {{-- payment-type --}}
                                                    <div class="form-group">
                                                        <label for="payment_type"
                                                            class="form-control-label">{{ __('Payment type') }} </label>
                                                        <select type="select" value="{{ old('payment_type') }}"
                                                            class="form-control select2" name="payment_type"
                                                            id="payment_type" placeholder="{{ __('Payment type') }}">
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

                                                            <option value="treaty">{{ __('Treaty') }}</option>

                                                            <option value="TPE">{{ __('TPE') }}</option>
                                                            {{-- other --}}
                                                            <option value="other">{{ __('Other') }}</option>
                                                        </select>
                                                        @error('payment_type')
                                                            <div class="invalid-div">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    {{-- payment-reference --}}
                                                    <div class="form-group">
                                                        <div>
                                                            <label for="payment_reference"
                                                                class="form-control-label">{{ __('Payment refernce') }}
                                                            </label>
                                                            <input type="text" value="{{ old('payment_reference') }}"
                                                                class="form-control" name="payment_reference"
                                                                id="payment_reference"
                                                                placeholder="{{ __('Payment refernce') }}">
                                                            @error('payment_reference')
                                                                <div class="invalid-div">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div>
                                                            <label for="collection_date"
                                                                class="form-control-label">{{ __('collection date') }}
                                                            </label>
                                                            <input type="date" value="{{ old('collection_date') }}"
                                                                class="form-control" name="collection_date"
                                                                id="collection_date"
                                                                placeholder="{{ __('collection_date') }}">
                                                            @error('collection_date')
                                                                <div class="invalid-div">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>




                                                    <div class="border-top">
                                                        <div class="card-body text-center rtl-float-none">
                                                            <input type="submit" class="btn btn-primary rtl-float-none"
                                                                value="{{ __('Submit') }}"
                                                                {{ $restToPay == 0 ? 'disabled' : '' }}>
                                                        </div>
                                                    </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel"
                                aria-labelledby="tabs-icons-text-2-tab">
                                <div class="p-20">

                                    <div class="d-flex justifiy-content-center align-items-center gap-3">

                                        <h2 class="text-center mb-3">{{ $booking->user->name }}</h2>
                                        {{-- get last payment status --}}



                                    </div>
                                    <h3>Historique des paiements</h3>
                                    {{-- services --}}

                                    <table class="table table-striped">
                                        <tr>
                                            <th>#</th>
                                            <th>{{ __('Payment amount') }}</th>
                                            <th>{{ __('Payment date') }}</th>
                                            <th>{{ __('Payment type') }}</th>
                                            <th>{{ __('Payment reference') }}</th>
                                            <th>{{ __('Created by') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>

                                        @foreach ($payments as $key => $payment)
                                            <tr
                                                class="@if ($payment->status == 1) bg-danger @endif
                                                @if ($payment->payment_done) bg-info @endif">

                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $payment->amount }}</td>
                                                <td>{{ $payment->payment_date }}</td>
                                                <td>{{ __($payment->payment_type) }}</td>
                                                <td>{{ $payment->payment_reference }}</td>
                                                <td>{{ $payment->created_by }}</td>
                                                @php $base_url = url('/') @endphp
                                                <td>
                                                    @if ($payment->payment_done)
                                                    @elseif ($payment->status == 0)
                                                        <a type="button"
                                                            href="{{ route('admin.payment.print', ['id' => $payment->id]) }}"
                                                            class="btn-white btn shadow-none p-0 m-0 table-action text-primary bg-white"
                                                            data-toggle="tooltip"
                                                            data-original-title="{{ __('print Payment') }}"
                                                            onclick="openNewWindow(event, '{{ route('admin.payment.print', ['id' => $payment->id]) }}')">
                                                            <i class="fa fa-print"></i>
                                                        </a>
                                                        {{-- edit --}}
                                                        <button type="button"
                                                            class="btn-white btn shadow-none p-0 m-0 table-action text-primary bg-white"
                                                            onclick="edit_payment({{ $payment->id }},'{{ $base_url }}','payment')"
                                                            data-toggle="tooltip"
                                                            data-original-title="{{ __('Edit Payment') }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button type="button"
                                                            class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white"
                                                            data-toggle="modal" data-target="#exampleModal"
                                                            data-id="{{ $payment->id }}"
                                                            onclick="tryCancel({{ $payment->id }})"
                                                            data-original-title="{{ __('Cancle Payment') }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    @else
                                                        <button type="button"
                                                            class="btn-white btn shadow-none p-0 m-0 table-action text-danger bg-white eye_btn"
                                                            data-toggle="modal" data-target="#eyemodal"
                                                            data-id="{{ $payment->id }}"
                                                            data-amount="{{ $payment->amount }}"
                                                            data-date="{{ $payment->payment_date }}"
                                                            data-type="{{ $payment->payment_type }}"
                                                            data-reference="{{ $payment->reference }}"
                                                            data-created-by="{{ $payment->created_by }}"
                                                            data-who-cancel="{{ $payment->who_cancel }}"
                                                            data-why-cancel="{{ $payment->whycancel }}"
                                                            data-date-cancel="{{ \Carbon\Carbon::parse($payment->cancel_date)->format('d-m-Y') }}"
                                                            data-original-title="{{ __('Cancel Payment') }}">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </table>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mx-4 ">
                        <div class="nav-wrapper">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text"
                                role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab"
                                        data-toggle="tab" href="#tabs-icons-text-1" role="tab"
                                        aria-controls="tabs-icons-text-1" aria-selected="true"><i
                                            class="fas fa-coins mr-2"></i>Paiement</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab"
                                        href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2"
                                        aria-selected="false"><i
                                            class="fas fa-clock mr-2"></i>{{ __('payments history') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="p-2">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Confirm cancellation') }}</h5>

                </div>
                <form id="my_modal_cancel_form" action="{{ route('admin.payment.destroy') }}" method="post">
                    @csrf
                    <div class="px-2 mt-3">
                        <input type="hidden" id="booking_iddd" name="booking_iddd">
                        <label for="">{{ __('Reason to cancel') }}</label>
                        <textarea name="whycancel" id="whycancel" class="form-control"></textarea>
                    </div>
                    <div class="px-2 mt-4">
                        <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Close') }}</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="eyemodal" tabindex="-1" role="dialog" aria-labelledby="eyemodalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="p-2">
                    <h5 class="modal-title" id="eyemodalLabel">{{ __('Show Details') }}</h5>

                </div>
                <input type="hidden" class="my_key">

                <div class="p-2">
                    <table class="table ">
                        <tr>
                            <th>ID</th>
                            <th>Montant</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Référence</th>
                            <th>Caissière</th>
                        </tr>
                        <tr>
                            <td id="modalContentId"></td>

                            <td id="modalContentAmount"></td>
                            <td id="modalContentDate"></td>
                            <td id="modalContentType"></td>
                            <td id="modalContentReference"></td>
                            <td id="modalContentCreatedBy"></td>

                        </tr>
                        <!-- ... Add other table rows ... -->
                    </table>

                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                        aria-expanded="true" aria-controls="collapseOne">
                                        {{ __('Who cancel') }}
                                    </button>
                                </h5>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <p id="modalContentWhoCancel"></p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                        data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">

                                        {{ __('Why cancel') }}
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordion">
                                <div class="card-body">
                                    <p id="modalContentWhyCancel"></p>
                                    <p id="modalContentDateCancel"></p>


                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>



        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    @include('admin.payment.edit')
    <script>
        $(document).ready(function() {
            var restToPay = parseFloat("{{ $restToPay }}");
            var amountInput = $("#amount");
            var initialAmount = parseFloat(amountInput.val());

            // Event listener for input change
            amountInput.on("input", function() {
                console.log("input changed");
                var enteredAmount = parseFloat(amountInput.val());

                // Check if the entered amount is greater than the remaining amount to pay
                if (enteredAmount > restToPay) {
                    // Display an error message or handle it as needed
                    alert("Amount cannot be greater than the remaining amount to pay.");
                    // Reset the input to the initial value
                    amountInput.val(initialAmount);
                }
            });

            // Event listener for form submission
            $("form").on("submit", function(event) {
                var enteredAmount = parseFloat(amountInput.val());

                // Check if the entered amount is greater than the remaining amount to pay
                if (enteredAmount > restToPay) {
                    // Display an error message or handle it as needed
                    alert("Amount cannot be greater than the remaining amount to pay.");
                    event.preventDefault(); // Prevent form submission
                }
            });


            var paymentTypeSelect = $("#payment_type");
            var paymentReferenceInput = $("#payment_reference");
            var collectionDateInput = $("#collection_date");
            paymentReferenceInput.parent().hide();
            collectionDateInput.parent().hide();


            // Event listener for select change
            paymentTypeSelect.on("change", function() {
                console.log("select changed");
                var selectedPaymentType = paymentTypeSelect.val();

                // Check if the selected payment type is "other"
                if (selectedPaymentType === "cash") {
                    // Display the input parent element
                    paymentReferenceInput.parent().hide();
                    collectionDateInput.parent().hide();

                    paymentReferenceInput.val("");
                } else if (selectedPaymentType === "cheque") {
                    paymentReferenceInput.parent().show();
                    collectionDateInput.parent().show();
                } else {
                    // Hide the input
                    paymentReferenceInput.parent().show();
                    collectionDateInput.parent().hide();
                }
            });

            var paymentTypeSelectEdit = $("#edit_payment_type");
            var paymentReferenceInputEdit = $("#edit_payment_reference");
            var collectionDateInputEdit = $("#edit_collection_date");
            paymentReferenceInputEdit.parent().hide();

            // Event listener for select change
            paymentTypeSelectEdit.on("change", function() {
                console.log("select changed");
                var selectedPaymentType = paymentTypeSelectEdit.val();

                // Check if the selected payment type is "other"
                if (selectedPaymentType === "cash") {
                    // Display the input parent element
                    paymentReferenceInputEdit.parent().hide();
                    collectionDateInputEdit.parent().hide();

                    paymentReferenceInputEdit.val("");
                    collectionDateInputEdit.val("");

                } else if (selectedPaymentType === "cheque") {
                    paymentReferenceInputEdit.parent().show();
                    collectionDateInputEdit.parent().show();
                } else {
                    // Hide the input
                    paymentReferenceInputEdit.parent().show();
                    collectionDateInputEdit.parent().hide();
                    collectionDateInputEdit.val("");
                }
            });

        });
        $(document).ready(function() {
            $('.eye_btn').on('click', function() {
                var paymentId = $(this).data('id');
                var paymentAmount = $(this).data('amount');
                var paymentDate = $(this).data('date');
                var paymentType = $(this).data('type');
                var paymentReference = $(this).data('reference');
                var paymentCreatedBy = $(this).data('created-by');
                var paymentWhoCancel = $(this).data('who-cancel');
                var paymentWhyCancel = $(this).data('why-cancel');
                var paymentDateCancel = $(this).data('date-cancel');


                updateModalContent(paymentId, paymentAmount, paymentDate, paymentType, paymentReference,
                    paymentCreatedBy, paymentWhoCancel, paymentWhyCancel, paymentDateCancel);
            });

            function updateModalContent(id, amount, date, type, reference, createdBy, whoCancel, whyCancel,
                dateCancel) {
                $('#eyemodal').find('#modalContentId').text(id);
                $('#eyemodal').find('#modalContentAmount').text(amount);
                $('#eyemodal').find('#modalContentDate').text(date);
                $('#eyemodal').find('#modalContentType').text(type);
                $('#eyemodal').find('#modalContentReference').text(reference);
                $('#eyemodal').find('#modalContentCreatedBy').text(createdBy);
                $('#eyemodal').find('#modalContentWhoCancel').text(whoCancel);
                $('#eyemodal').find('#modalContentWhyCancel').text(whyCancel);
                $('#eyemodal').find('#modalContentDateCancel').text(dateCancel);
            }
        });
    </script>

    <script>
        function openNewWindow(event, url) {
            event.preventDefault();

            // Open a new window with specific dimensions
            var myWindow = window.open(url, "_blank", "width=250, height=250");

            // Optionally, you can resize the new window to the specified dimensions
            myWindow.resizeTo(500, 800);
        }
    </script>
@endsection
