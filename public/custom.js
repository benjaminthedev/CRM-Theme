

//Address

const address = document.querySelectorAll('address');
address.forEach(function (address) {
    address.innerHTML = address.textContent.replace(/,/g, '<br>');
});

//Checkout page

// finding .single-product tr and killing link
const checkout_kill = document.querySelectorAll('.page-id-21  .col-1');
checkout_kill.forEach(function (checkout_kill) {    
    checkout_kill.classList.remove("col-1");
});