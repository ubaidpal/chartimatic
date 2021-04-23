<!-- Cartimatic Header html-->

@section('footer-scripts')
<script>
    function validDataStep1(errorCheckType){
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
            }
        });//for token purpose in laravel

        var email                   = $('#email').val();
        var user_type                   = $('#user_type').val();
        var password                = $('#password').val();
        var password_confirmation   = $('#password_confirmation').val();

        $("#confirm-password-help").html('Please wait..');
        var dataString = 'email='+email+'&user_type='+user_type+'&password='+password+'&password_confirmation='+password_confirmation;
        $.ajax({
            type: 'POST',
            url: "<?php echo url('auth/stepOne'); ?>",
            data: dataString,
            success: function (response) {
                var email = password = password_confirmation = '';

                $("#email-help").html('');
                $("#password-help").html('');
                $("#confirm-password-help").html('');

                email    = response.email;
                password = response.password;
                password_confirmation = response.password_confirmation;

                if(errorCheckType == 'email') {
                    $("#email-help").html(email);
                }

                if(errorCheckType == 'password'){
                    $("#password-help").html(password);
                    $("#confirm-password-help").html(password_confirmation);
                }

            }
        });
    }

    $(document).on("blur", "#username", function(){
        validDataStep1('email');
    });

    $(document).on("blur", "#password", function(){
        validDataStep1('password');
    });

    $(document).on("blur", "#password_confirmation", function(){
        validDataStep1('password');
    });

    $(document).on("blur", "#first_name", function(){
        validDataStep2();
    });

    $(document).on("blur", "#last_name", function(){
        validDataStep2();
    });

    function validDataStep2(){
        var first_name               = $('#first_name').val();
        var last_name                = $('#last_name').val();

        if(first_name == ''){
            $("#first_name-help").html('Please enter First Name.');
        }else{
            $("#first_name-help").html('');
        }

        if(last_name == ''){
            $("#last_name-help").html('Please enter Last Name.');
        }else{
            $("#last_name-help").html('');
        }
    }


</script>
@endsection
