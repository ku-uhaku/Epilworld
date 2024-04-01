// login start
var csrf = $('meta[name="csrf-token"]').attr('content');
var base_url = $('meta[name="base_url"]').attr('content');
var curr_url = window.location.origin + window.location.pathname;

jQuery(".form-control")
    .on("blur", function () {
        if (jQuery(this).val().length <= 0) {
            jQuery(this)
                .siblings("label")
                .removeClass("moveUp");
            jQuery(this).removeClass("outline");
        }
    })
    .on("focus", function () {
        if (jQuery(this).val().length >= 0) {
            jQuery(this)
                .siblings("label")
                .addClass("moveUp");
            jQuery(this).addClass("outline");
        }
    });

// login over

function service_search() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search_service");
    filter = input.value.toUpperCase();
    table = document.getElementById("main_div");
    tr = table.getElementsByClassName("single_div");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("h4")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) == -1) {
                tr[i].style.setProperty('display', 'none', 'important');
            } else {
                tr[i].style.display = "block";
            }
        }
    }
}
function emp_search() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search_emp");
    filter = input.value.toUpperCase();
    table = document.getElementById("main_div_emp");
    tr = table.getElementsByClassName("single_div_emp");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("h4")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) == -1) {
                tr[i].style.setProperty('display', 'none', 'important');
            } else {
                tr[i].style.display = "block";
            }
        }
    }
}
function hideCategory(categoryId) {
    $.ajax({
        url: 'categories/hideCategory',
        method: 'post',
        data: { categoryId: categoryId, _token: csrf },
        success: function (res) { },
        error: function (error) { }
    });
}

function changeDirection(languageId) {
    $.ajax({
        url: 'language/changeDirection',
        method: 'post',
        data: { languageId: languageId, _token: csrf },
        success: function (res) {
            window.location.reload();
        },
        error: function (error) { }
    });
}

function hideLanguage(languageId) {
    $.ajax({
        url: 'language/hideLanguage',
        method: 'post',
        data: { languageId: languageId, _token: csrf },
        success: function (res) {
            window.location.reload();
        },
        error: function (error) { }
    });
}
function hideUser(userId) {
    $.ajax({
        url: 'users/hideUser',
        method: 'post',
        data: { userId: userId, _token: csrf },
        success: function (res) { },
        error: function (error) { }
    });
}
function hideSalon(salonId) {
    $.ajax({
        url: 'salons/hideSalon',
        method: 'post',
        data: { salonId: salonId, _token: csrf },
        success: function (res) { },
        error: function (error) { }
    });
}
function hideService(serviceId) {
    $.ajax({
        url: 'services/hideService',
        method: 'post',
        data: { serviceId: serviceId, _token: csrf },
        success: function (res) { },
        error: function (error) { }
    });
}
function hideGallery(galleryId) {
    $.ajax({
        url: 'gallery/hideGallery',
        method: 'post',
        data: { galleryId: galleryId, _token: csrf },
        success: function (res) { },
        error: function (error) { }
    });
}
function hideCoupon(couponId) {
    $.ajax({
        url: 'coupon/hideCoupon',
        method: 'post',
        data: { couponId: couponId, _token: csrf },
        success: function (res) { },
        error: function (error) { }
    });
}
function hideEmp(empId) {
    $.ajax({
        url: 'employee/hideEmp',
        method: 'post',
        data: { empId: empId, _token: csrf },
        success: function (res) { },
        error: function (error) { }
    });
}
function hideBanner(bannerId) {
    $.ajax({
        url: 'banner/hideBanner',
        method: 'post',
        data: { bannerId: bannerId, _token: csrf },
        success: function (res) { },
        error: function (error) { }
    });
}
function hideOffer(offerId) {
    $.ajax({
        url: 'offer/hideOffer',
        method: 'post',
        data: { offerId: offerId, _token: csrf },
        success: function (res) { },
        error: function (error) { }
    });
}
function changeStatus(bookingId) {
    
    var con = "#selector" + bookingId;
    var status = $(con).val();

    var statusSelect = document.getElementById('selector' + bookingId);
        var selectedStatus = statusSelect.options[statusSelect.selectedIndex].value;

        if (selectedStatus === 'Cancel') {

            $('#booking_iddd').val(bookingId);
            $('#cancelModal').modal('show');

          

            

        } else{
            $.ajax({
                url: 'booking/changestatus',
                method: 'post',
                data: { bookingId: bookingId, status: status, _token: csrf },
                success: function (res) {
                    // Handle success if needed
                },
                error: function (error) {
                    // Handle error if needed
                }
            });

            //reload page
            location.reload(true)
        }
   

    // Find the button in the same row and show/hide based on the status
    var row = $(con).closest('tr');
    var paymentBtn = row.find('.my_payment_btn');
   
    
    if (status == 'Completed') {
        paymentBtn.show();
       
    } else {
        paymentBtn.hide();
        invoiceBtn.hide();
    }

    location.reload(true)
}

function changeStatuss(bookingId) {

    var con = "#selectorr" ;
    var status = $(con).val();


   

    var statusSelect = document.getElementById('selectorr');
    var selectedStatus = statusSelect.options[statusSelect.selectedIndex].value;

    if (selectedStatus === 'Cancel') {
        $('#booking_iddd').val(bookingId);
        $('#cancelModal').modal('show');
    } else{
        $.ajax({
            url: 'booking/changestatus',
            method: 'post',
            data: { bookingId: bookingId, status: status, _token: csrf },
            success: function (res) {
                // Handle success if needed
            },
            error: function (error) {
                // Handle error if needed
            }
            
        });
        location.reload(true)

        
    }
}



// Attach the change event handler separately
$('.my_status_payment_select').on('change', function (e) {
    var status = $(this).val();
    var row = $(this).closest('tr');
    var paymentBtn = row.find('.my_payment_btn');


    if (status == 'Completed') {
        paymentBtn.show();

    } else {
        paymentBtn.hide();
  
    }
});
$(document).ready(function () {
    // Select all elements with the class 'my_status_payment_select'
    const statusElements = $('.my_status_payment_select');

    // Iterate over each status element
    statusElements.each(function () {
        const status = $(this).val();  // Get the value of the current status element
        const row = $(this).closest('tr');
        const paymentBtn = row.find('.my_payment_btn');



        // Check the value of the status and show/hide the payment button accordingly
        if (status === 'Completed') {
            paymentBtn.show();
       
        } else {
            paymentBtn.hide();
           
        }

    });
});







function changePaymentStatus(bookingId) {
    $.ajax({
        url: 'booking/changepaymentstatus',
        method: 'post',
        data: { bookingId: bookingId, _token: csrf },
        success: function (res) {
            window.location.reload();
        },
        error: function (error) { }
    });
}

function reportReview(reviewId) {
    $.ajax({
        url: 'review/reportreview',
        method: 'post',
        data: { reviewId: reviewId, _token: csrf },
        success: function (res) { },
        error: function (error) { }
    });
}

$(document).ready(function () {
    // Select2
    $(".select2").select2({
        width: '-webkit-fill-available'
    });

    // Editor
    $('#template_form .textarea_editor').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['codeview', 'help']]
        ],
        height: 500,
    });
    $('#settingform .terms_conditions').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['codeview', 'help']]
        ],
        height: 300,
    });
    $('#settingform .privacy_policy').summernote({
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture']],
            ['view', ['codeview', 'help']]
        ],
        height: 300,
    });
    // 

});

function template_edit(id, base_url) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        type: "get",
        url: base_url + '/admin/notification/template/edit/' + id,
        success: function (result) {
            document.getElementById('temp_title').innerHTML = result.data.title;
            $(".form-group input[name='subject']").val(result.data.subject);
            $(".form-group input[name='msg_content']").val(result.data.msg_content);
            $("input[name='mail_content']").val(result.data.mail_content);

            $('#template_form .textarea_editor').summernote('code', result.data.mail_content);

            $('#template_form').get(0).setAttribute('action', base_url + '/admin/notification/template/update/' + result.data.id);
        },
        error: function (err) {
            console.log('err ', err.responseJSON.errors)
            $(".invalid-div span").html('');
            for (let v1 of Object.keys(err.responseJSON.errors)) {
                $(".invalid-div ." + v1).html(Object.values(err.responseJSON.errors[v1]));
            }
        }
    });
}
function copy_function(id) {
    var value = document.getElementById(id).innerHTML;
    var input_temp = document.createElement("input");
    input_temp.value = value;
    document.body.appendChild(input_temp);
    input_temp.select();
    document.execCommand("copy");
    document.body.removeChild(input_temp);
};

$(document).ready(function () {
    $('#dataTable').DataTable({
        dom: 'Bfrtip',
        language: {
            paginate: {
                previous: "<i class='fas fa-angle-left'>",
                next: "<i class='fas fa-angle-right'>"
            }
        },
        buttons: [{
            extend: 'copyHtml5',
            title: new Date().toISOString()
        },
        {
            extend: 'excelHtml5',
            title: new Date().toISOString()
        },
        {
            extend: 'csvHtml5',
            title: new Date().toISOString()
        },
        {
            extend: 'pdfHtml5',
            title: new Date().toISOString()
        },
        ]
    });
    $('#dataTableUser').DataTable({
        dom: 'Bfrtip',
        language: {
            paginate: {
                previous: "<i class='fas fa-angle-left'>",
                next: "<i class='fas fa-angle-right'>"
            }
        },
        buttons: []
    });
});


var loadFile = function (event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src)
    }
};


var loadFile_edit = function (event) {
    var output = document.getElementById('output_edit');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function () {
        URL.revokeObjectURL(output.src)
    }
};

var loadFile1 = function (event) {
    var black_logo = document.getElementById('black_logo_output');
    black_logo.src = URL.createObjectURL(event.target.files[0]);
    black_logo.onload = function () {
        URL.revokeObjectURL(black_logo.src)
    }
};
var loadFile2 = function (event) {
    var white_logo = document.getElementById('white_logo_output');
    white_logo.src = URL.createObjectURL(event.target.files[0]);
    white_logo.onload = function () {
        URL.revokeObjectURL(white_logo.src)
    }
};

var loadFile3 = function (event) {
    var bg_img = document.getElementById('bg_img_output');
    bg_img.src = URL.createObjectURL(event.target.files[0]);
    bg_img.onload = function () {
        URL.revokeObjectURL(bg_img.src)
    }
};

var loadFile4 = function (event) {
    var shared_image = document.getElementById('shared_image_output');
    shared_image.src = URL.createObjectURL(event.target.files[0]);
    shared_image.onload = function () {
        URL.revokeObjectURL(shared_image.src)
    }
};
// day off 

$(document).ready(function () {
    $('.check_center .salonCheck').on('change', function (e) {
        if ($(this).prop("checked") == true) {
            $('.input-group  input[name="' + this.value + 'open"]').attr('disabled', true);
            $('.input-group  input[name="' + this.value + 'close"]').attr('disabled', true);

            $('.input-group  input[name="' + this.value + 'open"]').val('');
            $('.input-group  input[name="' + this.value + 'close"]').val('');
        }
        else {
            $('.input-group  input[name="' + this.value + 'open"]').attr('disabled', false);
            $('.input-group  input[name="' + this.value + 'close"]').attr('disabled', false);
        }
    });
})

// Time slot start
var arr = ['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'];
for (let i = 0; i < arr.length; i++) {
    $('.day-section-' + arr[i] + 'open').timepicker({
        timeFormat: 'h:i A',
        disableTextInput: true,
        minTime: '12:30 AM',
        maxTime: '12:00 AM',
    });
    $('.day-section-' + arr[i] + 'open').on('changeTime', function () {
        $end = $(this).val();
        $('.day-section-' + arr[i] + 'close').timepicker({
            timeFormat: 'h:i A',
            disableTimeRanges: [
                ['12:30 AM', $end]
            ],
            disableTextInput: true,
            minTime: '12:30 AM',
            maxTime: '12:00 AM',
        });
    });
    $('.day-section-' + arr[i] + 'close').timepicker({
        timeFormat: 'h:i A',
        disableTextInput: true,
        minTime: '12:30 AM',
        maxTime: '12:00 AM',
    });
}
// sun
function salonTimeSunOpen(day, salonOpen, salonClose) {
    $('.day-section-' + day + 'open-emp').timepicker({
        timeFormat: 'h:i A',
        disableTextInput: true,
        minTime: salonOpen,
        maxTime: salonClose,
    });
}
function salonTimeSunClose(day, salonOpen, salonClose) {
    $('.day-section-' + day + 'close-emp').timepicker({
        timeFormat: 'h:i A',
        disableTextInput: true,
        minTime: salonOpen,
        maxTime: salonClose,
    });
}
// mon
function salonTimeMonOpen(day, salonOpen, salonClose) {
    $('.day-section-' + day + 'open-emp').timepicker({
        timeFormat: 'h:i A',
        disableTextInput: true,
        minTime: salonOpen,
        maxTime: salonClose,
    });
}
function salonTimeMonClose(day, salonOpen, salonClose) {
    $('.day-section-' + day + 'close-emp').timepicker({
        timeFormat: 'h:i A',
        disableTextInput: true,
        minTime: salonOpen,
        maxTime: salonClose,
    });
}
// tue
function salonTimeTueOpen(day, salonOpen, salonClose) {
    $('.day-section-' + day + 'open-emp').timepicker({
        timeFormat: 'h:i A',
        disableTextInput: true,
        minTime: salonOpen,
        maxTime: salonClose,
    });
}
function salonTimeTueClose(day, salonOpen, salonClose) {
    $('.day-section-' + day + 'close-emp').timepicker({
        timeFormat: 'h:i A',
        disableTextInput: true,
        minTime: salonOpen,
        maxTime: salonClose,
    });
}
//  wed
function salonTimeWedOpen(day, salonOpen, salonClose) {
    $('.day-section-' + day + 'open-emp').timepicker({
        timeFormat: 'h:i A',
        disableTextInput: true,
        minTime: salonOpen,
        maxTime: salonClose,
    });
}
function salonTimeWedClose(day, salonOpen, salonClose) {
    $('.day-section-' + day + 'close-emp').timepicker({
        timeFormat: 'h:i A',
        disableTextInput: true,
        minTime: salonOpen,
        maxTime: salonClose,
    });
}
// Thu
function salonTimeThuOpen(day, salonOpen, salonClose) {
    $('.day-section-' + day + 'open-emp').timepicker({
        timeFormat: 'h:i A',
        disableTextInput: true,
        minTime: salonOpen,
        maxTime: salonClose,
    });
}
function salonTimeThuClose(day, salonOpen, salonClose) {
    $('.day-section-' + day + 'close-emp').timepicker({
        timeFormat: 'h:i A',
        disableTextInput: true,
        minTime: salonOpen,
        maxTime: salonClose,
    });
}
// Fri
function salonTimeFriOpen(day, salonOpen, salonClose) {
    $('.day-section-' + day + 'open-emp').timepicker({
        timeFormat: 'h:i A',
        disableTextInput: true,
        minTime: salonOpen,
        maxTime: salonClose,
    });
}
function salonTimeFriClose(day, salonOpen, salonClose) {
    $('.day-section-' + day + 'close-emp').timepicker({
        timeFormat: 'h:i A',
        disableTextInput: true,
        minTime: salonOpen,
        maxTime: salonClose,
    });
}
// Sat
function salonTimeSatOpen(day, salonOpen, salonClose) {
    $('.day-section-' + day + 'open-emp').timepicker({
        timeFormat: 'h:i A',
        disableTextInput: true,
        minTime: salonOpen,
        maxTime: salonClose,
    });
}
function salonTimeSatClose(day, salonOpen, salonClose) {
    $('.day-section-' + day + 'close-emp').timepicker({
        timeFormat: 'h:i A',
        disableTextInput: true,
        minTime: salonOpen,
        maxTime: salonClose,
    });
}
// Time slot end

function salonDayOff(day, base_url) {
    $.ajax({
        url: base_url + '/admin/salons/dayoff',
        method: 'post',
        data: { day: day, _token: csrf },
        success: function (res) { },
        error: function (error) { }
    });
}

//Appointment
$(".add_appointment").click(function () {
    $(".invalid-div span").html('');
    $("#add_appointment_sidebar").slideDown(50), $("#add_appointment_sidebar").toggleClass("show_sidebar_create")
});



$(".add_room").click(function () {
    $(".invalid-div span").html('');
    $("#add_room_sidebar").slideDown(50), $("#add_room_sidebar").toggleClass("show_sidebar_create")
});

$(".edit_appointment").click(function () {
    $(".invalid-div span").html('');
    $("#edit_appointment_sidebar").slideDown(50), $("#edit_appointment_sidebar").toggleClass("show_sidebar_edit")
    $("#popUp_sidebar").slideDown(50), $("#popUp_sidebar").removeClass("show_sidebar_create")
});





var service;
var date;

$(".select_date").flatpickr(
    {
        dateFormat: "Y-m-d",
        minDate: "today"
    });

// Book Appointment 
$(document.body).on("change", ".service_class", function () {
    service = $(this).val();

    var selectedOption = $(this).find('option:selected');
    
    // Retrieve and log the value of the 'data' attribute
    var dataValue = selectedOption.data('time');
    var priceValue = selectedOption.data('price');


    $.ajax({
        headers: {  'X-CSRF-TOKEN': csrf },
        type: "POST",
        url: 'serviceDetails/getZones',
        data: { service_id: $(this).val(), _token: csrf },
        success: function (result) {
            
            $('.zone_id').html('<option value=""  disabled > -- Select Zone -- </option>');
            result.data.forEach(element => {
                $('.zone_id').append('<option value="' + element.service_id + '" data-time="' + element.time + '">' + element.name + element.time +'</option>');

            });
        },
        error: function (err) { }

    })

    
    //show zone select
    if (dataValue == 0 && priceValue== 0) {
     
        //ajax call to get zone
        

        $('.zone').show();
    } else {
        $('.zone').hide();
    }
  
    if ($(this).val().length == 0) {
        $("#create_appointment_form input[name='payment']").val(0);
    }
   
    else {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrf
            },
            type: "POST",
            url: 'booking/paymentcount',
            data: { ser_id: $(this).val(), _token: csrf },
            success: function (result) {
                $(".invalid-div span").html('');
                $("#create_appointment_form input[name='payment']").val(result.data.price);
            },
            error: function (err) { }
        });
    }
});


// $(document.body).on("change", ".service_class", function () {
//     service = $(this).val();

//     if ($(this).val().length == 0) {
//         $("#edit_appointment_form input[name='payment']").val(0);
//     }
//     else {
//         $.ajax({
//             headers: {
//                 'X-CSRF-TOKEN': csrf
//             },
//             type: "POST",
//             url: 'booking/paymentcount',
//             data: { ser_id: $(this).val(), _token: csrf },
//             success: function (result) {
//                 $(".invalid-div span").html('');
//                 $("#edit_appointment_form input[name='payment']").val(result.data.price);
//             },
//             error: function (err) { }
//         });
//     }
// });

$(document.body).on("change", ".zone_id", function () {
    zone = $(this).val();
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        type: "POST",
        url: 'booking/getPaymentCountZone',
        data: { zone_id: $(this).val(), service_id: service, _token: csrf },
        success: function (result) {
        console.log(result.data.price, zone);
            
            $(".invalid-div span").html('');
            $("#create_appointment_form input[name='payment']").val(result.data.price);
        },
        error: function (err) { }
    })

});
$(document.body).on("change", ".service_class", function () {
    service = $(this).val();
    if ($(this).val()) {
        $("#edit_appointment_form input[name='payment']").val(0);
    }
    else {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': csrf
            },
            type: "POST",
            url: 'booking/paymentcount',
            data: { ser_id: $(this).val(), _token: csrf },
            success: function (result) {
                $(".invalid-div span").html('');
                $("#edit_appointment_form input[name='payment']").val(result.data.price);
            },
            error: function (err) { }
        });
    }

    
  
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        type: "POST",
        url: 'booking/getServiceFrecuency',
        data: { service_id: $(this).val(), _token: csrf },
        success: function (result) {

        if(result.success  == true){
            $('.nbs').val(result.data.NBS);
            $('.frequency_nb').val(result.data.service_frecuency_nb);
                $('.frequency option').attr("selected", false);
                $('.frequency option[value=' + result.data.service_frecuency + ']').attr("selected", true);
                $('.frequency option[value=' + result.data.service_frecuency + ']').trigger('change');
        }else{
            $('.frequency_nb').val('');
            $('.frequency option').attr("selected", false);
            $('.frequency option[value=' + 0 + ']').attr("selected", true);
            $('.frequency option[value=' + 0 + ']').trigger('change');
        }
            


        },
        error: function (err) { }
    });
});



$(document.body).on("change", ".select_date", function () {
  
    date = $(this).val();
  
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        type: "POST",
        url: 'booking/timeslot',
        data: { date: $(this).val(), _token: csrf },
        success: function (result) {
         
            $('.start_time').html('<option value=""  disabled selected> -- Select Time -- </option>');
            if (result.success == true) {
                result.data.forEach(element => {
                    
                    $('.start_time').append('<option value="' + element.start_time + '">' + element.start_time + '</option>');
                });
            } else {
                $('.start_time').html('<option value="" disabled selected> Closed </option>');
            }
   
            
        },
        error: function (err) { }
    });
});



// $(document.body).on("change", ".start_time", function () {
//     var timeSelected = $(this).val();
//     $.ajax({
//         headers: {
//             'X-CSRF-TOKEN': csrf
//         },
//         type: "POST",
//         url: 'booking/selectemployee',
//         data: { start_time: $(this).val(), service: service, date: date, _token: csrf },
//         success: function (result) {
//             $('.emp_id').html('<option value=""  disabled selected> -- Select Employee -- </option>');
//             if (result.success == true) {
//                 result.data.forEach(element => {
//                     $('.emp_id').append('<option value="' + element.emp_id + '">' + element.name + '</option>');
//                 });

          
//             } else {
//                 $('.emp_id').html('<option value="" disabled selected> -- No employee available at this time -- </option>');
//             }
//         },
//         error: function (err) { }
//     });

//     $.ajax({
//         headers: {
//             'X-CSRF-TOKEN': csrf
//         },
//         type: "POST",
//         url: 'booking/selectroom',
//         data: { start_time: $(this).val(), service: service, date: date, _token: csrf },
//         success: function (result) {
            
//             $('.room_id').html('<option value=""  disabled selected> -- Select Room -- </option>');
//             if (result.success == true) {
//                 result.data.forEach(element => {
//                     $('.room_id').append('<option value="' + element.room_id + '">' + element.name + '</option>');
//                 });
//             } else {
//                 $('.room_id').html('<option value="" disabled selected> -- No room available at this time -- </option>');
//             }
//         },
//         error: function (err) { }
//     });
    
        
        
    
// });

$(document.body).on("change", ".start_time", function () {
    var timeSelected = $(this).val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        type: "POST",
        url: 'booking/selectemployee',
        data: { start_time: $(this).val(), service: service, date: date, _token: csrf },
        success: function (result) {
            $('.emp_id').html('<option value=""  disabled selected> -- Select Employee -- </option>');
            if (result.success == true) {
                result.data.forEach(element => {
                    $('.emp_id').append('<option value="' + element.emp_id + '">' + element.name + '</option>');
                });

          
            } else {
                $('.emp_id').html('<option value="" disabled selected> -- No employee available at this time -- </option>');
            }
        },
        error: function (err) { }
    });

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        type: "POST",
        url: 'booking/selectroom',
        data: { start_time: $(this).val(), service: service, date: date, _token: csrf },
        success: function (result) {
            
            $('.room_id').html('<option value=""  disabled selected> -- Select Room -- </option>');
            if (result.success == true) {
                result.data.forEach(element => {
                    $('.room_id').append('<option value="' + element.room_id + '">' + element.name + '</option>');
                });
            } else {
                $('.room_id').html('<option value="" disabled selected> -- No room available at this time -- </option>');
            }
        },
        error: function (err) { }
    });
    
        
        
    
});





// Report Filter
$("#filter_date").flatpickr(
    {
        mode: "range",
        dateFormat: "Y-m-d",
        showMonths: 2,
    });

// Open Cat //abc
$(".add_cat").click(function () {
    $(".invalid-div span").html('');
    $("#add_cat_sidebar input[name='image']").val('');
    document.getElementById('output').removeAttribute('src');
    $("#add_cat_sidebar").slideDown(50), $("#add_cat_sidebar").toggleClass("show_sidebar_create")
});

$(".edit_cat_close").click(function () {
    $("#edit_cat_sidebar input[name='image']").val('');
    $("#edit_cat_sidebar").slideDown(50), $("#edit_cat_sidebar").toggleClass("show_sidebar_edit")
});

// Open banner
$(".add_banner").click(function () {
    $(".invalid-div span").html('');
    $("#add_banner_sidebar input[name='image']").val('');
    document.getElementById('output').removeAttribute('src');
    $("#add_banner_sidebar").slideDown(50), $("#add_banner_sidebar").toggleClass("show_sidebar_create")
});

$(".edit_banner_close").click(function () {
    $("#edit_banner_sidebar input[name='image']").val('');
    $("#edit_banner_sidebar").slideDown(50), $("#edit_banner_sidebar").toggleClass("show_sidebar_edit")
});

$(".show_banner_close").click(function () {
    $("#show_banner_sidebar").slideDown(50), $("#show_banner_sidebar").toggleClass("show_sidebar")
});

// Open Offer
$(".add_offer").click(function () {
    $(".invalid-div span").html('');
    $("#add_offer_sidebar input[name='image']").val('');
    document.getElementById('output').removeAttribute('src');
    $("#add_offer_sidebar").slideDown(50), $("#add_offer_sidebar").toggleClass("show_sidebar_create")
});

$(".edit_offer_close").click(function () {
    $("#edit_offer_sidebar input[name='image']").val('');
    $("#edit_offer_sidebar").slideDown(50), $("#edit_offer_sidebar").toggleClass("show_sidebar_edit")
});

$(".show_offer_close").click(function () {
    $("#show_offer_sidebar").slideDown(50), $("#show_offer_sidebar").toggleClass("show_sidebar")
});

// Language
$(".add_language").click(function () {
    $(".invalid-div span").html('');
    $("#add_language_sidebar input[name='image']").val('');
    document.getElementById('output').removeAttribute('src');
    $("#add_language_sidebar").slideDown(50), $("#add_language_sidebar").toggleClass("show_sidebar_create")
});

$("#add_parametrageService").click(function () {
    console.log('add_parametrageService');
    $(".invalid-div span").html('');
    $("#add_parametrageService_sidebar").slideDown(50), $("#add_parametrageService_sidebar").toggleClass("show_sidebar_create")
});

$(".add_parametrageService").click(function () {
    console.log('add_parametrageService');
    $(".invalid-div span").html('');
    $("#add_parametrageService_sidebar").slideDown(50), $("#add_parametrageService_sidebar").toggleClass("show_sidebar_create")
});

$(".edit_parametrageService").click(function () {
    console.log('add_parametrageService');
    $(".invalid-div span").html('');
    $("#edit_parametrageService_sidebar").slideDown(50), $("#edit_parametrageService_sidebar").toggleClass("show_sidebar_edit")
});


// Open Coupon
$(".add_coupon").click(function () {

    $(".invalid-div span").html('');
    $("#add_coupon_sidebar").slideDown(50), $("#add_coupon_sidebar").toggleClass("show_sidebar_create")
});

$(".add_bill").click(function () {
  
    $(".invalid-div span").html('');
    $("#add_bill_sidebar").slideDown(50), $("#add_bill_sidebar").toggleClass("show_sidebar_create")
});

$('.add_bill_close').click(function() {
    $("#add_bill_sidebar").slideDown(50); $("#add_bill_sidebar").toggleClass("show_sidebar_create");
});


$(".edit_bill.close").click(function () {
    $(".invalid-div span").slideDown(50);
    $("#edit_bill_sidebar").slideDown(50), $("#edit_bill_sidebar").toggleClass("show_sidebar_edit")
});





$(".edit_coupon_close").click(function () {
    $("#edit_coupon_sidebar").slideDown(50), $("#edit_coupon_sidebar").toggleClass("show_sidebar_edit")
});

$(".show_coupon_close").click(function () {
    $("#show_coupon_sidebar").slideDown(50), $("#show_coupon_sidebar").toggleClass("show_sidebar")
});

// open review
$(".show_reported_review_close").click(function () {
    $("#show_reported_review_sidebar").slideDown(50), $("#show_reported_review_sidebar").toggleClass("show_sidebar")
});

$(".edit_user").click(function () {
    $("#edit_user_sidebar").slideDown(50), $("#edit_user_sidebar").toggleClass("show_sidebar_edit")
});

// Users
$(".add_user").click(function () {
    $(".invalid-div span").html('');
    $("#add_user_sidebar").slideDown(50), $("#add_user_sidebar").toggleClass("show_sidebar_create")
});

// Services
$(".add_service").click(function () {
    $(".invalid-div span").html('');
    $("#add_service_sidebar input[name='image']").val('');
    document.getElementById('output').removeAttribute('src');
    $("#add_service_sidebar").slideDown(50), $("#add_service_sidebar").toggleClass("show_sidebar_create")
});

$(".add_mini-service").click(function () {
 
    $(".invalid-div span").html('');
    $("#add_mini-service_sidebar input[name='image']").val('');
    document.getElementById('output').removeAttribute('src');
    $("#add_mini-service_sidebar").slideDown(50), $("#add_mini-service_sidebar").toggleClass("show_sidebar_create")
});

$(".add_mini-service_close").click(function () {
 
    $(".invalid-div span").html('');
    $("#add_mini-service_sidebar input[name='image']").val('');
    document.getElementById('output').removeAttribute('src');
    $("#add_mini-service_sidebar").slideDown(50), $("#add_mini-service_sidebar").toggleClass("show_sidebar_create")
});

$(".edit_mini-service_close").click(function () {
 
    $(".invalid-div span").html('');
    $("#edit_mini-service_sidebar input[name='image']").val('');
    document.getElementById('output').removeAttribute('src');
    $("#edit_mini-service_sidebar").slideDown(50), $("#edit_mini-service_sidebar").toggleClass("show_sidebar_edit")
});

$(".edit_service_close").click(function () {
    $("#edit_service_sidebar input[name='image']").val('');
    $("#edit_service_sidebar").slideDown(50), $("#edit_service_sidebar").toggleClass("show_sidebar_edit")
});

$(".show_service_close").click(function () {
    $("#show_service_sidebar").slideDown(50), $("#show_service_sidebar").toggleClass("show_sidebar")
});

// gallery
$(".add_gallery").click(function () {
    $(".invalid-div span").html('');
    $("#add_gallery_sidebar input[name='image']").val('');
    document.getElementById('output').removeAttribute('src');
    $("#add_gallery_sidebar").slideDown(50), $("#add_gallery_sidebar").toggleClass("show_sidebar_create")
});

$(".show_gallery_close").click(function () {
    $("#show_gallery_sidebar").slideDown(50), $("#show_gallery_sidebar").toggleClass("show_sidebar")
});

// Review
$(".show_review_close").click(function () {
    $("#show_review_sidebar").slideDown(50), $("#show_review_sidebar").toggleClass("show_sidebar")
});

// appointment
$(".show_booking_close").click(function () {
    $("#show_booking_sidebar").slideDown(50), $("#show_booking_sidebar").toggleClass("show_sidebar")
});

$(".edit_payment").click(function () {
    $("#edit_payment_sidebar").slideDown(50), $("#edit_payment_sidebar").toggleClass("show_sidebar_edit")
});


function all_create(formID,url) {
    document.getElementById("create_btn").disabled = true;
    var formData = new FormData($('#'+formID)[0]);

   
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:"POST",
        url:base_url+'/admin/'+url+'/store',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        beforeSend: function() {
            $(".preload").fadeIn(1000)
            $(".for-loader").fadeOut(1000)
        },
        success: function(result){
           
            document.getElementById("create_btn").disabled = true;
            window.location.reload(); 
         
        },
        error: function(err){
            $(".preload").fadeOut(1000)
            $(".for-loader").fadeIn(1000)
            document.getElementById("create_btn").disabled = false;
            console.log('err ',err.responseJSON.errors)
            $(".invalid-div span").html('');
            for (let v1 of Object.keys( err.responseJSON.errors)) {
                $(".invalid-div ."+v1).html(Object.values(err.responseJSON.errors[v1]));
            }
        }
    });
}

// function create_my_user(formID,url) {
//     document.getElementById("create_btn").disabled = true;
//     var formData = new FormData($('#'+formID)[0]);

//     console.log(base_url+'/admin/'+url+'/store')
   
//     $.ajax({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         type:"POST",
//         url:base_url+'/admin/'+url+'/store',
//         data:formData,
//         cache:false,
//         contentType: false,
//         processData: false,
//         beforeSend: function() {
//             $(".preload").fadeIn(1000)
//             $(".for-loader").fadeOut(1000)
//         },
//         success: function(result){
            
       
//             document.getElementById("create_btn").disabled = true;
//             window.location.reload();
         
//         },
//         error: function(err){
//             console.log('err ',err.responseJSON.errors)
//             $(".preload").fadeOut(1000)
//             $(".for-loader").fadeIn(1000)
//             document.getElementById("create_btn").disabled = false;
//             console.log('err ',err.responseJSON.errors)
//             $(".invalid-div span").html('');
//             for (let v1 of Object.keys( err.responseJSON.errors)) {
//                 $(".invalid-div ."+v1).html(Object.values(err.responseJSON.errors[v1]));
//             }
//         }
//     });
// }



function all_edit(formID, url) {
    id = $("#" + formID + " input[name='id']").val();
  
    var formData = new FormData($('#' + formID)[0]);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        type: "POST",
        url: url + '/update/' + id,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (result) {
            window.location.reload();
          
        },
        error: function (err) {
            console.log('err ', err.responseJSON.errors)
            $(".invalid-div span").html('');
            for (let v1 of Object.keys(err.responseJSON.errors)) {
                $(".invalid-div ." + v1).html(Object.values(err.responseJSON.errors[v1]));
            }
        }
    });
}



function edit_cat(id, base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type: "GET",
        url: 'categories/edit/' + id,
        success: function (result) {
            $(".invalid-div span").html('');

            $("#edit_cat_sidebar input[name='name']").val(result.data.name);
            $("#edit_cat_sidebar input[name='id']").val(result.data.cat_id);
            $("#edit_cat_sidebar input[name='color']").val(result.data.color_name);
            $('#edit_cat_form .cat_size').attr('src', base_url + '/storage/images/categories/' + result.data.image);

            $("#edit_cat_sidebar").slideDown(50), $("#edit_cat_sidebar").toggleClass("show_sidebar_edit");
        },
        error: function (err) { }
    });
}

function edit_my_payment(formID) {
    id = $("#" + formID + " input[name='id']").val();

    var formData = new FormData($('#' + formID)[0]);

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        type: "POST",
        url: '/admin/payment/update/' + id,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (result) {

            console.log(result)
    
        },
        error: function (err) {
            console.log('err ', err.responseJSON.errors)
            $(".invalid-div span").html('');
            for (let v1 of Object.keys(err.responseJSON.errors)) {
                $(".invalid-div ." + v1).html(Object.values(err.responseJSON.errors[v1]));
            }
        }
    });
}


function edit_banner(id, base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type: "GET",
        url: 'banner/edit/' + id,
        success: function (result) {
            $(".invalid-div span").html('');

            $("#edit_banner_sidebar input[name='title']").val(result.data.title);
            $("#edit_banner_sidebar input[name='id']").val(result.data.id);
            $('#edit_banner_form .banner_size').attr('src', base_url + '/storage/images/banner/' + result.data.image);

            $("#edit_banner_sidebar").slideDown(50), $("#edit_banner_sidebar").toggleClass("show_sidebar_edit");
        },
        error: function (err) { }
    });
}

function edit_offer(id, base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type: "GET",
        url: 'offer/edit/' + id,
        success: function (result) {
            $(".invalid-div span").html('');

            $("#edit_offer_sidebar input[name='title']").val(result.data.title);
            $("#edit_offer_sidebar input[name='discount']").val(result.data.discount);
            $("#edit_offer_sidebar input[name='id']").val(result.data.id);
            $('#edit_offer_form .offer_size').attr('src', base_url + '/storage/images/offer/' + result.data.image);

            $("#edit_offer_sidebar").slideDown(50), $("#edit_offer_sidebar").toggleClass("show_sidebar_edit");
        },
        error: function (err) { }
    });
}

function edit_coupon(id, base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type: "GET",
        url: 'coupon/edit/' + id,
        success: function (result) {
            $(".invalid-div span").html('');

            $("#edit_coupon_sidebar input[name='title']").val(result.data.title);
            $("#edit_coupon_sidebar input[name='discount']").val(result.data.discount);
            $("#edit_coupon_sidebar input[name='max_use']").val(result.data.max_use);
            $("#edit_coupon_sidebar input[name='start_date']").val(result.data.start_date);
            $("#edit_coupon_sidebar input[name='end_date']").val(result.data.end_date);
            $("#edit_coupon_sidebar input[name='id']").val(result.data.coupon_id);
            $('#edit_coupon_form #' + result.data.type).prop('checked', true);
            $("#edit_coupon_sidebar textarea#desc").html(result.data.desc);

            $("#edit_coupon_sidebar").slideDown(50), $("#edit_coupon_sidebar").toggleClass("show_sidebar_edit");
        },
        error: function (err) { }
    });
}

function edit_service(id, base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type: "GET",
        url: 'services/edit/' + id,
        success: function (result) {
            $(".invalid-div span").html('');
            $("#edit_service_sidebar input[name='name']").val(result.data.service.name);
            $("#edit_service_sidebar input[name='price']").val(result.data.service.price);
            $("#edit_service_sidebar input[name='time']").val(result.data.service.time);
            $("#edit_service_sidebar input[name='id']").val(result.data.service.service_id);
            $("#edit_service_sidebar input[name='discount']").val(result.data.service.discount);
            $("#edit_service_sidebar input[name='NBS']").val(result.data.service.NBS);
            $("#edit_service_sidebar input[name='frequency_nb']").val(result.data.service.frequency_nb);
           //next one is select name frequency

            $('#edit_service_sidebar select[name="frequency"] option').attr("selected", false);
            $('#edit_service_sidebar select[name="frequency"] option[value=' + result.data.service.frequency + ']').attr("selected", true);
            $('#edit_service_sidebar select[name="frequency"] option[value=' + result.data.service.frequency + ']').trigger('change');

            

            $('#edit_service_form #' + result.data.service.gender).prop('checked', true);
            $('#edit_service_sidebar select[name="cat_id"] option').attr("selected", false);
            $('#edit_service_sidebar select[name="cat_id"] option[value=' + result.data.service.cat_id + ']').attr("selected", true);
            $('#edit_service_sidebar select[name="cat_id"] option[value=' + result.data.service.cat_id + ']').trigger('change');

            $('#edit_service_form .offer_size').attr('src', base_url + '/storage/images/services/' + result.data.service.image);

            $("#edit_service_sidebar").slideDown(50), $("#edit_service_sidebar").toggleClass("show_sidebar_edit");
        },
        error: function (err) { }
    });
}

function edit_mini_service(id, base_url ) {
    //target parent element

    $('#eyemodal').modal('hide');




    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type: "GET",
        url: 'serviceDetails/edit/' + id,
        success: function (result) {
            $(".invalid-div span").html('');
            $("#edit_mini-service_sidebar input[name='my_id']").val(result.data.id);

             $("#edit_mini-service_sidebar input[name='name']").val(result.data.name);
            $("#edit_mini-service_sidebar input[name='price']").val(result.data.price);
            $("#edit_mini-service_sidebar input[name='time']").val(result.data.time);
             $("#edit_mini-service_sidebar input[name='id']").val(result.data.id);
             $("#edit_mini-service_sidebar input[name='discount']").val(result.data.discount);
            $("#edit_mini-service_sidebar input[name='NBS']").val(result.data.NBS);
            $("#edit_mini-service_sidebar input[name='frequency_nb']").val(result.data.frequency_nb);
           //next one is select name frequency

             $('#edit_mini-service_sidebar select[name="frequency"] option').attr("selected", false);
     $('#edit_mini-service_sidebar select[name="frequency"] option[value=' + result.data.frequency + ']').attr("selected", true);
             $('#edit_mini-service_sidebar select[name="frequency"] option[value=' + result.data.frequency + ']').trigger('change');

            
            $('#edit_mini-service_sidebar input[name="gender"][value="' + result.data.gender + '"]').prop('checked', true);

             $('#edit_mini-service_sidebar select[name="service_id"] option').attr("selected", false);
             $('#edit_mini-service_sidebar select[name="service_id"] option[value=' + result.data.service_id + ']').attr("selected", true);
             $('#edit_mini-service_sidebar select[name="service_id"] option[value=' + result.data.service_id + ']').trigger('change');

           $('#edit_mini-service_sidebar .offer_size').attr('src', base_url + '/storage/images/services/' + result.data.image);

            $("#edit_mini-service_sidebar").slideDown(50), $("#edit_mini-service_sidebar").toggleClass("show_sidebar_edit");
        },
        error: function (err) { }
    });
}

function show_banner(id, base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type: "GET",
        url: 'banner/' + id,
        success: function (result) {
            $('#show_banner_sidebar .salon_size').attr('src', base_url + '/storage/images/banner/' + result.data.banner.image);
            document.getElementById('banner_title').innerHTML = result.data.banner.title;

            $("#show_banner_sidebar").slideDown(50), $("#show_banner_sidebar").toggleClass("show_sidebar");
            $('#show_banner_sidebar .edit_banner_btn').attr('onClick', 'edit_banner(' + result.data.banner.id + ',"' + base_url + '")');
        },
        error: function (err) { }
    });
}

function show_coupon(id, base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type: "GET",
        url: 'coupon/' + id,
        success: function (result) {
            document.getElementById('coupon_code').innerHTML = result.data.coupon.code;
            document.getElementById('coupon_desc').innerHTML = result.data.coupon.desc;
            document.getElementById('coupon_max_use').innerHTML = result.data.coupon.max_use;
            document.getElementById('coupon_use_count').innerHTML = result.data.coupon.use_count;
            document.getElementById('coupon_type').innerHTML = result.data.coupon.type;
            document.getElementById('coupon_start_date').innerHTML = result.data.coupon.start_date;
            document.getElementById('coupon_end_date').innerHTML = result.data.coupon.end_date;
            if (result.data.coupon.type == "Percentage") {
                document.getElementById('coupon_discount').innerHTML = result.data.coupon.discount + '%';
            } else {
                document.getElementById('coupon_discount').innerHTML =  result.data.coupon.discount + ' ' + result.data.symbol ;
            }
            $("#show_coupon_sidebar").slideDown(50), $("#show_coupon_sidebar").toggleClass("show_sidebar");
        },
        error: function (err) { }
    });
}

function show_offer(id, base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type: "GET",
        url: 'offer/' + id,
        success: function (result) {
            $('#show_offer_sidebar .salon_size').attr('src', base_url + '/storage/images/offer/' + result.data.offer.image);
            document.getElementById('offer_title').innerHTML = result.data.offer.title;
            document.getElementById('offer_discount').innerHTML = result.data.offer.discount;

            $("#show_offer_sidebar").slideDown(50), $("#show_offer_sidebar").toggleClass("show_sidebar");
            $('#show_offer_sidebar .edit_offer_btn').attr('onClick', 'edit_offer(' + result.data.offer.id + ',"' + base_url + '")');
        },
        error: function (err) { }
    });
}

function show_reported_review(id, base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type: "GET",
        url: 'review/' + id,
        success: function (result) {
            $('#show_reported_review_sidebar .user_img').attr('src', base_url + '/storage/images/users/' + result.data.review.user.image);
            document.getElementById('user_name').innerHTML = result.data.review.user.name;
            document.getElementById('salon_name').innerHTML = result.data.review.salon.name;

            document.getElementById('msg').innerHTML = result.data.review.message;
            $('#show_reported_review_sidebar #rate').html('');

            for (i = 1; i <= 5; i++) {
                if (i <= result.data.review.rate) {
                    rate = 'activerate';
                } else {
                    rate = '';
                }
                $('#show_reported_review_sidebar #rate').append('<i class="fas fa-star ' + rate + '"></i>');
            }
            $("#show_reported_review_sidebar").slideDown(50), $("#show_reported_review_sidebar").toggleClass("show_sidebar");
        },
        error: function (err) { }
    });
}

function approve_reported_review(url, id, base_url) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, approve!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: "GET",
                url: base_url + '/' + url + '/' + id,
                success: function (result) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                    Swal.fire({
                        type: 'success',
                        title: 'Approved!',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
            });
        } else {
            window.location.reload();
        }
    })
}

function show_service(id, base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type: "GET",
        url: 'services/' + id,
        success: function (result) {
            $('#show_service_sidebar .salon_size').attr('src', base_url + '/storage/images/services/' + result.data.service.image);
            document.getElementById('service_name').innerHTML = result.data.service.name;
            document.getElementById('cat_name').innerHTML = result.data.service.category.name;
            document.getElementById('service_price').innerHTML = result.data.service.price + ' ' + result.data.symbol;
            document.getElementById('service_time').innerHTML = result.data.service.time + ' Min';

            $("#show_service_sidebar").slideDown(50), $("#show_service_sidebar").toggleClass("show_sidebar");
        },
        error: function (err) { }
    });
}

function show_gallery(id, base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type: "GET",
        url: 'gallery/' + id,
        success: function (result) {
            $('#show_gallery_sidebar .salon_size').attr('src', base_url + '/storage/images/gallery/' + result.data.gallery.image);
            $("#show_gallery_sidebar").slideDown(50), $("#show_gallery_sidebar").toggleClass("show_sidebar");
        },
        error: function (err) { }
    });
}

function show_review(id, base_url) {
    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type: "GET",
        url: 'review/' + id,
        success: function (result) {
            $('#show_review_sidebar .user_img').attr('src', base_url + '/storage/images/users/' + result.data.review.user.image);
            document.getElementById('user_name').innerHTML = result.data.review.user.name;
            document.getElementById('salon_name').innerHTML = result.data.review.salon.name;

            document.getElementById('msg').innerHTML = result.data.review.message;
            $('#show_review_sidebar #rate').html('');
            for (i = 1; i <= 5; i++) {
                if (i <= result.data.review.rate) {
                    rate = 'activerate';
                }
                else {
                    rate = '';
                }
                $('#show_review_sidebar #rate').append('<i class="fas fa-star ' + rate + '"></i>');
            }
            $("#show_review_sidebar").slideDown(50), $("#show_review_sidebar").toggleClass("show_sidebar");
        },
        error: function (err) { }
    });
}

function show_booking(id, base_url, page) {

    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type: "GET",
        url: base_url + '/admin/' + page + '/' + id,
        success: function (result) {
            document.getElementById('user_email').innerHTML = result.data.booking.user.email;
            document.getElementById('user_name').innerHTML = result.data.booking.user.name;
            document.getElementById('user_phone').innerHTML = result.data.booking.user.phone;
            $('#show_booking_sidebar .user_img').attr('src', base_url + '/storage/images/users/' + result.data.booking.user.image);

            document.getElementById('app_payment').innerHTML = result.data.booking.payment + ' '+result.data.symbol ;
            document.getElementById('booking_id_main').innerHTML = result.data.booking.booking_id;
            document.getElementById('emp_name').innerHTML = result.data.booking.empDetails.name;
            document.getElementById('app_date').innerHTML = result.data.booking.date;
            document.getElementById('service_time').innerHTML = result.data.booking.start_time + ' - ' + result.data.booking.end_time;

            $('#show_booking_sidebar .view_invoice').attr('href', base_url + '/admin/booking/invoice/' + result.data.booking.id);

            var a = result.data.booking.services
            let arr = []
            var append = ""
            for (let i = 0; i < a.length; i++) {
                arr.push(result.data.booking.services[i].name)
                var temp = arr[i]
                append += temp + "<br>"
            }
            $('#services_all').html(append)
            $("#show_booking_sidebar").slideDown(50), $("#show_booking_sidebar").toggleClass("show_sidebar");
        },
        error: function (err) { }
    });
}

function edit_booking(id, base_url, page) {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf, // Corrected header
        },
        type: "GET",
        url: base_url + '/admin/' + page + '/edit/' + id,
        success: function (result) {

    
            document.getElementById('booking_id').value = result.data.booking.booking_id;
            document.getElementById('id').value = result.data.booking.id;
            // Deselect all options in the user_id dropdown
            $('#edit_appointment_sidebar select[name="user_id"] option').prop("selected", false);

            // Select the option with the corresponding value
            $('#edit_appointment_sidebar select[name="user_id"] option[value="' + result.data.booking.user.id + '"]').prop("selected", true);

            // Trigger the change event to update the select2 UI if you are using select2
            $('#edit_appointment_sidebar select[name="user_id"]').trigger('change');

            // Deselect all options in the service_id[] dropdown
            $('#edit_appointment_sidebar select[name="service_id[]"] option').prop("selected", false);

            // Iterate over each selected service and set the corresponding options as selected
  
           
            $('#edit_appointment_sidebar select[name="service_id[]"] option[value="' + result.data.booking.services[0].service_id + '"]')
            .prop("selected", true)
            .attr("data-time", result.data.booking.services[0].time)
            .attr("data-price", result.data.booking.services[0].price);

          

            // Trigger the change event to update the select2 UI if you are using select2
            $('#edit_appointment_sidebar select[name="service_id[]"]').trigger('change');
       // Log the booking services data for debugging


             
            

            // Set the value of the input with the name "date"
            $('#edit_appointment_sidebar input[name="date"]').val(result.data.booking.date);

            // Trigger the change event for the date input
            $('#edit_appointment_sidebar input[name="date"]').trigger('change');

            //check if it still loading
            setTimeout(function () {
                // Deselect all options in the start_time dropdown
                $('#edit_appointment_sidebar select[name="start_time"] option').prop("selected", false);

                // Select the option with the corresponding value
                $('#edit_appointment_sidebar select[name="start_time"] option[value="' + result.data.booking.start_time + '"]').prop("selected", true);
    
                // Trigger the change event to update the select2 UI if you are using select2
                $('#edit_appointment_sidebar select[name="start_time"]').trigger('change');

                //payment
                $('#edit_appointment_sidebar input[name="payment"]').val(result.data.booking.payment);

            }, 1000);
            document.getElementById('selectorr').value = result.data.booking.booking_status;




            $("#edit_appointment_sidebar").slideDown(50), $("#edit_appointment_sidebar").toggleClass("show_sidebar_edit");
        },
        error: function (err) { }
    });

}

$('.my_more_info').click(function () {
    let id = $(this).attr('data-id');
    let base_url = $(this).attr('data-url');
    let page = 'booking'

    edit_booking(id, base_url, page);
});

function edit_user(id, base_url, page) {
        
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf, // Corrected header
        },
        type: "GET",
        url: base_url + '/admin/' + page + '/edit/' + id,
        success: function (result) {

            $('#edit_user_form').attr('action', base_url + '/admin/users' + '/update/' + id);

            
            document.getElementById('id').value = result.data.user.id;
            document.getElementById('name').value = result.data.user.name;
            document.getElementById('prenom').value = result.data.user.prenom;
            document.getElementById('email').value = result.data.user.email;
            document.getElementById('code').value = result.data.user.code;
            document.getElementById('phone').value = result.data.user.phone;
            document.getElementById('birthday').value = result.data.user.birthday;

            $('#edit_user_form select[name="gender"] option').prop("selected", false);

            // Select the option with the corresponding value
            $('#edit_user_form select[name="gender"] option[value="' + result.data.user.gender + '"]').prop("selected", true);

            // Trigger the change event to update the select2 UI if you are using select2
            $('#edit_user_form select[name="gender"]').trigger('change');
        
            $('#edit_user_form select[name="origin"] option').prop("selected", false);

            // Select the option with the corresponding value
            $('#edit_user_form select[name="origin"] option[value="' + result.data.user.origine + '"]').prop("selected", true);

            // Trigger the change event to update the select2 UI if you are using select2
            $('#edit_user_form select[name="origin"]').trigger('change');

            document.getElementById('praticienne').value = result.data.user.practice;


            document.getElementById('review').innerHTML = result.data.user.review;
            $('.laiser_row').remove();
            $('.epulation_row').remove();

            result.data.parametrage_services.forEach(element => {
                if (element.service_name == 'Laiser') {
                    var newLaiserElement = $('<div class="row mt-4 border laiser_row px-2 py-3">' +
                        '<label class="form-control-label mx-3" for="praticienne">Laiser</label>' +
                        '<select name="laiser[]" class="form-control laiser mb-3 mx-3">' +
                        '<option value="">Sélectionnez un laiser</option>' +
                        '</select>' +
                        '<div class="col-4">' +
                        '<input type="text" name="laiser_energie[]" class="form-control laiser_energie" value="'+ element.pivot.energie +'" placeholder="Energie">' +
                        '</div>' +
                        '<div class="col-4">' +
                        '<input type="text" name="laiser_frequence[]" class="form-control laiser_frequence" value="'+ element.pivot.frequence +'" placeholder="Fréquence">' +
                        '</div>' +
                        '<div class="col-4">' +
                        '<input type="text" name="laiser_refroidissement[]" class="form-control laiser_refroidissement" value="'+ element.pivot.refroidissement +'" placeholder="Refroidissement">' +
                        '</div>' +
                        '<button type="button" class="btn btn-danger delete-btn mt-2 mx-3">Supprimer</button>' +
                        '</div>');
            
                    // Populate the select element with options based on result.data
                    var selectElement = newLaiserElement.find('select');
                    result.data.parametrage_services.forEach(function (service) {
                        if (service.service_name == 'Laiser') {
                            var option = $('<option value="' + service.id + '">' + service.name + '</option>');
                            
                            // Check if the service ID matches the desired ID to set as selected
                            if (service.id == element.id) { // Replace desiredID with the ID you want to match
                                option.attr('selected', 'selected');
                            }
                    
                            selectElement.append(option);
                        }
                    });
                    
            
                    // Add click event listener for delete button
                    newLaiserElement.find('.delete-btn').click(function () {
                        $(this).closest('.row').remove(); // Remove the closest row when delete button is clicked
                    });
            
                    // Add change event listener for select element to get the selected value
                    selectElement.change(function () {
                        var selectedValue = $(this).val();
                        console.log(selectedValue); // Do whatever you want with the selected value
                    });
            
                    // Append the newLaiserElement to the container
                    $('.laiser_container').append(newLaiserElement);
                }
                if (element.service_name == 'Epilation') {
                    var newEpulationElement = $('<div class="row mt-4 border epulation_row px-2 py-3">' +
                        '<label class="form-control-label mx-3" for="epulation">Lumière pulsée</label>' +
                        '<select name="epulation[]" class="form-control epulation mb-3 mx-3" >' +
                        '<option value="">Sélectionnez un Lumière pulsée</option>' +
                        '</select>' +
                        '<div class="col-4">' +
                        '<input type="text" name="epulation_energie[]" class="form-control epulation_energie" value="'+ element.pivot.energie +'" placeholder="Energie">' +
                        '</div>' +
                        '<div class="col-4">' +
                        '<input type="text" name="epulation_frequence[]" class="form-control epulation_frequence" value="'+ element.pivot.frequence +'" placeholder="Fréquence">' +
                        '</div>' +
                        '<div class="col-4">' +
                        '<input type="text" name="epulation_refroidissement[]" class="form-control epulation_refroidissement" value="'+ element.pivot.refroidissement +'" placeholder="Refroidissement">' +
                        '</div>' +
                        '<button type="button" class="btn btn-danger delete-btn mt-2 mx-3">Supprimer</button>' +
                        '</div>');
            
                    // Populate the select element with options based on result.data
                    var selectElement = newEpulationElement.find('select');
                    result.data.parametrage_services.forEach(function (service) {
                        console.log('service.id', service.id)
                        if (service.service_name == 'Epilation') {
                            var option = $('<option value="' + service.id + '">' + service.name + '</option>');
                           
                            // Check if the service ID matches the desired ID to set as selected
                            if (service.id == element.id) { // Replace desiredID with the ID you want to match
                                option.attr('selected', 'selected');
                            }
            
                            selectElement.append(option);
                        }
                    });
            
                    // Add click event listener for delete button
                    newEpulationElement.find('.delete-btn').click(function () {
                        $(this).closest('.row').remove(); // Remove the closest row when delete button is clicked
                    });
            
                    // Add change event listener for select element to get the selected value
                    selectElement.change(function () {
                        var selectedValue = $(this).val();
                        console.log(selectedValue); // Do whatever you want with the selected value
                    });
            
                    // Append the newEpulationElement to the container
                    $('.epulation_container').append(newEpulationElement);
                }
            });
           
            
            
           
           

           
            $("#edit_user_sidebar").slideDown(50), $("#edit_user_sidebar").toggleClass("show_sidebar_edit");
        },
        error: function (err) { }
    });

}

function edit_payment(id, base_url, page) {

    $.ajax({
        headers: {
            'XCSRF-TOKEN': csrf
        },
        type: "GET",
        url: base_url + '/admin/' + page + '/edit/' + id,
        
        success: function (result) {

            document.getElementById('id').value = result.data.id;

            document.getElementById('amount_edit').value = result.data.amount;

            $('#edit_payment_sidebar input[name="booking_id"]').val(result.data.booking_id);


            //payment_date

            document.getElementById('payment_date_edit').value = result.data.payment_date;

            // Trigger the change event for the date input
            $('#edit_payment_sidebar input[name="payment_date_edit"]').trigger('change');

            //payment_method
         
           
            $('#edit_payment_sidebar select[name="edit_payment_type"] option').prop("selected", false);

            // Select the option with the corresponding value
            $('#edit_payment_sidebar select[name="edit_payment_type"] option[value="' + result.data.payment_type + '"]').prop("selected", true);

            // Trigger the change event to update the select2 UI if you are using select2
            $('#edit_payment_sidebar select[name="edit_payment_type"]').trigger('change');


       
            //payment_reference
            if(result.data.payment_reference == null){
                document.getElementById('edit_payment_reference').parentElement.style.display = 'none';
            }
            else{
                document.getElementById('edit_payment_reference').parentElement.style.display = 'block';
                document.getElementById('edit_payment_reference').value = result.data.payment_reference;
            }

            if(result.data.collection_date == null){
                document.getElementById('edit_collection_date').parentElement.style.display = 'none';
            }else{
                document.getElementById('edit_collection_date').parentElement.style.display = 'block';
                document.getElementById('edit_collection_date').value = result.data.collection_date;
            }
            



            $("#edit_payment_sidebar").slideDown(50), $("#edit_payment_sidebar").toggleClass("show_sidebar_edit");
        },
        error: function (err) { }
    });

   
}

// function eventClicked(e) {
//     $("#show_booking_sidebar").slideDown(50), $("#show_booking_sidebar").toggleClass("show_sidebar")
//     $.ajax({
//         url: 'modal/getdata/' + e.id,
//         method: 'get',
//         success: function (result) {
//             document.getElementById('user_email').innerHTML = result.data.booking.user.email;
//             document.getElementById('user_name').innerHTML = result.data.booking.user.name;
//             document.getElementById('user_phone').innerHTML = result.data.booking.user.phone;

//             document.getElementById('app_payment').innerHTML =  result.data.booking.payment  + ' ' + result.data.symbol ;
//             document.getElementById('booking_id_main').innerHTML = result.data.booking.booking_id;
//             document.getElementById('emp_name').innerHTML = result.data.booking.empDetails.name;
//             document.getElementById('app_date').innerHTML = result.data.booking.date;
//             document.getElementById('service_time').innerHTML = result.data.booking.start_time + ' - ' + result.data.booking.end_time;
//             $('#show_booking_sidebar .view_invoice').attr('href', base_url + '/admin/booking/invoice/' + result.data.booking.id);

//             $('.user_img').attr('src', base_url + '/storage/images/users/' + result.data.booking.user.image);
//             var a = result.data.booking.services
//             let arr = []
//             var append = ""

//             for (let i = 0; i < a.length; i++) {
//                 arr.push(result.data.booking.services[i].name)
//                 var temp = arr[i]
//                 append += temp + "<br>"
//             }
//             $('#services_all').html(append)
//         },
//         error: function (err) { }
//     })
//     span.onclick = function () {
//         modal.style.display = "none";
//     }
//     window.onclick = function (event) {
//         if (event.target == modal) {
//             modal.style.display = "none";
//         }
//     }
// }

function deleteData(url, id, base_url) {
  
   
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't to delete this record!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                method: "GET",
                url: base_url + '/' + url + '/delete/' + id,
                success: function (result) {
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                    Swal.fire({
                        type: 'success',
                        title: 'Deleted!',
                        text: 'Record is deleted successfully.',
                        showConfirmButton: false,
                    })
                },
                error: function (err) {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'This record is conntect with another data!'
                    })
                }
            });
        }
        else {
            window.location.reload();
        }
    })
}

// Admin user chart
$(document).ready(function () {
    if (curr_url == base_url + '/admin/dashboard') {
        initChart();
        $.ajax({
            url: 'adminusercharweekdata',
            method: 'get',
            success: function (data) {
                updateChart(data);
            },
            error: function (err) { }
        })
    }
})

$('#adminYearUser').click(function () {
    $.ajax({
        url: 'adminuserchartdata',
        method: 'get',
        success: function (data) {
            updateChart(data);
        },
        error: function (err) { }
    })
})

$('#adminMonthUser').click(function () {
    $.ajax({
        url: 'adminuserchartmonthdata',
        method: 'get',
        success: function (data) {
            updateChart(data);
        },
        error: function (err) { }
    })
});

$('#adminWeekUser').click(function () {
    $.ajax({
        url: 'adminusercharweekdata',
        method: 'get',
        success: function (data) {
            updateChart(data);
        },
        error: function (err) { }
    })
});

var userChart;
function initChart() {
    if (document.getElementById("users_chart")) {
        userChart = new Chart($('#users_chart'), {
            type: 'bar',
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: Charts.colors.gray[900],
                            zeroLineColor: Charts.colors.gray[900]
                        },
                        ticks: {
                            callback: function (value) {
                                if (!(value % 10)) {
                                    return value;
                                }
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function (item, data) {
                            var label = data.datasets[item.datasetIndex].label || '';
                            var yLabel = item.yLabel;
                            var content = '';
                            if (data.datasets.length > 1) {
                                content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                            }
                            content += '<span class="popover-body-value">' + yLabel + '</span>';
                            return content;
                        }
                    }
                }
            },
        });
    }
};

function updateChart(data) {
    userChart.data = {
        labels: data[1],
        datasets: [{
            label: '',
            data: data[0]
        }]
    };
    userChart.update();
    userChart.render({
        duration: 800,
        lazy: false,
    });
}


// Admin Revenue chart
$(document).ready(function () {
    if (curr_url == base_url + '/admin/dashboard') {
        initChart1();
        $.ajax({
            url: 'adminrevenuecharweekdata',
            method: 'get',
            success: function (data) {
                updateChart1(data);
            },
            error: function (err) { }
        })
    }
})

$('#adminYearRevenue').click(function () {
    $.ajax({
        url: 'adminrevenuechartdata',
        method: 'get',
        success: function (data) {
            updateChart1(data);
        },
        error: function (err) { }
    })
})

$('#adminMonthRevenue').click(function () {
    $.ajax({
        url: 'adminrevenuechartmonthdata',
        method: 'get',
        success: function (data) {
            updateChart1(data);
        },
        error: function (err) { }
    })
});

$('#adminWeekRevenue').click(function () {
    $.ajax({
        url: 'adminrevenuecharweekdata',
        method: 'get',
        success: function (data) {
            updateChart1(data);
        },
        error: function (err) { }
    })
});

var revenueChart;
function initChart1() {
    if (document.getElementById("revenue_chart")) {
        revenueChart = new Chart($('#revenue_chart'), {
            type: 'line',
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: Charts.colors.gray[900],
                            zeroLineColor: Charts.colors.gray[900]
                        },
                        ticks: {
                            callback: function (value) {
                                if (!(value % 10)) {
                                    return value;
                                }
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function (item, data) {
                            var label = data.datasets[item.datasetIndex].label || '';
                            var yLabel = item.yLabel;
                            var content = '';
                            if (data.datasets.length > 1) {
                                content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                            }
                            content += '<span class="popover-body-value">' + yLabel + '</span>';
                            return content;
                        }
                    }
                }
            },
        });
    }
};

function updateChart1(data) {
    // Variables
    revenueChart.data = {
        labels: data[1],
        datasets: [{
            label: '',
            data: data[0]
        }]
    };
    revenueChart.update();
    revenueChart.render({
        duration: 800,
        lazy: false,
    });
}

if (curr_url != base_url + '/admin/calendar') {
    $(function () {
        $(".preload").fadeOut(2000, function () {
            $(".for-loader").fadeIn(1000);
        });
    });
}

function submitForm() {
    // Trigger the submit button click
    document.getElementById('submitBtn').click();
}

function add_new_booking_for_emp(user_id, service_id, date, start_time, my_emp_id){
    
  
    $("#popUp_sidebar").slideDown(50), $("#popUp_sidebar").toggleClass("show_sidebar_create")
    //reset all fields using form id
    $('#popUp_form')[0].reset(); 

    $('#add_appointment_sidebar select[name="user_id"] option').prop("selected", false);

    // Select the option with the corresponding value
    $('#add_appointment_sidebar select[name="user_id"] option[value="' + user_id + '"]').prop("selected", true);

    // Trigger the change event to update the select2 UI if you are using select2
    $('#add_appointment_sidebar select[name="user_id"]').trigger('change');




    $('#add_appointment_sidebar select[name="service_id[]"] option').prop("selected", false);

    // Iterate over each selected service and set the corresponding options as selected
    $.each(service_id.split(','), function (index, value) {
       
        $('#add_appointment_sidebar select[name="service_id[]"] option[value="' + value + '"]').prop("selected", true);
    });

    // Trigger the change event to update the select2 UI if you are using select2
    $('#add_appointment_sidebar select[name="service_id[]"]').trigger('change');

    // Set the value of the input with the name "date"
    $('#add_appointment_sidebar input[name="date"]').val(date);

    // Trigger the change event for the date input
    $('#add_appointment_sidebar input[name="date"]').trigger('change');

    //check if it still loading
    setTimeout(function () {
   
        // Deselect all options in the start_time dropdown
        $('#add_appointment_sidebar select[name="start_time"] option').prop("selected", false);

        // Select the option with the corresponding value
        $('#add_appointment_sidebar select[name="start_time"] option[value="' + start_time + '"]').prop("selected", true);

        // Trigger the change event to update the select2 UI if you are using select2
        $('#add_appointment_sidebar select[name="start_time"]').trigger('change');

    }, 1000);


    setTimeout(function () {
       
        // Deselect all options in the emp_id dropdown
        $('#add_appointment_sidebar select[name="emp_id"] option').prop("selected", false); 
       
        // Select the option with the corresponding value
        $('#add_appointment_sidebar select[name="emp_id"] option[value="' + my_emp_id + '"]').prop("selected", true);

        // Trigger the change event to update the select2 UI if you are using select2
        $('#add_appointment_sidebar select[name="emp_id"]').trigger('change');

    }, 2000);

  






    
    $(".invalid-div span").html('');
    $("#add_appointment_sidebar").slideDown(50), $("#add_appointment_sidebar").toggleClass("show_sidebar_create")    
}   

function open_A_Pop_Up(start_time, date, emp_id){
    $('#my_date').val(date);
    $('#my_start_time').val(start_time);
    $('#my_emp_id').val(emp_id);

    $("#popUp_sidebar").slideDown(50), $("#popUp_sidebar").toggleClass("show_sidebar_create")    
}

$(".popUp_btn").click(function () {
    $("#popUp_sidebar").slideDown(50), $("#popUp_sidebar").toggleClass("show_sidebar_create")
});


// document.addEventListener('DOMContentLoaded', function () {
//     // Get the active tab from localStorage or set a default value
//     var activeTab = localStorage.getItem('activeTab') || 'tabs-icons-text-1';

//     // Set the active tab based on the stored value
//     document.querySelector('#tabs-icons-textt .nav-link.active').classList.remove('active');
//     document.querySelector(`#tabs-icons-textt #${activeTab}-tab`).classList.add('active');



//     document.querySelector('.sssss .tab-pane.fade.show.active').classList.remove('active');
//     document.querySelector(`.sssss #${activeTab}`).classList.add('show', 'active'); 

//     // Add an event listener for tab clicks to update the localStorage
//     document.getElementById('tabs-icons-textt').addEventListener('click', function (event) {
        
//         if (event.target.classList.contains('nav-link')) {
//             var tabId = event.target.id.replace('-tab', '');
//             localStorage.setItem('activeTab', tabId);
//         }
//     });
// });


document.addEventListener('DOMContentLoaded', function () {
    // Get the active tab from localStorage or set a default value
    var activeTab = localStorage.getItem('activeTab') || 'tabs-icons-text-1';

    // Set the active tab based on the stored value
    document.querySelectorAll('#tabs-icons-textt .nav-link.active').forEach(function (el) {
        el.classList.remove('active');
    });
    document.querySelector(`#tabs-icons-textt #${activeTab}-tab`).classList.add('active');

    document.querySelectorAll('.sssss .tab-pane.fade.show.active').forEach(function (el) {
        el.classList.remove('active', 'show');
    });
    document.querySelector(`.sssss #${activeTab}`).classList.add('show', 'active');

    // Add an event listener for tab clicks to update the localStorage
    document.getElementById('tabs-icons-textt').addEventListener('click', function (event) {
        if (event.target.classList.contains('nav-link')) {
            var tabId = event.target.id.replace('-tab', '');
            localStorage.setItem('activeTab', tabId);
        }
    });
});



function tryCancel(id) {
 
    $('#booking_iddd').val(id); // Corrected from bookingId to id
}

function cancelBookingPayment(id) {
   

    $('#booking_iddd').val(id); // Corrected from bookingId to id
}


function editBill(id, name,price,date,mode_payment,ref_pay,tiers,note){
 

    $('#edit_bill_sidebar input[name="id"]').val(id);
    $("#edit_bill_sidebar input[name='name']").val(name);
    $("#edit_bill_sidebar input[name='price']").val(price);
    $("#edit_bill_sidebar input[name='date']").val(date);
    $('#edit_bill_sidebar select[name="mode_Payment"] option').attr("selected", false);
    $('#edit_bill_sidebar select[name="mode_Payment"] option[value=' + mode_payment + ']').attr("selected", true);
    $('#edit_bill_sidebar select[name="mode_Payment"] option[value=' + mode_payment + ']').trigger('change');
    $("#edit_bill_sidebar input[name='ref_pay']").val(ref_pay);
    $("#edit_bill_sidebar input[name='tiers']").val(tiers);
    $("#edit_bill_sidebar textarea[name='note']").html(note)



    $("#edit_bill_sidebar").slideDown(50), $("#edit_bill_sidebar").toggleClass("show_sidebar_edit");
}

function edit_userSerivce(id, name, energie , frequence, refroidissement, gender , service)
{
    $('#edit_parametrageService_sidebar input[name="id"]').val(id);
    $("#edit_parametrageService_sidebar input[name='name']").val(name);
    $("#edit_parametrageService_sidebar input[name='energie']").val(energie);
    $("#edit_parametrageService_sidebar input[name='frequence']").val(frequence);
    $("#edit_parametrageService_sidebar input[name='refoidissement']").val(refroidissement);
    $('#edit_parametrageService_sidebar select[name="gender"] option').attr("selected", false);
    $('#edit_parametrageService_sidebar select[name="gender"] option[value=' + gender + ']').attr("selected", true);
    $('#edit_parametrageService_sidebar select[name="gender"] option[value=' + gender + ']').trigger('change');

  


    $('#edit_parametrageService_sidebar select[name="service"] option').attr("selected", false);
    $('#edit_parametrageService_sidebar select[name="service"] option[value=' + service + ']').attr("selected", true);
    $('#edit_parametrageService_sidebar select[name="service"] option[value=' + service + ']').trigger('change');

    $("#edit_parametrageService_sidebar").slideDown(50), $("#edit_parametrageService_sidebar").toggleClass("show_sidebar_edit")
 
}

$(document).ready(function() {
    $('.mode_Payment').change(function() {
        var mode_Payment = $(this).val();
        if (mode_Payment == 'Chéque' || mode_Payment == 'Bank transfer' || mode_Payment ==
            'Credit card') {
            $('.ref').show();
        } else {
            $('.ref').hide();
        }
    });

    $('.origin').change(function() {
        var origin = $(this).val();
        if (origin == 'Sponsorship') {
            $('.practice').show();
        } else {
            $('.practice').hide();
        }
    });
});


function choiceServicesParametrage(gender) {

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        type: "POST",
        url: 'users/serviceParameter',
        data: {
            gender: gender,
            _token: csrf
        },
        success: function(result) {
            $('.laiser_container').empty();
            $('.epulation_container').empty();
        },
        error: function(err) {
            // Handle error if needed
        }
    });
    
    
}

$('.add_laiser').click(function() {
    var gender = $(this).parent().parent().parent().parent().find('.form-group .gender').val()
    if(gender == null){
        alert('Please select gender ')
        return;
    }


    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        type: "POST",
        url: 'users/serviceParameter',
        data: {
            gender : gender,
            _token: csrf
        },
        success: function(result) {
   
            console.log(result) 

            var newLaiserElement = $('<div class="row mt-4 border px-2 py-3">' +
            '<label class="form-control-label mx-3" for="praticienne">Laiser</label>' +
            '<select name="laiser[]" id="laiser" class="form-control laiser mb-3 mx-3">' +
            '<option value="">Sélectionnez un laiser</option>' +
            '</select>' +
            '<div class="col-4">' +
            '<input type="text" name="laiser_energie[]" class="form-control laiser_energie" placeholder="Energie">' +
            '</div>' +
            '<div class="col-4">' +
            '<input type="text" name="laiser_frequence[]" class="form-control laiser_frequence" placeholder="Fréquence">' +
            '</div>' +
            '<div class="col-4">' +
            '<input type="text" name="laiser_refroidissement[]" class="form-control laiser_refoidissement" placeholder="Refroidissement">' +
            '</div>' +
            '<div><button type="button" class="btn btn-danger delete-btn mt-2 mx-3">Supprimer</button>' +
            '</div>');

        // Add click event listener for delete button
        newLaiserElement.find('.delete-btn').click(function() {
            $(this).closest('.row').remove(); // Remove the closest row when delete button is clicked
        });

            // Populate the select element with options based on result.data
            var selectElement = newLaiserElement.find('select');
            result.data.forEach(function(element) {
            if (element.service_name == 'Laiser') {
            selectElement.append('<option value="' + element.id + '">' + element.name + '</option>');
            }
            });


            // Append the new element to the container
            $('.laiser_container').append(newLaiserElement);


        },
        error: function(err) {
            // Handle error if needed
        }
    });
    // Create a new element

    
   
});



$('.add_epulation').click(function() {

    var gender = $(this).parent().parent().parent().parent().find('.form-group .gender').val()
    console.log(gender)

    if(gender == null){
        alert('Please select gender ')
        return;
    }
    

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrf
        },
        type: "POST",
        url: 'users/serviceParameter',
        data: {
            gender : gender,
            _token: csrf
        },
        success: function(result) {
            // Create a new element for Epulation
            var newEpulationElement = $('<div class="row mt-4 border px-2 py-3">' +
    '<label class="form-control-label mx-3" for="epulation">Lumière pulsée</label>' +
    '<select name="epulation[]" id="epulation" class="form-control epulation mb-3 mx-3">' +
    '<option value="">Sélectionnez un Lumière pulsée</option>' +
    '</select>' +
    '<div class="col-4">' +
    '<input type="text" name="epulation_energie[]" class="form-control epulation_energie" placeholder="Energie">' +
    '</div>' +
    '<div class="col-4">' +
    '<input type="text" name="epulation_frequence[]" class="form-control epulation_frequence" placeholder="Fréquence">' +
    '</div>' +
    '<div class="col-4">' +
    '<input type="text" name="epulation_refoidissement[]" class="form-control epulation_refoidissement" placeholder="Refroidissement">' +
    '</div>' +
    '<button type="button" class="btn btn-danger delete-btn mt-2 mx-3">Supprimer</button>' +
    '</div>');

// Add click event listener for delete button
newEpulationElement.find('.delete-btn').click(function() {
    $(this).closest('.row').remove(); // Remove the closest row when delete button is clicked
});

// Append the newEpulationElement to the document or any specific element
$('#someContainer').append(newEpulationElement);


            // Populate the select element with options based on result.data
            var selectEpulationElement = newEpulationElement.find('select');
            result.data.forEach(function(element) {
            if (element.service_name == 'Epilation') {
            selectEpulationElement.append('<option value="' + element.id + '">' + element.name + '</option>');
            }
            });

            $('.epulation_container').append(newEpulationElement);
        },
        error: function(err) {
            // Handle error if needed
        }
    });
 
});


// Event listener for when a value is selected in the 'Laiser' select
$(document).on('change', '.laiser', function() {
    var selectedLaiserId = $(this).val();
    if (selectedLaiserId !== "") {
        var container = $(this).closest('.row');
        $.ajax({
            type: "GET",
            url: 'admin/users/ServiceParDetails',
            data: {
                id: selectedLaiserId
            },
            success: function(response) {
                console.log(response.data)
                container.find('.laiser_energie').val(response.data.energie);
                container.find('.laiser_frequence').val(response.data.frequence);
                container.find('.laiser_refoidissement').val(response.data.refoidissement);
            },
            error: function(err) {
                console.log("AJAX Error: ", err); // Debugging statement
                // Handle error if needed
            }
        });
    }
});



$(document).on('change', '.epulation', function() {
    var selectedEpulationId = $(this).val();
    if (selectedEpulationId !== "") {
        var container = $(this).closest('.row');

        $.ajax({
            type: "GET",
            url: 'admin/users/ServiceParDetails',
            data: {
                id: selectedEpulationId
            },
            success: function(response) {
                console.log(response.data)
                container.find('.epulation_energie').val(response.data.energie);
                container.find('.epulation_frequence').val(response.data.frequence);
                container.find('.epulation_refoidissement').val(response.data.refoidissement);
            },
            error: function(err) {
                // Handle error if needed
            }
        });
    }
});


function  editGlobalInvoice(id) {

    var globalInvoice = id;
    $.ajax({
        type: "GET",
        url: '/admin/global_invoice/edit/' + globalInvoice,
        

        success: function(response) {
            $('#edit_global_invoice_sidebar input[name="id"]').val(response.data.id);

            $('#edit_global_invoice_sidebar input[name="client"]').val(response.data.user.name);
            $('#edit_global_invoice_sidebar input[name="client_id"]').val(response.data.user.id);

            
            response.data.bookings.forEach(element => {
                console.log(element);
                var newBookingElement = $('<div class="row mt-4 border px-2 py-3">' +
                    '<label class="form-control-label mx-3" for="booking">Reservation</label>' +
                    '<input name="booking[]"  class="form-control epulation mb-3 mx-3" value="' + element.id + '">' +
                    
                    '<input  class="form-control epulation mb-3 mx-3" value="' + element.booking_id + '">' +
                    '<input  class="form-control epulation mb-3 mx-3" value="' + element.date + '">');
                element.services.forEach(service => {
                    newBookingElement.append('<input class="form-control epulation mb-3 mx-3" value="' + service.name + '">');
                });
            
                newBookingElement.append('<button type="button" class="btn btn-danger delete-btn mt-2 mx-3">Supprimer</button>' +
                    '</div>');
            
                // Append the new booking element to your desired container
                $('#container').append(newBookingElement);
       
            
    
                // Add click event listener for delete button
                    newBookingElement.find('.delete-btn').click(function() {
                        $(this).closest('.row').remove(); // Remove the closest row when delete button is clicked
                    });
    
                    // Append the newEpulationElement to the document or any specific element
                    $('.services').append(newBookingElement);
            });


            


            $("#edit_global_invoice_sidebar").slideDown(50), $("#edit_global_invoice_sidebar").toggleClass("show_sidebar_edit")
        },
        error: function(err) {
            // Handle error if needed
        }
    });
    
   
}


$('.add_reservation').click(function() {
    var user_id = $(this).parent().parent().parent().parent().find('#client_id').val()
 

    $.ajax({
        type: "GET",
        url: '/admin/global_invoice/getAllBookingsForUser/' + user_id,
        

        success: function(response) {
            var options = '<option value="">Select une reservation</option>';
            // Build options based on response.data
            response.data.forEach(booking => {
                options += '<option value="' + booking.id + '">' + booking.booking_id + '</option>';
            });
        
            // Create the new booking element with the Sélectionnez und options
            var newBookingElement = $('<div class="row mt-4 border px-2 py-3">' +
                '<label class="form-control-label mx-3" for="booking">Reservation</label>' +
                '<select name="booking[]" id="booking" class="form-control select2" onchange="getDatailsForBooking(this.value)">' +
               
                options + '</select>');
        
            // Now append the delete button and close the wrapping div
            newBookingElement.append('<button type="button" class="btn btn-danger delete-btn mt-2 mx-3">Supprimer</button>' +
                '</div>');
        
                 // Add click event listener for delete button
                 newBookingElement.find('.delete-btn').click(function() {
                    $(this).closest('.row').remove(); // Remove the closest row when delete button is clicked
                });

            // Append the new booking element to your desired container
            $('.services').append(newBookingElement);
       


        },
        error: function(err) {
            // Handle error if needed
        }
    })

});


function getDatailsForBooking(booking_id) {
    // Select the specific booking element to remove
 

    // Make AJAX request to get details for booking
    $.ajax({
        type: "GET",
        url: '/admin/global_invoice/getDetailsForBooking/' + booking_id,
        success: function(response) {

            var bookingElementToRemove = $('.services').find('.row').last();
            // Check if it is a select element
            if (bookingElementToRemove.find('select').length > 0) {
                // Remove the booking element
                bookingElementToRemove.remove();
            }
            var newBookingElement = $('<div class="row mt-4 border px-2 py-3">' +
                '<label class="form-control-label mx-3" for="booking">Reservation</label>' +
                '<input  name="booking[]" class="form-control epulation mb-3 mx-3" value="' + response.data.id + '">' +

                '<input class="form-control epulation mb-3 mx-3" value="' + response.data.booking_id + '">' +
                '<input class="form-control epulation mb-3 mx-3" value="' + response.data.date + '">');
            response.data.services.forEach(service => {
                newBookingElement.append('<input class="form-control epulation mb-3 mx-3" value="' + service.name + '">');
            });

            newBookingElement.append('<button type="button" class="btn btn-danger delete-btn mt-2 mx-3">Supprimer</button>' +
                '</div>');
                newBookingElement.find('.delete-btn').click(function() {
                    $(this).closest('.row').remove(); // Remove the closest row when delete button is clicked
                });
            // Append the new booking element to your desired container
            $('.services').append(newBookingElement);
        },
        error: function(err) {
            // Handle error if needed
        }
    });
}
