{% extends 'layout.volt' %}

{% block title %}
  <title>Product List</title>
{% endblock %}

{% block content %}

<section class="product">
  <div class="product__title py-12 text-center">BEST SELLING PRODUCTS</div>
  <div class="product__list">
    <div class="row">
      {% for product in products %}
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="card h-100">
          <img src="https://toquoc.mediacdn.vn/w660/Uploaded/uopuoka/2016_05_08/anh3.jpg" class="card-img-top" alt="{{ product.getName() }}">
          <div class="card-body">
            <h5 class="card-title">{{ product.getName() }}</h5>
            <p class="card-text text-danger">{{ product.getPrice() }}</p>
            <p class="card-text">{{ product.getDescription() }}</p>
          </div>
        </div>
      </div>
      {% endfor %}
    </div>
  </div>
</section>

<style>
  .product__title {
    font-weight: bold;
    font-size: 2em;
    margin-top: 100px;
    margin-bottom: 30px;
  }
</style>
{% endblock %}
