
(function ($) {
    "use strict";


    $( document ).ready(function() {
        $('.input100').each(function(){
            if($(this).val() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }  
        })
        
        /*==================================================================
        [ Focus input ]*/
        $('.input100').each(function(){
            $(this).on('blur', function(){
                if($(this).val() != "") {
                    $(this).addClass('has-val');
                }
                else {
                    $(this).removeClass('has-val');
                }
            })    
        })
    
    
        /*==================================================================
        [ Validate ]*/
        var input = $('.validate-input .input100');

        $('.validate-form').on('submit',function(event){
            var check = true;

            for(var i=0; i<input.length; i++) {
                if(validate(input[i]) == false){
                    showValidate(input[i]);
                    check=false;
                }
            }

            formData = $(this)[0];
            if(check) {
                event.preventDefault();

                $("#loading").removeClass("d-none");

                $.ajax({
                    url: event.target.action,
                    data: $(this).serialize(),
                    method: event.target.method,
                    dataType: 'JSON',
                    processData: false,
                    success: function(res) {
                        $("#loading").addClass("d-none");
                    }
                });
            }
        });


        $('.validate-form .input100').each(function(){
            $(this).focus(function(){
            hideValidate(this);
            });
        });

        function validate (input) {
            if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
                if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                    return false;
                }
            }
            else {
                if($(input).val().trim() == ''){
                    return false;
                }
            }
        }

        function showValidate(input) {
            var thisAlert = $(input).parent();

            $(thisAlert).addClass('alert-validate');
        }

        function hideValidate(input) {
            var thisAlert = $(input).parent();

            $(thisAlert).removeClass('alert-validate');
        }
        
        /*==================================================================
        [ Show pass ]*/
        var showPass = 0;
        $('.btn-show-pass').on('click', function(){
            if(showPass == 0) {
                $(this).next('input').attr('type','text');
                $(this).children('iconify-icon').attr('icon', 'zmdi-eye-off');
                showPass = 1;
            }
            else {
                $(this).next('input').attr('type','password');
                $(this).children('iconify-icon').attr('icon', 'zmdi-eye');
                showPass = 0;
            }
            
        });
    });


})(jQuery);