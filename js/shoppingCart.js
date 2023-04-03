// var shoppingCart = [];

function addToCart(id){
    let check = getCookie("cart");
    if (check != "") {

        let obj = JSON.parse(getCookie('cart'));
        let res = [];

        for(var i in obj){
            res.push(obj[i]);
        }

        cart = JSON.stringify(res.concat(id))
        createCookie('cart', cart, 30);
    }else{
        alert("first product")
        createCookie('cart', id, 30);
    }
    viewCart();
}
function deleteCart(){
    document.cookie = "cart = ''; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

function viewCart(){
    let cart = JSON.parse(getCookie('cart'));
    if(cart == ""){
        alert("cart is empty")
    }else{
        alert(cart)
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