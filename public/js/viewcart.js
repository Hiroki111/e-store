$(document).ready(function() {
    var state = {
        updatedItems: {}
    };

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

        if (!state.updatedItems[type]) state.updatedItems[type] = {};

        state.updatedItems[type][id] = true;
    });

    $(".update-item-btn").click(function() {
        var type = $(this).attr('data-type');
        var id = $(this).attr('data-id');
        var qty = $(".item-qty-input[data-type=" + type + "][data-id=" + id + "]").val();

        if (Number(qty) < 1) {
            alert('The quantity must be at least 1.');
            $(".item-qty-input[data-type=" + type + "][data-id=" + id + "]").val(1);
            return;
        }

        axios.put('/cart/' + type + '/' + id, {
            qty: qty
        }).then(function(result) {
            alert("Successfully updated the quantity.");

            $(".update-item-btn[data-type=" + type + "][data-id=" + id + "]").hide();
            delete state.updatedItems[type][id];
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

    $('.viewcart-link').click(function() {
        for (var itemType in state.updatedItems) {
            if (_.size(state.updatedItems[itemType]) > 0) {
                return confirm('Updating item(s) has not been completed yet. Would you like to move to another page?');
            }
        }

        return true;
    });
});
