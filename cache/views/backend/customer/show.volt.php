<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
<title>Detail Customer</title>

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
                          <a class="nav-link text-white" href="/product">Trang Chủ</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link text-white" href="/signup">Đăng Ký</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link text-white" href="/product">Dịch Vụ</a>
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
    
<section class="customer__detail">
  <span class="customer__title">Information Detail</span>
  <div class="customer__detail--info">
    ID:
    <span id="id" class=""><?= $customer->id ?></span
    ><br /><br />
    Name:
    <span id="name" class=""><?= $customer->name ?></span
    ><br /><br />
    Phone:
    <span id="phone" class=""><?= $customer->phone ?></span
    ><br /><br />
    Address:
    <span id="address"><?= $customer->address ?></span
    ><br /><br />
    Email: <span id="email"><?= $customer->email ?></span
    ><br /><br />
  </div>
  <button class="btn btn-dark btn-back">
    <i class="fa-solid fa-left-long"></i> Back
  </button>
</section>
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
