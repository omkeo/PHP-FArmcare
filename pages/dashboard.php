<?php include("admin_header.php") ?>
<div class="container-fluid p-2">
  <div class="row">
    <div class="col-md-1">
      <button class="btn btn-success w-100 mt-4">All</button>
      <button class="btn btn-success w-100 mt-2">Tablet</button>
      <button class="btn btn-success w-100 mt-2">Capsule</button>
      <button class="btn btn-success w-100 mt-2">Syrup</button>
      <button class="btn btn-success w-100 mt-2">Test</button>
      <button class="btn btn-success w-100 mt-2">Electronic Toys</button>
      <button class="btn btn-success w-100 mt-2">Soft Toys</button>
    </div>
    <div class="col-md-11">
      <div class="row align-items-center">
        <div class="col-md-2 m-0 p-1">
          <input type="text" placeholder="Search ..." class="form-control" />
        </div>
        <div class="col-md-2 m-0 p-1">
          <select class="form-control">
            <option value="">Select Medicine</option>
            <option value="">Option 1</option>
            <option value="">Option 2</option>
          </select>
        </div>
        <div class="col-md-2 m-0 p-1">
          <input type="text" placeholder="Barcode or QR-code scan" class="form-control" />
        </div>
        <div class="col-md-3 m-0 p-2" style="display: flex; align-items: center;">
          <b style="margin-right: 10px;">OR</b>
          <input type="text" placeholder="Manual input barcode" class="form-control" style="flex: 1;" />
        </div>
        <div class="col-md-3 m-0 p-2">
          <div style="display: flex; align-items: center;">
            <input type="text" placeholder="Walking Customer" class="form-control" style="flex: 1; margin-right: 1px;" />
            <button class="btn btn-success">+</button>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 row m-0 ">
          <div class="col-md-4 p-1">
            <div class="card" style="width: 100%;" onclick="addMedicineToTable('Capsule1', 'B12', '2024-09-20', 1, 450, 10)">
              <img src="../assets/img/capsule.jpeg" class="card-img-top" alt="Card image" />
              <div class="card-body">
                <span class="card-title">Capsule</span>
              </div>
            </div>
          </div>
          <div class="col-md-4 p-1">
            <div class="card" style="width: 100%;" onclick="addMedicineToTable('Capsule', 'B123', '2024-09-20', 1, 500, 10)">
              <img src="../assets/img/capsule.jpeg" class="card-img-top" alt="Card image" />
              <div class="card-body">
                <span class="card-title">Capsule</span>
              </div>
            </div>
          </div>
          <div class="col-md-4 p-1">
            <div class="card" style="width: 100%;" onclick="addMedicineToTable('Capsule', 'B123', '2024-09-20', 1, 500, 10)">
              <img src="../assets/img/capsule.jpeg" class="card-img-top" alt="Card image" />
              <div class="card-body">
                <span class="card-title">Capsule</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <table class="w-100 text-center table-striped table-bordered">
            <thead>
              <td>Medicine Info <span class="text-danger">*</span></td>
              <td>Batch</td>
              <td>Expire Date</td>
              <td>Quantity <span class="text-danger">*</span></td>
              <td>M.R.P <span class="text-danger">*</span></td>
              <td>Discount %</td>
              <td>Total</td>
              <td>Action</td>
            </thead>
            <tbody>
            </tbody>
          </table>
          <div class="text-end p-3">
            <div>
              <label for="">Total : </label>
              <input type="text" name="total" placeholder="0.00" disabled>
            </div>
            <div class="mt-2">
              <label for="">Discount % : </label>
              <input type="text" name="totalDiscount" placeholder="0.00" disabled>
            </div>
            <div class="mt-2">
              <label for="">Total VAT : </label>
              <input type="text" name="totalVAT" placeholder="0.00" disabled>
            </div>
            <div class="mt-2">
              <label for="">Grand Total: </label>
              <input type="text" name="grandTotal" placeholder="0.00" disabled>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="row bg-white m-1" style="position:absolute;bottom:0px;">
      <div class="col-md-12 p-3 row">
        <div class="col-md-6" style="display: flex; align-items: center;">
          <div class="col-md-4">
            <p>Net Total : <b class="net-total">0.00</b></p>
          </div>
          <div class="col-md-4">
            <label for="">Paid Amount</label>
            <input type="text" name="" id="paidAmount" placeholder="0.00" oninput="calculateDueAmount()">
          </div>
          <div class="col-md-4">
            <p>Due Amount: <b class="due-amount">0.00</b></p>
          </div>

        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-4">
              <button class="btn btn-warning w-100">Full Paid</button>
            </div>
            <div class="col-md-4">
              <button class="btn btn-success w-100">Cash Payment</button>
            </div>
            <div class="col-md-4">
              <button class="btn btn-primary w-100">Bank Payment</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
<?php include("footer.php") ?>