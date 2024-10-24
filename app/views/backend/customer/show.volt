{% extends 'layout.volt' %} {% block title%}
<title>Detail Customer</title>
{% endblock %} {% block content %}
<section class="customer__detail">
  <span class="customer__title">Information Detail</span>
  <div class="customer__detail--info">
    ID:
    <span id="id" class="">{{ customer.id }}</span
    ><br /><br />
    Name:
    <span id="name" class="">{{ customer.name }}</span
    ><br /><br />
    Phone:
    <span id="phone" class="">{{ customer.phone }}</span
    ><br /><br />
    Address:
    <span id="address">{{ customer.address }}</span
    ><br /><br />
    Email: <span id="email">{{ customer.email }}</span
    ><br /><br />
  </div>
  <button class="btn btn-dark btn-back">
    <i class="fa-solid fa-left-long"></i> Back
  </button>
</section>
{% endblock %}
