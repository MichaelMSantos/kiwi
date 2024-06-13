// document.getElementById('cardNumber').addEventListener('input', function (e) {
//     let value = e.target.value.replace(/\D/g, '');
//     value = value.replace(/(.{4})/g, '$1 ').trim();
//     e.target.value = value;
// });

// document.getElementById('expDate').addEventListener('input', function (e) {
//     let value = e.target.value.replace(/\D/g, '');
//     if (value.length >= 2) {
//         value = value.slice(0, 2) + '/' + value.slice(2, 4);
//     }
//     e.target.value = value;
// });

// document.getElementById('credito').addEventListener('change', function (e) {
//     document.getElementById('parcelas').style.display = e.target.checked ? 'block' : 'none';
// });

// document.getElementById('debito').addEventListener('change', function (e) {
//     document.getElementById('parcelas').style.display = e.target.checked ? 'none' : 'block';
// });

// document.getElementById('submitBtn').addEventListener('click', function () {
//     var form = document.querySelector('.needs-validation');
//     if (form.checkValidity()) {
//         form.submit();
//         fetch('processar_pedido.php', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify(cart)
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 alert('Pedido finalizado com sucesso!');
//                 cart = [];
//                 updateCart();
//             } else {
//                 alert('Ocorreu um erro ao finalizar o pedido.');
//             }
//         })
//         .catch(error => {
//             console.error('Erro:', error);
//             alert('Ocorreu um erro ao finalizar o pedido.');
//         });
//     } else {
//         form.classList.add('was-validated');
//     }
// });
