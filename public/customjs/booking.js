// function to update price and total days
const minus = document.getElementById("Minus");
const plus = document.getElementById("Plus");
const count = document.getElementById("CountDays");
const days = document.getElementById("Days");
const duration = document.getElementById("duration");
const totalPrice = document.getElementById("Total");
const productPrice = document.getElementById("productPrice");
const defaultPrice = productPrice.value;

function updateTotalPrice() {
    let subTotal = days.value * defaultPrice;
    totalPrice.innerText = "Rp " + subTotal.toLocaleString('id-ID');
}

minus.addEventListener("click", function() {
    let currentCount = parseInt(count.innerText);
    if (currentCount > 1) {
        currentCount -= 1;
        count.innerText = currentCount;
        days.value = currentCount;
        duration.value = currentCount;
        updateTotalPrice();
    }
});

plus.addEventListener("click", function() {
    let currentCount = parseInt(count.innerText);
    currentCount += 1;
    count.innerText = currentCount;
    days.value = currentCount;
    duration.value = currentCount;
    updateTotalPrice();
});

days.addEventListener("change", function () {
    count.innerText = days.value;
    updateTotalPrice();
});

updateTotalPrice();

// funtion date
const datePicker = document.getElementById('date');
const btnText = document.getElementById('DateTriggerBtn');

datePicker.addEventListener('change', function () {
    if (datePicker.value) {
        btnText.innerText = datePicker.value
        btnText.classList.add("font-semibold");
    } else {
        btnText.innerText = "Select date"
        btnText.classList.remove("font-semibold"); 
    }
});

// funtion nav & tabs like bootstrap
document.addEventListener("DOMContentLoaded", function () {
    window.openPage = function (pageName, elmnt) {
        let i, tabcontent, tablinks;

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].classList.add("hidden");
        }

        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active", "ring-2", "ring-[#FCCF2F]");
        }
        
        document.getElementById(pageName).classList.remove("hidden");
        elmnt.classList.add("active", "ring-2", "ring-[#FCCF2F]");
    };

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
});

// funtion for changing required atribute
function toggleRequiredOptions() {
    const pickupRadio = document.getElementById('Pickup');
    const deliveryRadio = document.getElementById('Delivery');
    const storeRadios = document.getElementsByName('store_id');
    const addressTextarea = document.getElementsByName('address')[0];

    if (pickupRadio.checked) {
        storeRadios.forEach(radio => {
            radio.required = true;
        });
        addressTextarea.required = false;
    } else if (deliveryRadio.checked) {
        storeRadios.forEach(radio => {
            radio.required = false;
        });
        addressTextarea.required = true;
    }
}