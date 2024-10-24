{% extends 'layout.volt' %} {% block title%}
<title>DANH SACH KHACH HANG</title>
{% endblock %} {% block content %}
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
        {% for customer in customers %}
        <tr>
          <td>{{ customer.getId() }}</td>
          <td>{{ customer.getName() }}</td>
          <td>{{ customer.getPhone() }}</td>
          <td>{{ customer.getAddress() }}</td>
          <td>{{ customer.getEmail() }}</td>
          <td>
            <button
              data-id="{{ customer.getId() }}"
              class="btn btn-secondary btn-detail"
            >
            <i class="fa-regular fa-eye"></i>
            </button>
            <button
              class="btn btn-primary btn-update"
              data-id="{{ customer.getId() }}"
              data-name="{{ customer.getName() }}"
              data-phone="{{ customer.getPhone() }}"
              data-address="{{ customer.getAddress() }}"
              data-email="{{ customer.getEmail() }}"
              data-bs-toggle="modal"
              data-bs-target="#modalFormUpdate"
            >
            <i class="fa-regular fa-pen-to-square"></i>
            </button>
            <button
              data-id="{{ customer.getId() }}"
              data-name="{{ customer.getName() }}"
              class="btn btn-secondary btn-delete"
              data-bs-toggle="modal"
              data-bs-target="#modalDelete"
            >
            <i class="fa-solid fa-trash"></i>
            </button>
          </td>
        </tr>
        {% endfor %}
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

{% endblock %}
