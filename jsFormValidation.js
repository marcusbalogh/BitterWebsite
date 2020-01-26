$(document).ready(function () {
    /*Colors for validation span tags */
    let good_color = "#66cc66";
    let bad_color = "#ff6666";
    let no_color = '#FFFFFF';

    // /*   Email Validation    */
    // $("#email").keyup(function () {
    //     /*  FixME   */
    //     var emailregex = new RegExp('^[a-zA-Z0-9_.+-]@[a-zA-Z0-9-]\.[a-zA-Z0-9-.]$');
    //     //Store the field objects into variables ...
    //     var email = $('#email');
    //     var message  = $('#email-message');
        
        
    //     if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($('#email').val())) {
    //         email.css('background-color', good_color);
    //         message.css('color', good_color).html("Valid Email.");
    //     } 
    //     else if($('#email').val().length==0)
    //     {
    //         email.css('background-color', no_color);
    //         message.css('color', null).html(null);
    //     }
    //     else {
    //         email.css('background-color', bad_color);
    //         message.css('color', bad_color).html("Invalid Email Address!");
    //     }

    // }); // end of phone check


    // /*   Phone Validation    */
    // $("#phone").keyup(function () {

    //     var phoneregex = new RegExp('^(?:(?:\\+?1\\s*(?:[.-]\\s*)?)?(?:\\(\\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\\s*\\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\\s*(?:[.-]\\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\\s*(?:[.-]\\s*)?([0-9]{4})(?:\\s*(?:#|x\\.?|ext\\.?|extension)\\s*(\\d+))?$');

    //     //Store the field objects into variables ...
    //     var phone = $('#phone');
    //     var message  = $('#phone-message');
        
    //     if (phoneregex.test(phone.val())) {
    //         phone.css('background-color', good_color);
    //         message.css('color', good_color).html("Valid Phone Number.");
    //     } 
    //     else if(phone.val().length==0)
    //     {
    //         phone.css('background-color', no_color);
    //         message.css('color', null).html(null);
    //     }
    //     else {
    //         phone.css('background-color', bad_color);
    //         message.css('color', bad_color).html("Invalid Phone Number!");
    //     }

    // }); // end of phone check

    // /*   Postal Code Validation    */
    // $("#postalCode").keyup(function () {
    
    //     var postalregex = new RegExp('^[A-Za-z][1-9][A-Za-z]\\s[1-9][A-Za-z][1-9]$');

    //     //Store the field objects into variables ...
    //     var postalCode = $('#postalCode');
    //     var message  = $('#postal-message');
        
    //     if (postalregex.test(postalCode.val())) {
    //         postalCode.css('background-color', good_color);
    //         message.css('color', good_color).html("Valid Postal Code.");
    //     } 
    //     else if(postalCode.val().length==0)
    //     {
    //         postalCode.css('background-color', no_color);
    //         message.css('color', null).html(null);
    //     }
    //     else {
    //         postalCode.css('background-color', bad_color);
    //         message.css('color', bad_color).html("Invalid Postal Code!");
    //     }

    // }); //end of postal checkbox


    /*   Password Validation    */
    $("#registration_form [type='password']").blur(function () {
        //https://keithhatfield.com/blog/simple-javascript-password-validation/
        //Store the field objects into variables ...
        let password = $('#password');
        let confirm = $('#confirm');
        let message  = $('#confirm-message');


        if (password.val() == confirm.val()) {
            confirm.css('background-color', good_color);
            message.css('color', good_color).html("Passwords Match!");
        }
        else if(password.val()==""){
            confirm.css('background-color', bad_color);
            message.css('color', bad_color).html("Passwords can't be empty");
        }
        else {
            confirm.css('background-color', bad_color);
            message.css('color', bad_color).html("Passwords Do Not Match!");
        }
    });//end of password confirm

}); //end of document ready