// resources/js/cart.js
document.addEventListener("DOMContentLoaded", function () {
    // Handle Add to Cart
    const addToCartButtons = document.querySelectorAll(".add-to-cart");

    addToCartButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const productId = this.dataset.productId;
            const name = this.dataset.name;
            const price = this.dataset.price;
            const image = this.dataset.image;

            fetch("/cart/add", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify({
                    product_id: productId,
                    name: name,
                    price: price,
                    image: image,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        updateCartDisplay(data.cart);
                    }
                });
        });
    });

    // Update quantity
    function updateQuantity(productId, quantity) {
        fetch("/cart/update", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    loadCartItems();
                }
            });
    }

    // Remove item
    function removeItem(productId) {
        fetch("/cart/remove", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
            body: JSON.stringify({
                product_id: productId,
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    loadCartItems();
                }
            });
    }

    // Load cart items
    function loadCartItems() {
        fetch("/cart/items")
            .then((response) => response.json())
            .then((data) => {
                updateCartDisplay(data.cart);
            });
    }

    // Update cart display
    function updateCartDisplay(cart) {
        const cartContainer = document.querySelector(".space-y-4");
        let cartHTML = "";
        let subtotal = 0;

        Object.keys(cart).forEach((productId) => {
            const item = cart[productId];
            subtotal += item.price * item.quantity;

            cartHTML += `
                <div class="flex items-center justify-between pb-4 border-b">
                    <div class="flex items-center space-x-4">
                        <img src="data:image/jpeg;base64,${item.image}" alt="${
                item.name
            }"
                            class="w-16 h-16 rounded-md object-cover" />
                        <div>
                            <h4 class="font-medium">${item.name}</h4>
                            <p class="text-sm text-gray-500">Rp ${new Intl.NumberFormat(
                                "id-ID"
                            ).format(item.price)}</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="flex items-center space-x-2">
                            <button onclick="updateQuantity(${productId}, ${
                item.quantity - 1
            })"
                                class="w-6 h-6 rounded-full bg-gray-100 text-gray-600 hover:bg-red-100 hover:text-red-500">-</button>
                            <span class="text-gray-600">${item.quantity}</span>
                            <button onclick="updateQuantity(${productId}, ${
                item.quantity + 1
            })"
                                class="w-6 h-6 rounded-full bg-gray-100 text-gray-600 hover:bg-red-100 hover:text-red-500">+</button>
                        </div>
                        <button onclick="removeItem(${productId})" class="text-red-500 hover:text-red-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            `;
        });

        const tax = subtotal * 0.1;
        const total = subtotal + tax;

        cartHTML += `
            <div class="pt-4 border-t">
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="font-medium">Rp ${new Intl.NumberFormat(
                        "id-ID"
                    ).format(subtotal)}</span>
                </div>
                <div class="flex justify-between mb-4">
                    <span class="text-gray-600">Tax (10%)</span>
                    <span class="font-medium">Rp ${new Intl.NumberFormat(
                        "id-ID"
                    ).format(tax)}</span>
                </div>
                <div class="flex justify-between text-lg font-semibold">
                    <span>Total</span>
                    <span>Rp ${new Intl.NumberFormat("id-ID").format(
                        total
                    )}</span>
                </div>
            </div>
        `;

        cartContainer.innerHTML = cartHTML;
    }

    // Initial load
    loadCartItems();
});
