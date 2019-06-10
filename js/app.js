$(document).ready( function () {

    $('#amount').focus();

    // validation
    $('form').submit(function (e) {
        e.preventDefault();

        var amount = $('#amount').val();
        var submit = true;

        if ( amount == 0){
            $('#amount').val('');
            $('#amount').attr('placeholder',  "Don't be silly. Try with a number greater than 0.");
            submit = false;
        }

        if ( amount < 0){
            $('#amount').val('');
            $('#amount').attr('placeholder',  "Really? Negative pay?. Don't even take that job.");
            submit = false;
        }

        if ( amount == ''){
            $('#amount').val('');
            $('#amount').attr('placeholder',  "Hello!... It's empty.");
            submit = false;
        }

        if ( amount > 1000000){
            $('#amount').val('');
            $('#amount').attr('placeholder',  "Yeah right! keep dreaming.");
            submit = false;
        }

        if ( isNaN(amount)){
            $('#amount').val('');
            $('#amount').attr('placeholder',  "No letters, Are you pushing my limits?");
            submit = false;
        }

        if (submit) {
            this.submit();
        }

        $('#amount').focus();

    });

});

