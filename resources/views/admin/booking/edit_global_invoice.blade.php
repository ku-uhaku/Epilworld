<div class="container-fluid sidebar_open @if ($errors->any()) show_sidebar_edit @endif"
    id="edit_global_invoice_sidebar">
    <div class="row">
        <div class="col">
            <div class="card py-3 border-0">
                <!-- Card header -->
                <div class="border_bottom_pink pb-3 pt-2 mb-4">
                    <span class="h3">{{ __('Modifier la facture globale') }}</span>
                    <button type="button" class="edit_global_invoice close">&times;</button>
                </div>
                <form class="form-horizontal" id="edit_global_invoice_form" method="post" enctype="multipart/form-data"
                    action="{{ url('admin/global_invoice/update') }}">
                    @csrf
                    <div class="my-0">
                        <input type="hidden" name="id">

                        <input type="hidden" name="client_id" id="client_id">
                        {{-- User --}}
                        <div class="form-group">
                            <label class="form-control-label">{{ __('Client') }}</label>
                            <input type="text" class="form-control" name="client" id="client">
                        </div>

                        <div class="services">

                        </div>


                        <div>
                            <div class="d-flex justify-content-end mt-3">
                                <button title="Ajouter un parametrage pour la laiser" type="button" id="add_laiser"
                                    class=" add_reservation
                                    btn btn-primary
                                    ">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>









                        <div class="text-center">
                            <button type="submit" id="edit_btn"
                                class="btn btn-primary rtl-float-none mt-4 mb-5">{{ __('Edit') }}</button>
                        </div>

                        <hr>




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
