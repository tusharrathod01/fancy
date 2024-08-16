 function postAjax(url, data, cb) {
     var token = $('meta[name="csrf-token"]').attr('content');
     var jdata = {_token: token};

     for (var k in data) {
         jdata[k] = data[k];
     }

     $.ajax({
         type: 'POST',
         url: url,
         data: jdata,
         success: function (data) {
             if (typeof (data) === 'object') {
                 cb(data);
             } else {
                 cb(data);
             }
         },
     });
 }
 function getAjax(url, data, cb) {
    var token = $('meta[name="csrf-token"]').attr('content');
    var jdata = {_token: token};

    for (var k in data) {
        jdata[k] = data[k];
    }

    $.ajax({
        type: 'GET',
        url: url,
        data: jdata,
        success: function (data) {
            if (typeof (data) === 'object') {
                cb(data);
            } else {
                cb(data);
            }
        },
    });
}

 function deleteAjax(url, data, cb) {
     var token = $('meta[name="csrf-token"]').attr('content');
     var jdata = {_token: token};

     for (var k in data) {
         jdata[k] = data[k];
     }

     $.ajax({
         type: 'DELETE',
         url: url,
         data: jdata,
         success: function (data) {
             if (typeof (data) === 'object') {
                 cb(data);
             } else {
                 cb(data);
             }
         },
     });
 }


 function loadConfirm() {

    $('.bs-pass-para').click(function (event) {
        var form = $(this).closest("form");
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "This action can not be undone. Do you want to continue?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then((result) => {
            if(result.isConfirmed)
            {
                form.submit();
            }
        })
    });
}

function isset() {
    var a = arguments,
        l = a.length,
        i = 0,
        undef;

    if (l === 0) {
        throw new Error('Empty isset');
    }

    while (i !== l) {
        if (a[i] === undef || a[i] === null) {
            return false;
        }
        i++;
    }
    return true;
}

// $(document).on('keyup','input',function(){
//     if($(this).attr('type') !== 'number'){
//         $(this).val($(this).val().toUpperCase());
//     }
// });
