
const spanCart2 = document.querySelector('.span-cart')

document.addEventListener('DOMContentLoaded', () => {
    // onLoad addtocart number
    addToCartNumber()
})

// checking cart number
function addToCartNumber(){
    let addToCartNumbers = localStorage.getItem('cartNumbers')
    spanCart2.innerHTML = addToCartNumbers;
    if (addToCartNumbers == null) {
        spanCart2.style.display = 'none';
    }
}