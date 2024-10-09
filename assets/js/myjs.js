document.querySelectorAll('.btn-success').forEach(button => {
    button.addEventListener('click', (event) => {
        filterItems(event.target.innerText);
    });
});

document.querySelector('input[placeholder="Search ..."]').addEventListener('input', (event) => {
    const searchValue = event.target.value.toLowerCase();
    document.querySelectorAll('.card').forEach(card => {
        const cardText = card.innerText.toLowerCase();
        if (cardText.includes(searchValue)) {
            card.parentElement.style.display = 'block';
        } else {
            card.parentElement.style.display = 'none';
        }
    });
});

function addMedicineToTable(medicineName, batch, expiryDate, quantity, mrp, discount) {
    const tableBody = document.querySelector('table tbody');
    let existingRow = null;

    document.querySelectorAll('table tbody tr').forEach(row => {
        if (row.children[0].innerText === medicineName) {
            existingRow = row;
        }
    });

    if (existingRow) {
        let existingQuantity = parseInt(existingRow.children[3].innerText);
        let newQuantity = existingQuantity + quantity;
        existingRow.children[3].innerText = newQuantity;

        const total = (newQuantity * mrp) - ((newQuantity * mrp) * (discount / 100));
        existingRow.children[6].innerText = total.toFixed(2);
    } else {
        const row = document.createElement('tr');
        const total = (quantity * mrp) - ((quantity * mrp) * (discount / 100));

        row.innerHTML = `
            <td>${medicineName}</td>
            <td>${batch}</td>
            <td>${expiryDate}</td>
            <td>${quantity}</td>
            <td>${mrp}</td>
            <td>${discount}%</td>
            <td>${total.toFixed(2)}</td>
            <td><button class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
        `;
        tableBody.appendChild(row);
    }

    updateInvoiceTotals();
}

function removeRow(button) {
    const row = button.closest('tr');
    row.remove();
    updateInvoiceTotals();
}

function updateInvoiceTotals() {
    let totalAmount = 0;
    let totalDiscount = 0;
    const VAT_RATE = 5;

    document.querySelectorAll('table tbody tr').forEach(row => {
        const quantity = parseInt(row.children[3].innerText);
        const mrp = parseFloat(row.children[4].innerText);
        const discount = parseFloat(row.children[5].innerText.replace('%', ''));

        const itemTotal = quantity * mrp;
        const discountAmount = (itemTotal * discount) / 100;
        totalAmount += itemTotal;
        totalDiscount += discountAmount;
    });

    const totalVAT = (totalAmount * VAT_RATE) / 100;
    const grandTotal = (totalAmount + totalVAT) - totalDiscount;

    document.querySelector('input[name="total"]').value = totalAmount.toFixed(2);
    document.querySelector('input[name="totalDiscount"]').value = totalDiscount.toFixed(2);
    document.querySelector('input[name="totalVAT"]').value = totalVAT.toFixed(2);
    document.querySelector('input[name="grandTotal"]').value = grandTotal.toFixed(2);

    document.querySelector('.net-total').innerText = grandTotal.toFixed(2);
    calculateDueAmount();
}

function calculateDueAmount() {
    const grandTotal = parseFloat(document.querySelector('input[name="grandTotal"]').value) || 0;
    const paidAmount = parseFloat(document.getElementById('paidAmount').value) || 0;
    const dueAmount = grandTotal - paidAmount;

    document.querySelector('.due-amount').innerText = dueAmount.toFixed(2);
}
