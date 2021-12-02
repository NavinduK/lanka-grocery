const cartBtn = document.querySelector('.prod-cart-btn')
const spanCartItems = document.querySelector('.span-cart')
const quantityBtn = document.querySelector('.qty-btn > input')
console.log(quantityBtn.value)
let productObj = {}

document.addEventListener('DOMContentLoaded', () => {
    // onLoad addtocart number
    addToCartNumber()

})

//this function never run on event listener, Load on windows Load.
function addToCartNumber() {
    let addToCartNumbers = localStorage.getItem('cartNumbers')
    spanCartItems.innerHTML = addToCartNumbers;
}

// when clicked on add cart button
cartBtn.addEventListener('click', (e) => {
    // Debugger
    // find item details
    const title = cartBtn.parentElement.parentElement.children[1].innerHTML
    let image = cartBtn.parentElement.parentElement.parentElement.children[0].children[0].attributes[0].nodeValue
    const price = parseInt(cartBtn.parentElement.parentElement.children[4].children[0].innerHTML)
    productObj = {
        title,
        price,
        image
    }
    addToCart(productObj)
})

// when admin on update 
function updateForm(){
    var upB = document.getElementById("update-form");
    var prB = document.getElementById("product-data");
    upB.style.display = "block";
    prB.style.display  = "none";
}

// when admin on add new 
function addForm(){
    var upB = document.getElementById("add-form");
    upB.style.display = "block";
}

// add item to cart
function addToCart(product) {
    console.log('prdct', product)

    // grt qty area value
    let inCart = parseInt(quantityBtn.value)
    console.log('Quantity', inCart)
    console.log({ ...product, inCart })

    //sent clicked item data with qty
    cartNumber({ ...product, inCart, })
}

// set numbers on addtocart span
function cartNumber(product) {
    // get local storage cart number
    let productNumbers = parseInt(localStorage.getItem('cartNumbers'));
    if (productNumbers) {
        localStorage.setItem('cartNumbers', productNumbers + product.inCart)
        spanCartItems.innerHTML = productNumbers + product.inCart
    }
    else {
        localStorage.setItem('cartNumbers', 1)
        spanCartItems.innerHTML = 1
    }
    setItems(product)
}

// add cart items to local storage
function setItems(products) {
    let cartItem = localStorage.getItem('productsCart')
    cartItem = JSON.parse(cartItem)
    console.log('my product is 2', products)

    // check if item adding is already exist on cart
    if (cartItem != null) {
        if (cartItem[products.title] == undefined) {
            cartItem = {
                ...cartItem,
                [products.title]: products
            }
        } else {
            cartItem[products.title].inCart += products.inCart
        }
    }
    else {
        // add a new cart item if not exist
        products.inCart = 1
        cartItem = {
            [products.title]: products
        }
    }
    // set localstorage
    localStorage.setItem('productsCart', JSON.stringify(cartItem))

    totalCost(products)
}

//Set total cost in local storage  
function totalCost(product) {
    // const price = parseInt(product.price)
    console.log('price of product', product.price)
    let totalCost = localStorage.getItem('totalCost')
    console.log('my total cost is ', totalCost)

    // add newly aded price to local storage total or new total
    if (totalCost != null) {
        totalCost = parseInt(totalCost)
        localStorage.setItem('totalCost', totalCost + (product.price * product.inCart))
    } else {
        localStorage.setItem('totalCost', product.price)
    }
}