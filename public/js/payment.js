$(document).ready(function() {
    $('#use-delivery-address').click(function() {
        $('#billing-address-inputboxes').toggle();
    });

    $('#cc-number').keyup(function() {
        $(this).val($(this).val().replace(/(\d{4})(\d)/g, '$1 $2'));
    });
});
