

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

//Menu - Adding a class
let findMenuCheckOut = document.querySelector('.wpmenucartli');
console.log(findMenuCheckOut);

findMenuCheckOut.classList.add('menu_button');
console.log('class added');
console.log(findMenuCheckOut);

//shop_table woocommerce-checkout-review-order-table

