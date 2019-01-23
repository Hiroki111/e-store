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

        $(".update-item-btn[data-type=" + type + "][data-id=" + id + "]").show();
    });

    $(".update-item-btn").click(function() {
        var type = $(this).attr('data-type');
        var id = $(this).attr('data-id');
        var qty = $(".item-qty-input[data-type=" + type + "][data-id=" + id + "]").val();

        axios.put('/cart/' + type + '/' + id, {
            qty: qty
        }).then(function(result) {
            alert("Successfully updated the quantity.");
            console.log('#' + type + '-' + id + '-tr');
            console.log('Number(qty)', Number(qty));
            if (Number(qty) < 1) {
                $('#' + type + '-' + id + '-tr').hide();
            }
        }).catch(function(error) {
            alert("Due to an internal error, it failed to update the cart. Sorry for the inconvenience.");
        });
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
