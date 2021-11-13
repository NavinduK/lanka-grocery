//get html tag elements
const subTotal = document.querySelector('.Total')
const displayCartTable = document.querySelector('.displayCart')
const grandTotalAmount = document.querySelector('.grandTotal')
const checkoutValidation = document.querySelector('.checkout-validation')
const spanCart = document.querySelector('.span-cart')
const proceedCheckout = document.getElementById('proceedToCheck');

document.addEventListener('DOMContentLoaded', () => {
    // onLoad addtocart number
    addToCartNumber()
})


//this function never run on event listener, Load on windows Load.
function addToCartNumber() {
    let addToCartNumbers = localStorage.getItem('cartNumbers')
    spanCart.innerHTML = addToCartNumbers;

}

// set cart number in local storage
function cartNumbers(product, action) {
    let productNumbers = parseInt(localStorage.getItem('cartNumbers'))
    console.log('from cart function', productNumbers)

    // if user pressed cart number increase button or decrease button
    if (action === "decrease") {
        localStorage.setItem("cartNumbers", productNumbers - 1);
        // debugger
        spanCart.innerHTML = productNumbers - 1;
        console.log("decrease action running");
    }
    else if (action === "increase") {
        localStorage.setItem("cartNumbers", productNumbers + 1);
        spanCart.innerHTML = productNumbers + 1;
        console.log("increase action running");
    }
    setCartValue()
}

//Set total cost in local storage
function totalCost(product, action) {
    console.log('price of product', product.price)
    let totalCost = parseInt(localStorage.getItem('totalCost'))
    console.log('my total cost is ', totalCost)

    if (action == "decrease") {
        localStorage.setItem('totalCost', totalCost - product.price)
    } else if (action == "increase") {
        localStorage.setItem('totalCost', totalCost + product.price)

    }
    setCartValue()
}

showProducts()
//  Show cart items
async function showProducts() {
    // debugger
    try {
        let cart = await JSON.parse(localStorage.getItem("productsCart"))
        console.log('my cart items', cart)
        // if no items on cart
        if (cart === null) {
            swal({
                title: "There is no ITEM in your cart!",
                icon: "info",
            })
        }
        else {
            // show cart table rows
            let result = ""
            Object.values(cart).map((item, index) => {
                result += `
            <tr>
            <th>${index + 1}</th>
            <th scope="col"><img src=${item.image} alt="product-img" width="50" id="table-img"></th>
            <td data-label="Item Name" colspan="2">${item.title}</td>
            <td data-label="Price" colspan="2">${item.price} /-Rs</td>
            <td data-label="Quantity" colspan="2">
            <i class="fas fa-chevron-left"></i>
            <b class='quantity '>${item.inCart}</b>
            <i class="fas fa-chevron-right"></i>
            </td>
            <td data-label="Sub Total" colspan="2">${item.price * item.inCart} /-Rs</td>
            <td class= "remove-btn" ><i class="fas fa-trash-alt"></i></td>
            </tr>
            `
            })
            displayCartTable.innerHTML = result

        }
        setCartValue()
        manageQuantity()
        removeItem()
    }
    catch (error) {
        console.log(error)
    }
}

// set total and sub total
function setCartValue() {
    let totalCost = JSON.parse(localStorage.getItem('totalCost'))
    // alert user cannot proceed if cost < 300
    if (totalCost < 300) {
        checkoutValidation.style.display = " block "
    }
    else {
        checkoutValidation.style.display = " none "
    }
    subTotal.innerText = totalCost + " /- Rs"
    grandTotalAmount.innerText = totalCost + 200 + " /- Rs"
}

// removing cart item by delete button
function removeItem() {
    // get the cart details
    let cartItems = JSON.parse(localStorage.getItem("productsCart"))
    let totalCost = JSON.parse(localStorage.getItem('totalCost'))
    let cartNumber = JSON.parse(localStorage.getItem('cartNumbers'))
    // get remove button
    const removeBtn = document.querySelectorAll('.fa-trash-alt')
    let productName;
    // console.log('my cart item ', cartItems)

    // loop from remove buttons and find the clicked butto to remove that item from cart
    for (let i = 0; i < removeBtn.length; i++) {
        let button = removeBtn[i]
        button.addEventListener('click', () => {
            console.log('click')
            productName = button.parentElement.parentElement.children[2].innerHTML
            console.log(productName)
            // debugger
            console.log('cartnumbers***', cartNumber - cartItems[productName].inCart)
            spanCart.innerText = cartNumber - cartItems[productName].inCart
            localStorage.setItem('cartNumbers', cartNumber - cartItems[productName].inCart)
            localStorage.setItem('totalCost', totalCost - (cartItems[productName].price * cartItems[productName].inCart))
            // delete and set cart again
            delete cartItems[productName]
            localStorage.setItem('productsCart', JSON.stringify(cartItems))

            showProducts()
        })
    }
}

// Manage the quantity increase decrease behaviour
function manageQuantity() {
    // get buttons
    const decreaseButtons = document.querySelectorAll('.fa-chevron-left')
    const increaseButtons = document.querySelectorAll('.fa-chevron-right')
    const cartItems = JSON.parse(localStorage.getItem('productsCart'))

    let currentQuantity = 0;
    let currentProductName = ""

    // loop to find the relevent cart item
    for (let i = 0; i < increaseButtons.length; i++) {
        //Decrease button action
        decreaseButtons[i].addEventListener('click', () => {
            console.log('From decrease button', cartItems)
            // debugger
            currentQuantity = decreaseButtons[i].parentElement.innerText
            console.log('current quantity', currentQuantity)
            currentProductName = decreaseButtons[i].parentElement.previousElementSibling.previousElementSibling.innerHTML
            console.log('current product', currentProductName)

            if (cartItems[currentProductName].inCart > 1) {
                cartItems[currentProductName].inCart -= 1;

                // sent action to functions for update
                cartNumbers(cartItems[currentProductName], "decrease")
                totalCost(cartItems[currentProductName], "decrease")

                localStorage.setItem('productsCart', JSON.stringify(cartItems))

                showProducts()
            }
        })
        //Increase button action
        increaseButtons[i].addEventListener('click', () => {
            console.log('From increase button', cartItems)
            currentQuantity = decreaseButtons[i].parentElement.innerText
            currentProductName = decreaseButtons[i].parentElement.previousElementSibling.previousElementSibling.innerHTML

            cartItems[currentProductName].inCart += 1;
            cartNumbers(cartItems[currentProductName], "increase");
            totalCost(cartItems[currentProductName], "increase");
            localStorage.setItem('productsCart', JSON.stringify(cartItems));
            // spanCart.innerText = cartNumber +  cartItems[currentProductName].inCart

            showProducts()
        })
    }
}

// if user pressed Preceed checkout
proceedCheckout.addEventListener('click', (e) => {
    e.preventDefault();
    console.log('Clicked');
    let cart = JSON.parse(localStorage.getItem("productsCart"));
    let totalCost = JSON.parse(localStorage.getItem('totalCost'))
    // cannot continue if cart total<300 and no items in cart ( then print alerts)
    if (cart === null) {
        swal({
            title: "1st Add Items To Your Cart !!",
            icon: "info",
        });
    } else if (totalCost < 300) {
        swal({
            title: "Order Must Be Greater Then Rs. 300/-",
            icon: "info",
        });
    }
    else {
        // send promo code to the proceed page in url get method
        const promocode = document.getElementById('promo');
        if (promocode.value.length != 0) {
            window.location.href = './proceed.php?promo=' + promocode.value;
        } else {
            window.location.href = './proceed.php';
        }
    }
})
