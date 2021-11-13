// promo code presets
const promoCodes = [
    { code: "hi500", val: 500 },
    { code: "lanka350", val: 350 },
    { code: "free200", val: 200 },
];

document.addEventListener('DOMContentLoaded', () => {
    // onLoad addtocart number
    setCartValue();
})

// set the cart value and total calculations
const setCartValue = () => {
    const noofItems = document.getElementById('numItem');

    // set cart number of the right sidebar
    let addToCartNumbers = localStorage.getItem('cartNumbers')
    noofItems.innerHTML = addToCartNumbers;

    // get total form localsotarage
    let totalCost = JSON.parse(localStorage.getItem('totalCost'));
    // get the html tags to print details
    const subTotal = document.querySelector('.Total');
    const grandTotalAmount = document.querySelector('.grandTotal')
    const promotionVal = document.querySelector('.promoValue')

    // Performing a get request without calling http (Just string operations)
    var url = location.href;
    var urlCode = url.substring(url.indexOf("?") + 1).split("=")[1];
    
    var promoVal = 0;
    console.log(urlCode);
    // Check Offer Codes from pre set promo codes
    switch (urlCode) {
        case promoCodes[0].code:
            promoVal = promoCodes[0].val;
            document.getElementById('promo_code').value = urlCode;
            break;
        case promoCodes[1].code:
            promoVal = promoCodes[1].val;
            document.getElementById('promo_code').value = urlCode;
            break;
        case promoCodes[2].code:
            promoVal = promoCodes[2].val;
            document.getElementById('promo_code').value = urlCode;
            break;
        default:
            promoVal = 0;
            document.getElementById('promo_code').value = "-";
            break;
    }

    // set total costs and promo values
    subTotal.innerText = totalCost + " /- Rs"
    promotionVal.innerHTML = "- " + promoVal + " /- Rs"
    grandTotalAmount.innerText = totalCost + 200 - promoVal + " /- Rs"
    document.getElementById('total_price').value = totalCost + 200 - promoVal;

    // set product names to input field to store in db
    const productsCart = JSON.parse(localStorage.getItem('productsCart'))
    let productsName = [];
    for (const [key, value] of Object.entries(productsCart)) {
        productsName = [...productsName, value.title + ":" + value.inCart];
    }
    document.getElementById('product_name').value = productsName.join();
    console.log(productsName.join())
}
