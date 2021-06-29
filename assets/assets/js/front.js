
//Add User Validation
function ValueKeyPress(trigger) {

    if (trigger === 'mobile') {
        var contact = $('input[name=mobile]').val();

        if (contact.length === 0) {
            $('#verify').html('');
        }

        if (contact.length < 10) {
            $('#verify').css('color', 'red').html('<i>**the number is invalid!**</i>');
        }

        if ((contact.length === 10 && contact[0] === "0" && (contact[1] === "6" || contact[1] === "7" || contact[1] === "8"))
            || (contact.length === 11 && contact[0] === "2" && contact[1] === "7")) {


            $.ajax({
                type: 'POST',
                url: './verify.php',
                data: {
                    checkValues:contact},
                dataType: 'json',
                success: function(response){
                    if(response !=null){

                        $('#verify').css('color', 'red').html(' <i>the number already exist</i>');
                    }
                    else{

                        $('#verify').css('color', 'Green').html(' <i>the number is valid</i>');
                    }
                }
            });


        } else if (contact.length > 10) {
            $('#verify').css('color', 'red').html('<i>**the number is invalid!**</i>');

        }
        else {
            $('#verify').css('color', 'red').html('<i>**the number is invalid!**</i>');

        }

    }
}


function validateEmail(n) {

    if(n == 'editStudent'){
        var count =0;
        let email = $('#edit-email').val();
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
                $('#edit-verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
            }else{
                if(afterDot=='.com' ||afterDot=='.co.za' ||afterDot=='.org.za' ||afterDot=='.org' ||afterDot=='.tv'){
                    $('#edit-verifyEmail').css('color','green').html('<span>Valid Email Provided <i class="fa fa-handshake-o"></i></span>');
                }else{
                    $('#edit-verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
                }
            }

        }else{
            $('#edit-verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
        }
    }
    if(n == 'editAdmin'){
        var count =0;
        let email = $('#edit-admin-email').val();
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
                $('#edit-admin-verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
            }else{
                if(afterDot=='.com' ||afterDot=='.co.za' ||afterDot=='.org.za' ||afterDot=='.org' ||afterDot=='.tv'){
                    $('#edit-admin-verifyEmail').css('color','green').html('<span>Valid Email Provided <i class="fa fa-handshake-o"></i></span>');
                }else{
                    $('#edit-admin-verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
                }
            }

        }else{
            $('#edit-admin-verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
        }
    }
    if(n == 'addUser'){
        var count =0;
        let email = $('#add-email').val();
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
                $('#verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
            }else{
                if(afterDot=='.com' ||afterDot=='.co.za' ||afterDot=='.org.za' ||afterDot=='.org' ||afterDot=='.tv'){
                    $('#verifyEmail').css('color','green').html('<span>Valid Email Provided <i class="fa fa-handshake-o"></i></span>');
                }else{
                    $('#verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
                }
            }

        }else{
            $('#verifyEmail').css('color','#dc3545').html('<span>Invalid Email Provided <i class="fa fa-warning"></i></span>');
        }
    }


}

function validateID(n) {

    if(n == 'addUser'){
        let id = $('#add-idNo').val();
        let month = id.substr(2,2);
        let day = id.substr(4,2);
        let gender = id.substr(6,1);

        if(month > 0 && month < 13 && day > 0 && day < 32 && id.length == 13){

            gender >= 5 ? $('#verifyID').css('color','green').html('<span>Identity Number Is Valid (<i class="fa fa-male"></i></span> male)')
                : $('#verifyID').css('color','green').html('<span>Identity Number Is Valid (<i class="fa fa-female"></i></span> female)');

            gender >= 5 ? $('input[name=gender]').val('male') : $('input[name=add-gender]').val('female');
        }else{
            $('#verifyID').css('color','#dc3545').html('<span>Identity Number Is Invalid <i class="fa fa-warning"></i></span>');
            $('input[name=add-gender]').val('');
        }
    }

    if(n == 'editStudent'){
        let id = $('#edit-idNo').val();
        let month = id.substr(2,2);
        let day = id.substr(4,2);
        let gender = id.substr(6,1);

        if(month > 0 && month < 13 && day > 0 && day < 32 && id.length == 13){

            gender >= 5 ? $('#edit-verifyID').css('color','green').html('<span>Identity Number Is Valid (<i class="fa fa-male"></i></span> male)')
                : $('#edit-verifyID').css('color','green').html('<span>Identity Number Is Valid (<i class="fa fa-female"></i></span> female)');

            gender >= 5 ? $('input[name=edit-gender]').val('male') : $('input[name=edit-gender]').val('female');
        }else{
            $('#edit-verifyID').css('color','#dc3545').html('<span>Identity Number Is Invalid <i class="fa fa-warning"></i></span>');
            $('input[name=edit-gender]').val('');
        }
    }

    if(n == 'editAdmin'){
        let id = $('#edit-admin-idNo').val();
        let month = id.substr(2,2);
        let day = id.substr(4,2);
        let gender = id.substr(6,1);

        if(month > 0 && month < 13 && day > 0 && day < 32 && id.length == 13){

            gender >= 5 ? $('#edit-admin-verifyID').css('color','green').html('<span>Identity Number Is Valid (<i class="fa fa-male"></i></span> male)')
                : $('#edit-admin-verifyID').css('color','green').html('<span>Identity Number Is Valid (<i class="fa fa-female"></i></span> female)');

            gender >= 5 ? $('input[name=edit-admin-gender]').val('male') : $('input[name=edit-admin-gender]').val('female');
        }else{
            $('#edit-admin-verifyID').css('color','#dc3545').html('<span>Identity Number Is Invalid <i class="fa fa-warning"></i></span>');
            $('input[name=edit-admin-gender]').val('');
        }
    }

}

function createPassword(n) {

    if(n == 'addUser') {
        let password = $('#add-password').val();
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

    if(n == 'editStudent') {
        let password = $('#edit-password').val();
        if(password.length > 0) {

            if(password.length < 8){
                $('#edit-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[a-z]/.test(password))){
                $('#edit-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[A-Z]/.test(password))){
                $('#edit-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[0-9]/.test(password))){
                $('#edit-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password))){
                $('#edit-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }else{
                $('#edit-verifyPass').css('color','green').html('<span>Strong <i class="fa fa-handshake-o"></i></span>');
            }
        }else{
            $('#edit-verifyPass').html('');
        }
    }

    if(n == 'editAdmin') {
        let password = $('#edit-admin-password').val();
        if(password.length > 0) {

            if(password.length < 8){
                $('#edit-admin-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[a-z]/.test(password))){
                $('#edit-admin-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[A-Z]/.test(password))){
                $('#edit-admin-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[0-9]/.test(password))){
                $('#edit-admin-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }
            else if(!(/[ !@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password))){
                $('#edit-admin-verifyPass').css('color','#dc3545').html('<span>Weak <i class="fa fa-warning"></i></span>');
            }else{
                $('#edit-admin-verifyPass').css('color','green').html('<span>Strong <i class="fa fa-handshake-o"></i></span>');
            }
        }else{
            $('#edit-admin-verifyPass').html('');
        }
    }

}

function matchPassword(n){
    let password = $('#add-password').val();
    let password_confirm = $('#add-passwordMatch').val();

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

function sendForm(n){

    if(n == 'addUser') {
        if($('#verifyMatch').css('color') =='rgb(220, 53, 69)'){
            $('input[name=passwordMatch]').focus();
            return false;
        }
        if($('input[name=add-password]').val() !== $('input[name=add-passwordMatch]').val()){
            $('#verifyMatch').css('color','#dc3545').html('<span>Password Dont Match <i class="fa fa-warning"></i></span>');
            $('input[name=add-passwordMatch]').focus();
            return false;
        }
        if($('#verifyEmail').css('color') =='rgb(220, 53, 69)'){
            $('input[name=add-email]').focus();
            return false;
        }
        if($('#verifyPass').css('color') =='rgb(220, 53, 69)'){
            $('input[name=add-password]').focus();
            return false;
        }
        if($('#verifyID').css('color') =='rgb(220, 53, 69)'){
            $('input[name=add-idNo]').focus();
            return false;
        }

    }

    if(n == 'editStudent') {

        if($('#edit-verifyEmail').css('color') =='rgb(220, 53, 69)'){
            $('input[name=edit-email]').focus();
            return false;
        }
        if($('#edit-verifyPass').css('color') =='rgb(220, 53, 69)'){
            $('input[name=edit-password]').focus();
            return false;
        }
        if($('#edit-verifyID').css('color') =='rgb(220, 53, 69)'){
            $('input[name=edit-idNo]').focus();
            return false;
        }

    }

    if(n == 'editAdmin') {

        if($('#edit-admin-verifyEmail').css('color') =='rgb(220, 53, 69)'){
            $('input[name=edit-admin-email]').focus();
            return false;
        }
        if($('#edit-admin-verifyPass').css('color') =='rgb(220, 53, 69)'){
            $('input[name=edit-admin-password]').focus();
            return false;
        }
        if($('#edit-admin-verifyID').css('color') =='rgb(220, 53, 69)'){
            $('input[name=edit-admin-idNo]').focus();
            return false;
        }

    }

    return true;

}

$(function () {

    $('.fa-eye').on('click', function () {
        $('#password').attr('type') =='password'? $('#password').attr('type', 'text'): $('#password').attr('type', 'password');
        $('.fa-eye').toggleClass("fa-eye-slash");
    });

});



$(function () {

    // ------------------------------------------------------- //
    // Tooltips init
    // ------------------------------------------------------ //

    $('[data-toggle="tooltip"]').tooltip()

    // ------------------------------------------------------- //
    // Universal Form Validation
    // ------------------------------------------------------ //

    $('.form-validate').each(function() {
        $(this).validate({
            errorElement: "div",
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            ignore: ':hidden:not(.summernote),.note-editable.card-block',
            errorPlacement: function (error, element) {
                // Add the `invalid-feedback` class to the error element
                error.addClass("invalid-feedback");
                //console.log(element);
                if (element.prop("type") === "checkbox") {
                    error.insertAfter(element.siblings("label"));
                }
                else {
                    error.insertAfter(element);
                }
            }
        });
    });

    // ------------------------------------------------------- //
    // Material Inputs
    // ------------------------------------------------------ //

    var materialInputs = $('input.input-material');

    // activate labels for prefilled values
    materialInputs.filter(function() { return $(this).val() !== ""; }).siblings('.label-material').addClass('active');

    // move label on focus
    materialInputs.on('focus', function () {
        $(this).siblings('.label-material').addClass('active');
    });

    // remove/keep label on blur
    materialInputs.on('blur', function () {
        $(this).siblings('.label-material').removeClass('active');

        if ($(this).val() !== '') {
            $(this).siblings('.label-material').addClass('active');
        } else {
            $(this).siblings('.label-material').removeClass('active');
        }
    });

    // ------------------------------------------------------- //
    // Footer
    // ------------------------------------------------------ //

    var pageContent = $('.page-content');

    $(document).on('sidebarChanged', function () {
        adjustFooter();
    });

    $(window).on('resize', function(){
        adjustFooter();
    })

    function adjustFooter() {
        var footerBlockHeight = $('.footer__block').outerHeight();
        pageContent.css('padding-bottom', footerBlockHeight + 'px');
    }

    // ------------------------------------------------------- //
    // Adding fade effect to dropdowns
    // ------------------------------------------------------ //
    $('.dropdown').on('show.bs.dropdown', function () {
        $(this).find('.dropdown-menu').first().stop(true, true).fadeIn(100).addClass('active');
    });
    $('.dropdown').on('hide.bs.dropdown', function () {
        $(this).find('.dropdown-menu').first().stop(true, true).fadeOut(100).removeClass('active');
    });


    // ------------------------------------------------------- //
    // Search Popup
    // ------------------------------------------------------ //
    $('.search-open').on('click', function (e) {
        e.preventDefault();
        $('.search-panel').fadeIn(100);
    })
    $('.search-panel .close-btn').on('click', function () {
        $('.search-panel').fadeOut(100);
    });


    // ------------------------------------------------------- //
    // Sidebar Functionality
    // ------------------------------------------------------ //
    $('.sidebar-toggle').on('click', function () {
        $(this).toggleClass('active');

        $('#sidebar').toggleClass('shrinked');
        $('.page-content').toggleClass('active');
        $(document).trigger('sidebarChanged');

        if ($('.sidebar-toggle').hasClass('active')) {
            $('.navbar-brand .brand-sm').addClass('visible');
            $('.navbar-brand .brand-big').removeClass('visible');
            $(this).find('i').attr('class', 'fa fa-long-arrow-right');
        } else {
            $('.navbar-brand .brand-sm').removeClass('visible');
            $('.navbar-brand .brand-big').addClass('visible');
            $(this).find('i').attr('class', 'fa fa-long-arrow-left');
        }
    });


    // ------------------------------------------------------ //
    // For demo purposes, can be deleted
    // ------------------------------------------------------ //

    if ($('#style-switch').length > 0) {
        var stylesheet = $('link#theme-stylesheet');
        $("<link id='new-stylesheet' rel='stylesheet'>").insertAfter(stylesheet);
        var alternateColour = $('link#new-stylesheet');

        if ($.cookie("theme_csspath")) {
            alternateColour.attr("href", $.cookie("theme_csspath"));
        }

        $("#colour").change(function () {

            if ($(this).val() !== '') {

                var theme_csspath = 'css/style.' + $(this).val() + '.css';

                alternateColour.attr("href", theme_csspath);

                $.cookie("theme_csspath", theme_csspath, {
                    expires: 365,
                    path: document.URL.substr(0, document.URL.lastIndexOf('/'))
                });

            }

            return false;
        });
    }

    // STrtas  ----------------------------------------//////////////////////////////////////////

    setTimeout(function () {
        $('.message-alert').fadeOut('slow');
    },8000);

    $('.category').on('click', function () {
        $('#add-category').modal('show');
    });


    $('.add-user').on('click', function () {
        $('#add-user').modal('show');
    });

    // books

    $('.add-book').on('click', function () {
        $('#add-book').modal('show');
    });

    $('.delete-book').on('click', function () {
        var id = this.id;
        $('#lbl-category').html('Confirm deletation of books with id: '+id+'?');
        $('input[name=delete-book]').val(id);
        $('#delete-book').modal('show');
    });

    $('.edit-book').on('click', function () {
        var id = this.id;

        $.ajax({
            type: 'POST',
            url: './sql.php',
            data: {
                getBook: id
            },
            dataType: 'json',
            success: function (response) {

                $('input[name=edit-book]').val(id);
                $('input[name=book]').val(response.bookName);
                $('input[name=author]').val(response.author);
                $('select[name=category]').val(response.categoryID);
                $('select[name=shelve]').val(response.shelveNumber);
                $('input[name=quantity]').val(response.quantity);
                $('input[name=price]').val(response.price);

            }});


        $('#edit-book').modal('show');
    });


    // students

    $('.delete-student').on('click', function () {
        var stuNo = this.id;
        console.log(stuNo);
        $('#lbl-student').html('Confirm deletation of student with student no: '+stuNo+'?');
        $('input[name=delete-student]').val(stuNo);
        $('#delete-student').modal('show');
    });

    $('.edit-student').on('click', function () {
        var stuNo = this.id;

        $.ajax({
            type: 'POST',
            url: './sql.php',
            data: {
                getStudent: stuNo
            },
            dataType: 'json',
            success: function (response) {

                $('input[name=edit-student]').val(stuNo);
                $('input[name=edit-name]').val(response.name);
                $('input[name=edit-email]').val(response.email);
                $('input[name=edit-idNo]').val(response.id_number);
                $('input[name=edit-gender]').val(response.gender);
                $('input[name=edit-password]').val(response.password);

            }});


        $('#edit-student').modal('show');
    });

    $('.view-student-profile').on('click', function (){
        var id = this.id;

        $.ajax({
            type: 'POST',
            url: './sql.php',
            data: {
                getStudent: id
            },
            dataType: 'json',
            success: function (response) {

                var year = new Date();
                var age=response.id_number;
                age = age.substr(0,2);
                age = "19"+age;
                age = year.getFullYear()- parseInt(age);
                $('.student-name').html(response.name);
                $('.student-email').html(response.email);
                $('.student-idNo').html(response.id_number);
                $('.student-gender').html(response.gender);
                $('.student-age').html(age);
                $('.student-number').html(response.studentNo);

            }});


        $('#view-student-profile').modal('show');
    });

    // admins
    $('.delete-admin').on('click', function () {
        var id = this.id;
        $('#lbl-admin').html('Confirm deletation of admin with id: '+id+'?');
        $('input[name=delete-admin]').val(id);
        $('#delete-admin').modal('show');
    });

    $('.edit-admin').on('click', function (){
        var id = this.id;

        $.ajax({
            type: 'POST',
            url: './sql.php',
            data: {
                getAdmin: id
            },
            dataType: 'json',
            success: function (response) {

                $('input[name=edit-admin]').val(id);
                $('input[name=edit-admin-name]').val(response.name);
                $('input[name=edit-admin-email]').val(response.email);
                $('input[name=edit-admin-idNo]').val(response.id_number);
                $('input[name=edit-admin-gender]').val(response.gender);
                $('input[name=edit-admin-password]').val(response.password);

            }});


        $('#edit-admin').modal('show');
    });

    $('.view-admin-profile').on('click', function (){
        var id = this.id;

        $.ajax({
            type: 'POST',
            url: './sql.php',
            data: {
                getAdmin: id
            },
            dataType: 'json',
            success: function (response) {

                var year = new Date();
                var age=response.id_number;
                age = age.substr(0,2);
                age = "19"+age;
                age = year.getFullYear()- parseInt(age);
                $('.admin-name').html(response.name);
                $('.admin-email').html(response.email);
                $('.admin-idNo').html(response.id_number);
                $('.admin-gender').html(response.gender);
                $('.admin-age').html(age);

            }});


        $('#view-admin-profile').modal('show');
    });

    $('.add-user').on('change', function () {
        $('#add-user').modal('show');

    });

    $('.book-session').on('click', function () {
        $('#book-session').modal('show');

    });

    $('select[name=select-user]').on('change', function () {

        if($('select[name=select-user]').val() == 'Admins'){
            $('.admins').css('display','contents');
            $('.students').hide();
        }else{
            $('.students').css('display','contents');
            $('.admins').hide();
        }

    });
    //  Delete Post
    $('.delete-post').on('click', function () {
        var id = this.id;
        $('.postID').html('Confirm Delete For Post With ID:  <span class="text-danger mar-5">'+id+'</span> ?');
        $('input[name=postID]').val(id);
        $('#delete-post').modal('show');

    });

});

setTimeout(function () {
    $('.message-alert').fadeOut('slow');
},8000);

function getCount(){
    var time = $('.time-left').html();
    var date = new Date();
    time = time.substr(0,time.length -2);
    var hrs = time.substr(0,2);
    hrs = Math.floor(hrs*60);
    var min = time.substr(3,2);
    var firstHr = hrs+parseInt(min);

    var hrs2 =new Date().getHours();
    hrs2 = Math.floor(hrs2*60);
    var min2 = new Date().getMinutes();
    var lastHr = hrs2+parseInt(min2);

    var dif = firstHr - lastHr;

    $('.countDown').css('color','#8a8d93').html(dif+' Minutes');
    $('.time-bar-count').css('color','#8a8d93').html(dif+' Mins');
    $('.time-bar').attr('width', (dif/parseInt($('.session-dur').html()))+'%');
    if(dif < 20){
        $('.countDown').css('color','red');
        $('.time-bar-count').css('color','red');
    }

    if(dif < 1){
        $.ajax({
            type: 'POST',
            url: './sql.php',
            data: {
                endBooking: dif
            },
            dataType: 'json',
            success: function (response) {

                console.log(response);
            }});
        reload();
    }
}
setInterval(function () {
      getCount();
},8000);

getCount();
