// var shoppingCart = [];

function addToCart(id, qty){
    let check = getCookie("cart");
    if (check != "") {
        let cart = JSON.parse(getCookie('cart'));
        if(cart[id]!= null){
            cart[id] += qty;
            newCart = JSON.stringify(cart)
            createCookie('cart', newCart, 30);
        }else{
            cart[id] = qty;

            newCart = JSON.stringify(cart)
            createCookie('cart', newCart, 30);
        }
    }else{
        let cart = {}
        cart[id] = qty;
        createCookie('cart', JSON.stringify(cart), 30);
    }
    viewCart();
}
function deleteCart(){
    document.cookie = "cart = ''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}
function changeCart(id, qty){
    let cart = [];
    cart = JSON.parse(getCookie('cart'));
    if(qty <= 0){
        location.reload()
        // cart.delete(cart[id]);
        delete cart[id];
        console.log(cart)   

    }else if(cart[id] > qty){
        cart[id] -= cart[id] - qty;
    }else if(cart[id] < qty){
        cart[id] += qty-cart[id];
    }
    createCookie('cart', JSON.stringify(cart), 30);
}

function viewCart(){
    let cart = JSON.parse(getCookie('cart'));
    if(cart == ""){
        alert("cart is empty")
    }else{
        console.log(cart)
    }
}

function createCookie(name, value, days) {
    var expires;
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toGMTString();
    }
    else {
        expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function getCookie(c_name) {
    if (document.cookie.length > 0) {
        c_start = document.cookie.indexOf(c_name + "=");
        if (c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if (c_end == -1) {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return "";
}