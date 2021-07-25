
function validateMobile(trigger) {

    if (trigger === 'mobile') {
        var contact = $('input[name=mobile]').val();

        if (contact.length === 0) {
            $('#verifyMobile').html('');
        }

        if (contact.length < 10) {
            $('#verifyMobile').css('color', 'red').html('<i>**the number is invalid!**</i>');
        }

        if ((contact.length === 10 && contact[0] === "0" && (contact[1] === "6" || contact[1] === "7" || contact[1] === "8"))
            || (contact.length === 11 && contact[0] === "2" && contact[1] === "7")) {


            $('#verifyMobile').css('color', 'Green').html('<i>**the number is valid!**</i>');
        } else if (contact.length > 10) {
            $('#verifyMobile').css('color', 'red').html('<i>**the number is invalid!**</i>');

        }
        else {
            $('#verifyMobile').css('color', 'red').html('<i>**the number is invalid!**</i>');

        }

    }
}


function stuffEmail() {

        var count =0;
        let email = $('input[name=staff-email]').val();
        let dotpos = email.indexOf(".");
        let afterDot = email.substr(dotpos,email.length -1);
        var iChar = ".";

        for (var i = 0; i < email.length; i++) {
            if (iChar.indexOf(email.charAt(i)) != -1) {
                count= count+1;
            }
        }

        if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email))
        {
            if(count > 2 || count ==0){
                $('#staffEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
            }else{
                if(afterDot=='.com' ||afterDot=='.co.za' ||afterDot=='.org.za' ||afterDot=='.org' ||afterDot=='.tv'){
                    $('#staffEmail').css('color','green').html('<span>Valid Email Provided <i class="fa fa-handshake-o"></i></span>');
                }else{
                    $('#staffEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
                }
            }

        }else{
            $('#stuffEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
        }
}

function validateID() {

    let id = $('#idNo').val();
    let month = id.substr(2,2);
    let day = id.substr(4,2);
    let gender = id.substr(6,1);

    if(month > 0 && month < 13 && day > 0 && day < 32 && id.length == 13){

        gender >= 5 ? $('#verifyID').css('color','green').html('<span>Identity Number Is Valid (<i class="fa fa-male"></i></span> male)')
                    : $('#verifyID').css('color','green').html('<span>Identity Number Is Valid (<i class="fa fa-female"></i></span> female)');

        gender >= 5 ? $('input[name=gender]').val('male') : $('input[name=gender]').val('female');
    }else{
        $('#verifyID').css('color','#dc3545').html('<span>Identity Number Is Invalid <i class="fa fa-warning"></i></span>');
        $('input[name=gender]').val('');
    }
}

function createPassword() {

    let password = $('#password').val();
    if(password.length > 0) {

        if(password.length < 8){
            $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
        }
        else if(!(/[a-z]/.test(password))){
            $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
        }
        else if(!(/[A-Z]/.test(password))){
            $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
        }
        else if(!(/[0-9]/.test(password))){
            $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
        }
        else if(!(/[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password))){
            $('#verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
        }else{
            $('#verifyPass').css('color','green').html('<span>Strong <i class="fa fa-handshake-o"></i></span>');
        }
    }else{
        $('#verifyPass').html('');
    }
}

function matchPassword(){
    let password = $('#password').val();
    let password_confirm = $('#passwordMatch').val();

    if (password_confirm.length === 0) {
        $('#verifyMatch').html('');
        return;
    }

    if (password === password_confirm) {
        $('#verifyMatch').css('color','green').html('<span>Match <i class="fa fa-handshake-o"></i></span>');
        return;
    }
    else {
        $('#verifyMatch').css('color','#dc3545').html('<span>Password Dont Match <i class="fa fa-warning"></i></span>');
        return;
    }
}

function subForm(){

    if($('#stuffEmail').css('color') =='rgb(220, 53, 69)'){
        $('input[name=staff-email]').focus();
        return false;
    }
    return true;

}



$(function () {
    $('.add-staff').on('click', function () {
        $('#add-staff').modal("show");
    });

    $('.fa-eye').on('click', function () {
        $('#password').attr('type') =='password'? $('#password').attr('type', 'text'): $('#password').attr('type', 'password');
        $('.fa-eye').toggleClass("fa-eye-slash");
    });

    $('select[name=accountType]').on('change', function () {
        $('select[name=accountType]').val() =='business'? $('.regNo').attr('required', true).css('display', 'flex'): $('.regNo').attr('required', false).hide();
    });

});


