$(".form-container.login-register").delegate("#login", "click", function (event) {
    event.preventDefault();
    $('.alert-error').remove();
    var error = [];
    var email = $('#email').val();
    var pass = $('#password').val();
    var dataString = 'email='+email+'&password='+pass;
    if(email.length <= 0){
        error.push("Email Can't be empty");
    } else if (!isEmail(email)) {
        error.push("Enter Valid Email");
    } else if (pass.length <= 0) {
        error.push("Password Can't be empty");
    } else if (pass.length < 6) {
        error.push("Password Must be more than 6 characters");
    }
    if (error.length) {
        var index;
        error.forEach(function (t) {
        });
        for (index = 0; index < error.length; index++) {
            $('.form-container.login-register').prepend(
                '<div class="alert alert-error">'+error[index]+'</div>'
            );
            // $('.form-container.login-register').insertBefore('')
        }
    }
    if (!error.length) {
        $.ajax({
            type: 'POST',
            data: dataString,
            url: "/core/login.php",
            success: function (data) {
                if(data.status === 0){
                    $('.form-container.login-register').prepend(
                        '<div class="alert alert-error">'+data.error+'</div>'
                    );
                } else if(data.status === 1){
                    window.location.href = "./dashboard.php";
                }
            }
        });
    }
});
$(".form-container.login-register").delegate("#register", "click", function (event) {
    event.preventDefault();
    $('.alert-error').remove();
    var error = [];
    var name = $('#name').val();
    var email = $('#email').val();
    var pass = $('#password').val();
    var pass_confirm = $('#password_confirmation').val();
    var phone = $('#phone').val();
    var dataString = 'name='+name+'&email='+email+'&password='+pass+'&password_confirmation='+pass_confirm+'&phone='+phone;
    if (name.length <= 0) {
        error.push("Name Can't be empty");
    } else if(email.length <= 0){
        error.push("Email Can't be empty");
    } else if (!isEmail(email)) {
        error.push("Enter Valid Email");
    } else if (pass.length <= 0) {
        error.push("Password Can't be empty");
    } else if (pass.length < 6) {
        error.push("Password Must be more than 6 characters");
    } else if (pass_confirm.length <= 0) {
        error.push("Password confirmation Can't be empty");
    } else if (!(pass === pass_confirm)) {
        error.push("Password and confirmation doesn't match");
    } else if (!isphone(phone)) {
        error.push("Enter Valid Phone Number");
    }
    if (error.length) {
        var index;
        error.forEach(function (t) {
        });
        for (index = 0; index < error.length; index++) {
            $('.form-container.login-register').prepend(
                '<div class="alert alert-error">'+error[index]+'</div>'
            );
            // $('.form-container.login-register').insertBefore('')
        }
    }
    if (!error.length) {
        $.ajax({
            type: 'POST',
            data: dataString,
            url: "/core/register.php",
            success: function (data) {
                if(data.status === 0){
                    $('.form-container.login-register').prepend(
                        '<div class="alert alert-error">'+data.error+'</div>'
                    );
                } else if(data.status === 1){
                    $('.form-container.login-register').load('/view/login.php',function () {
                        $('.form-container.login-register').prepend(
                            '<div class="alert alert-success">Account Created successfully please login</div>'
                        );
                    });
                }
            }
        });
    }
});
$(".form-container").delegate("#logout", "click", function (event){
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: "/core/logout.php",
        success: function (data) {
            if(data.status === 0){
                $('.form-container.login-register').prepend(
                    '<div class="alert alert-error">'+data.error+'</div>'
                );
            } else if(data.status === 1){
                window.location.href = "./dashboard.php";
            }
        }
    });
});
function login() {
    $('.form-container.login-register').load('/view/login.php');
}
function register() {
    $('.form-container.login-register').load('/view/register.php');
}
$(function () {
    $('.form-container.login-register').load('/view/login.php');
});
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
function isphone(phone) {
    var regex = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
    return regex.test(phone);
}
$(".alert").fadeIn(1000);
