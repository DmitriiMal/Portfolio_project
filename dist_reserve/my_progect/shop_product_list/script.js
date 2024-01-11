const products = JSON.parse(productsStr);

// console.table(products);

//current object formatter
const currencyFormater = new Intl.NumberFormat('de-AT', {
  style: 'currency',
  currency: 'EUR',
});

//select the products and add items dynamically
let productsRow = document.querySelector('.product-list');

for (let product of products) {
  productsRow.innerHTML += `
  <div class="col-sm-6 col-md-4 col-lg-3">
          <section class="card panel shadow">
            <div class="pro-img-box">
              <img
                src="${product.img}"
                alt />
              <a href="#" class="adtocart">
                <i class="fa fa-shopping-cart"></i>
              </a>
            </div>
            <div class="panel-body text-center">
              <h4>
                <a href="#" class="pro-title">${product.name}</a>
              </h4>
              <p>${product.description}</p>
              <p class="price">${currencyFormater.format(product.price)}</p>
            </div>
          </section>
        </div>

  `;
}

//product button selected
const addToCartBtn = document.querySelectorAll('.adtocart');

//cart declared
const cart = [];

//adds product to cart
const addToCart = (product) => {
  if (cart.find((val) => val.name == product.name)) {
    // console.log(cart.find((val) => val.name == product.name));
    product.quantity++;
  } else {
    cart.push(product);
  }
  // console.table(cart);
  createRows();
  cartTotal();
};

//add event to add to cart buttons
addToCartBtn.forEach((btn, i) => {
  btn.addEventListener('click', () => {
    addToCart(products[i]);
    // console.table(cart);
  });
});

const createRows = () => {
  let result = '';
  for (let item of cart) {
    result += `
        <div class="panel-body my-cart shadow">
          <img
            src="${item.img}"
            alt="${item.name}" />
          <h5>${item.name}</h5>
          <button class="btn plus"><i class="fa-solid fa-plus"></i></button>
          <p>${item.quantity}</p>
          <button class="btn minus"><i class="fa-solid fa-minus"></i></button>
          <button class="btn del"><i class="fa-solid fa-trash"></i></button>
          <p class="price">${currencyFormater.format(item.price)}</p>
        </div>
    `;
  }

  document.querySelector('.cart').innerHTML = result;
  const plusBtns = document.querySelectorAll('.plus');
  const minusBtns = document.querySelectorAll('.minus');
  const deleteBtns = document.querySelectorAll('.del');

  plusBtns.forEach((btn, i) => {
    btn.addEventListener('click', () => {
      plusQtty(i);
    });
  });

  minusBtns.forEach((btn, i) => {
    btn.addEventListener('click', () => {
      minusQtty(i);
    });
  });

  deleteBtns.forEach((btn, i) => {
    btn.addEventListener('click', () => {
      deleteItem(i);
    });
  });
};

//updates the cart total amount
const cartTotal = () => {
  let amound = 0;
  let priceSum = 0;
  let discount = 10;
  let total = 0;
  for (const item of cart) {
    priceSum += item.price * item.quantity;
  }
  cart.forEach((product) => {
    amound += product.quantity;
  });

  if (amound == 0) {
    document.getElementById('cart-price').innerHTML = `
    <h3 class="text-center">Your cart is empty  <i class="fa-solid fa-wind"></i></h3>
  `;
  } else if (priceSum >= 200) {
    total = priceSum - (priceSum * discount) / 100;
    document.getElementById('cart-price').innerHTML = `
  <p class="text-right">You have ${amound} items in your cart</p>
  <p class="text-right">Price: ${currencyFormater.format(priceSum)}</p>
  <p class="text-right discount">Discount: ${discount}&percnt;</p>
  <h3 class="text-right">Total: ${currencyFormater.format(total)}</h3>
  `;
  } else {
    document.getElementById('cart-price').innerHTML = `
  <p class="text-right">You have ${amound} items in your cart</p>
  <h3 class="text-right">Total: ${currencyFormater.format(priceSum)}</h3>
  <p class="text-right discount">Order over &euro; 200 and get your discount 10&percnt;!</p>
  `;
  }
};

//increases item quantity
const plusQtty = (index) => {
  cart[index].quantity++;
  createRows();
  cartTotal();
};

//decreases item quantity
const minusQtty = (index) => {
  if (cart[index].quantity == 1) {
    cart.splice(index, 1);
  } else {
    cart[index].quantity--;
  }
  createRows();
  cartTotal();
};

//deletes item from cart
const deleteItem = (index) => {
  cart[index].quantity = 1;
  cart.splice(index, 1);
  createRows();
  cartTotal();
};
