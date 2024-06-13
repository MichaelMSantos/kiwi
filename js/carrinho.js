
let cart = [];

function addToCart(button) {
    const card = button.closest('.card');
    const itemName = card.querySelector('.card-title').textContent;
    const itemPrice = parseFloat(card.querySelector('.card-price').textContent.replace('R$', '').trim());
    const itemId = button.getAttribute('data-id');
    const itemImage = card.querySelector('.card-image').src;

    const item = {
        id: itemId,
        name: itemName,
        price: itemPrice,
        image: itemImage,
        quantity: 1
    };

    const existingItem = cart.find(i => i.id === item.id);
    if (existingItem) {
        existingItem.quantity++;
    } else {
        cart.push(item);
    }

    updateCart();
}

function updateItemQuantity(itemId, quantity) {
    const item = cart.find(item => item.id === itemId);
    if (item) {
        item.quantity = parseInt(quantity);
        if (item.quantity === 0) {
            removeFromCart(itemId);
        } else {
            updateCart();
        }
    }
}

function removeFromCart(itemId) {
    cart = cart.filter(item => item.id !== itemId);
    updateCart();
}

function updateCart() {
    const cartItemsContainer = document.getElementById('cartItems');
    const cartTotalElement = document.getElementById('cartTotal');
    const cartCountElement = document.getElementById('cart-count');

    cartItemsContainer.innerHTML = '';

    let total = 0;
    let itemCount = 0;

    cart.forEach(item => {
        const li = document.createElement('li');
        li.className = 'list-group-item d-flex justify-content-between align-items-center';
        li.innerHTML = `
    <div>
        <img src="${item.image}" alt="${item.name}" style="width: 50px; height: 50px; object-fit: cover;">
        <span>${item.name}</span>
    </div>
    <div>
        <span>R$ ${item.price.toFixed(2)}</span>
        <input type="number" class="form-control item-quantity" value="${item.quantity}" min="0" onchange="updateItemQuantity('${item.id}', this.value)">
    </div>
`;
        cartItemsContainer.appendChild(li);
        total += item.price * item.quantity;
        itemCount += item.quantity;
    });

    cartTotalElement.textContent = total.toFixed(2);
    cartCountElement.textContent = `(${itemCount})`;

    const finalizarCompraButton = document.querySelector('.finalizarCompra');
    finalizarCompraButton.addEventListener('click', finalizarCompra);

    const parcelasSelect = document.getElementById('parcelasSelect');
    const valorParceladoInput = document.getElementById('valorParcelado');

    parcelasSelect.addEventListener('change', function() {
        const valorTotal = parseFloat(cartTotalElement.textContent);
        const parcelas = parseFloat(this.value);

        if(parcelas > 0) {
            const valorParcela = valorTotal / parcelas;
        valorParceladoInput.value = valorParcela.toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'});
        } else {
            valorParceladoInput.value = '';
        }
});

}

updateCart();
