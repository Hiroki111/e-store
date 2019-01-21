$(document).ready(function() {
    $(".item-qty-input").click(function() {
        var qty = $(this).val();
        var type = $(this).attr('data-type');
        var id = $(this).attr('data-id');
        var price = $(this).attr('data-price');

        $("[data-total-price=" + type + id + "]").text("$" + pad(qty * price));

        var groundTotal = $.map($(".item-qty-input"), function(element) {
            var price = $(element).attr('data-price') * $(element).val();
            return Number(price.toFixed(2));
        }).reduce(function(total, num) {
            return total + num;
        });
        $("#ground-total").text("$" + pad(groundTotal));

        var totalQty = $.map($(".item-qty-input"), function(element) {
            return $(element).val();
        }).reduce(function(total, num) {
            return Number(total) + Number(num);
        });
        totalQty += (totalQty > 1) ? " items" : " item";
        $("#total-qty").text(totalQty);
    });

    function pad(val) {
        if (val % 1 === 0) return val + ".00";

        return val.toFixed(2);
    }
});
