<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
<title>DANH SACH KHACH HANG</title>

    <link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
  integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
/>
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
  rel="stylesheet"
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
  crossorigin="anonymous"
/>
<link rel="stylesheet" href="<?= $this->url->getStatic('public/css/style.css') ?>" />

<header class="bg-black text-white p-2 fixed-top">
  <div class="container">
      <div class="d-flex align-items-center justify-content-between">
          <div class="logo" with="120">
          </div>
          <nav class="navbar navbar-expand-lg">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav ms-auto">
                      <li class="nav-item">
                          <a class="nav-link text-white" href="#home">Trang Chủ</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link text-white" href="/signup">Đăng Ký</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link text-white" href="#services">Dịch Vụ</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link text-white" href="/user/logout">Đăng Xuất</a>
                      </li>
                  </ul>
              </div>
          </nav>
      </div>
  </div>
</header>

  </head>

  <body>
    
<section class="customer">
  <div class="customer__title text-center">DANH SACH KHACH HANG</div>
  <div class="customer__list">
    <div class="customer__list--btn d-flex justify-content-between">
      <button
        type="button"
        class="btn btn-success btn-add"
        data-bs-toggle="modal"
        data-bs-target="#modalForm"
      >
      <i class="fa-solid fa-plus"></i>
      </button>
    </div>

    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Phone number</th>
          <th>Address</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody class="table-body">
        <?php foreach ($customers as $customer) { ?>
        <tr>
          <td><?= $customer->getId() ?></td>
          <td><?= $customer->getName() ?></td>
          <td><?= $customer->getPhone() ?></td>
          <td><?= $customer->getAddress() ?></td>
          <td><?= $customer->getEmail() ?></td>
          <td>
            <button
              data-id="<?= $customer->getId() ?>"
              class="btn btn-secondary btn-detail"
            >
            <i class="fa-regular fa-eye"></i>
            </button>
            <button
              class="btn btn-primary btn-update"
              data-id="<?= $customer->getId() ?>"
              data-name="<?= $customer->getName() ?>"
              data-phone="<?= $customer->getPhone() ?>"
              data-address="<?= $customer->getAddress() ?>"
              data-email="<?= $customer->getEmail() ?>"
              data-bs-toggle="modal"
              data-bs-target="#modalFormUpdate"
            >
            <i class="fa-regular fa-pen-to-square"></i>
            </button>
            <button
              data-id="<?= $customer->getId() ?>"
              data-name="<?= $customer->getName() ?>"
              class="btn btn-secondary btn-delete"
              data-bs-toggle="modal"
              data-bs-target="#modalDelete"
            >
            <i class="fa-solid fa-trash"></i>
            </button>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</section>

<div
  class="modal fade"
  id="modalForm"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Add Customer</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <form method="post" id="form" action="/admin/customer/insert">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input
              type="text"
              class="form-control"
              id="name"
              name="name"
              pattern="[a-zA-Z\s]+"
              title="Only letters and white space allowed"
              required
            />
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Phone:</label>
            <input
              type="tel"
              class="form-control"
              id="phone"
              name="phone"
              pattern="^0\d{9,10}$"
              required
            />
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Address:</label>
            <input
              type="text"
              class="form-control"
              id="address"
              pattern="[a-zA-Z0-9\s,]+"
              title="Only letters, numbers, commas and white space allowed"
              name="address"
              required
            />
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Email:</label>
            <input
              type="email"
              class="form-control"
              id="email"
              name="email"
              required
            />
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button type="submit" class="btn btn-primary" id="btn-submit">
              Add
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div
  class="modal fade"
  id="modalFormUpdate"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Update Customer</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <form method="post" id="formUpdate">
          <!-- <div class="mb-3 show-id">
            <label for="recipient-name" class="col-form-label">ID:</label>
            <input
              type="text"
              class="form-control"
              id="id"
              name="id"
              readonly
            />
          </div> -->
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input
              type="text"
              class="form-control"
              id="nameUpdate"
              name="name"
              pattern="[a-zA-Z\s]+"
              title="Only letters and white space allowed"
              required
            />
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Phone:</label>
            <input
              type="tel"
              class="form-control"
              id="phoneUpdate"
              name="phone"
              pattern="^0\d{9,10}$"
              required
            />
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Address:</label>
            <input
              type="text"
              class="form-control"
              id="addressUpdate"
              pattern="[a-zA-Z0-9\s,]+"
              title="Only letters, numbers, commas and white space allowed"
              name="address"
              required
            />
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Email:</label>
            <input
              type="email"
              class="form-control"
              id="emailUpdate"
              name="email"
              required
            />
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button type="submit" class="btn btn-primary" id="btn-submit">
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div
  class="modal fade"
  id="modalDelete"
  tabindex="-1"
  aria-labelledby="exampleModalLabel"
  aria-hidden="true"
>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
          Are you sure delete this customer?
        </h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <form method="get" id="formDelete">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">ID:</label>
            <input
              type="text"
              class="form-control"
              id="idDelete"
              name="idDelete"
              disabled
            />
          </div>
          <div class="mb-3 show-id">
            <label for="recipient-name" class="col-form-label" disabled
              >Name:</label
            >
            <input
              type="text"
              class="form-control"
              id="nameDelete"
              name="nameDelete"
              disabled
            />
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
            >
              Close
            </button>
            <button type="submit" class="btn btn-primary btn-delete-submit">
              Delete
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
 <script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
  crossorigin="anonymous"
></script>

<script
  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
  integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
></script>
<script src="<?= $this->url->getStatic('public/js/customer.js') ?>"></script>

  </body>
</html>
