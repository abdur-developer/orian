// Initialize and set up event listeners
document.addEventListener('DOMContentLoaded', function () {
    const districtSelect = document.getElementById("district_select");
    const inside = document.getElementById("inside");
    const outside = document.getElementById("outside");
    const hub = districtSelect.getAttribute("data-hub");
    // Delivery charge update
    
    function getDeliveryCharge() {
        const checked = document.querySelector('input[name="ck_hub"]:checked');
        let delivery_amount = checked ? parseFloat(checked.getAttribute('amount')) : 0;
        return delivery_amount > 0 ? delivery_amount : 0;
    }
    
    function calculateSummary(discountValue = 0, code = '') {
        const itemPrices = document.querySelectorAll('.price-text');
        let subtotal = 0;
        itemPrices.forEach(price => {
            subtotal += parseFloat(price.textContent);
        });
        
        const hasDelivery = document.querySelector('input[name="ck_hub"]') !== null;
        let delivery = hasDelivery ? getDeliveryCharge() : 0;
        
        document.getElementById('subtotal').textContent = '৳ ' + subtotal.toFixed(2);
    
        // Update or create delivery row if needed
        if (hasDelivery) {
            let deliveryRow = document.getElementById('delivery-row');
            if (!deliveryRow) {
                deliveryRow = document.createElement('div');
                deliveryRow.className = 'summary-item';
                deliveryRow.id = 'delivery-row';
                const summary = document.querySelector('.summary');
                const subtotalRow = summary.querySelector('#subtotal').closest('.summary-item');
                summary.insertBefore(deliveryRow, subtotalRow.nextSibling);
            }
            deliveryRow.innerHTML = '<span>Delivery </span><input class="form-control" name="delivery_amount" value="' + delivery.toFixed(2) + '" readonly/>';
        } else {
            const deliveryRow = document.getElementById('delivery-row');
            if (deliveryRow) {
                deliveryRow.remove();
            }
        }
    
        let total = subtotal + delivery;
        if (discountValue > 0) {
            document.getElementById('discount-row').style.display = '';
            document.getElementById('discount-code').textContent = code;
            document.getElementById('discount-amount').textContent = '-৳' + discountValue.toFixed(2);
            total = subtotal - discountValue + delivery;
            if (total < 0) total = 0;
        } else {
            document.getElementById('discount-row').style.display = 'none';
        }
    
        document.getElementById('total').textContent = '৳ ' + total.toFixed(2);
    }
    calculateSummary();
    
    // Only add delivery change listeners if delivery options exist
    // const deliveryRadios = document.querySelectorAll('input[name="ck_hub"]');
    // if (deliveryRadios.length > 0) {
    //     deliveryRadios.forEach(function (radio) {
    //         radio.addEventListener('change', function () {
                
    //         });
    //     });
    // }

    districtSelect.addEventListener("change", function () {
        if(this.value == hub){
            inside.checked = true;
            outside.checked = false;
            // alert("insite");
        }else{
            inside.checked = false;
            outside.checked = true;
            // alert("outsite");
        }
        calculateSummary();
    });
    //==================================
    let coupons = {};
    fetch('coupons.php')
        .then(response => response.json())
        .then(data => {
            coupons = data;
        })
        .catch(() => {});
    // Coupon application
    document.querySelector('.coupon-btn').addEventListener('click', function (e) {
        e.preventDefault();
    
        const couponInput = document.getElementById('coupon-input');
        const code = couponInput.value.trim().toUpperCase();
        if (code && coupons[code]) {
            calculateSummary(coupons[code], code);
        } else {
            calculateSummary();
            if (code) {
                alert('Invalid coupon code!');
            }
        }
        
    });
    
    // Quantity update function
    function updateQuantity(inputId, change, base_price, button) {
        button.disabled = true;
        const input = document.getElementById(inputId);
        let currentValue = parseInt(input.value);
        if (isNaN(currentValue)) currentValue = 1;
        currentValue += change;
        if (currentValue > 10) currentValue = 10;
        if (currentValue < 1) currentValue = 1;
    
        const priceText = input.closest('.course-price').querySelector('.price-text');
        const newTotal = currentValue * base_price;
    
        fetch("update_quantity.php", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                quantity: currentValue,
                item_id: input.getAttribute('data-item-id')
            })
        }).then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        }).then(data => {
            if (data.success) {
                input.value = currentValue;
                priceText.textContent = newTotal.toFixed(2);
                calculateSummary();
            } else {
                alert('Failed to update quantity!');
            }
            button.disabled = false;
        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
            button.disabled = false;
        });
    }
});
