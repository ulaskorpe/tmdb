function save(formData,route,formID,btn,reload) {
 
    $.ajax({
        
        url:  route,
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            //console.log(data.status);
            if(data.status=='error'){
                Swal.fire({
                    title: 'error!',
                        text: data.message,
                        icon: 'error',
                        confirmButtonText: 'ok'
                });
            }else{
                Swal.fire({
                    title: 'success',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'ok'
                });
                
            }
           
           
            if(reload){
            setTimeout(function() {
                location.reload();
            }, 2000);
            }
        
        },
        error: function (data) {
            if (data.status === 422) {
                var errors = data.responseJSON.errors;
                var message = "";
                $.each(errors, function (key, value) {
                    message += key + ' : ' + value;
                });

 

                if(btn!='') {
                    $('#'+btn).css('display', '');
                    $('#'+btn+'-hourglass').css('display', 'none');
                }

            }
          
            if (data.status === 500) {
                
                if(btn!='') {

                    $('#'+btn).css('display', '');
                    $('#'+btn+'-hourglass').css('display', 'none');
                }
            }
        }
    });
}