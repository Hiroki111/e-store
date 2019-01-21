$(document).ready(function() {
    $(".item-qty-input").click(function() {
        var qty = $(this).val();
        var type = $(this).attr('data-type');
        var id = $(this).attr('data-id');
        var price = $(this).attr('data-price');

        $("[data-total-price=" + type + id + "]").text("$" + (qty * price).toFixed(2));

        var groundTotal = $.map($(".item-qty-input"), function(element) {
            var price = $(element).attr('data-price') * $(element).val();
            return Number(price.toFixed(2));
        }).reduce(function(total, num) {
            return total + num;
        });
        $("#ground-total").text("$" + (groundTotal).toFixed(2));

        var totalQty = $.map($(".item-qty-input"), function(element) {
            return $(element).val();
        }).reduce(function(total, num) {
            return Number(total) + Number(num);
        });
        totalQty += (totalQty > 1) ? " items" : " item";
        $("#total-qty").text(totalQty);
    });

    $(".remove-item-btn").click(function() {
        var type = $(this).attr('data-type');
        var id = $(this).attr('data-id');

        axios.delete('/cart/delete', {
            data: {
                type: type,
                itemId: id,
            }
        }).then(function(result) {
            location.reload();
        }).catch(function(error) {
            alert("Due to an internal error, it failed to update the cart. Sorry for the inconvenience.");
        });
    });
});
