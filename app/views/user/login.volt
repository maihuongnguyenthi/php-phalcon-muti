{% extends 'layout.volt' %} 
{% block title %}
<title>Login</title>
{% endblock %} 
{% block content %}
<section class="login mt-5 d-flex align-items-center bg-dark">
  <div class="container">
    <div class="row">
      <div class="login__form d-flex flex-column align-items-center">
        <h3 class="login__form--title card-title text-center mt-5">Welcome Back</h3>
        {% if flashSession.has('success') %}
        <div class="alert alert-success">
          {{ flashSession.output() }}
        </div>
        {% endif %} 
        {% if flashSession.has('error') %}
        <div class="alert alert-danger">
          {{ flashSession.output() }}
        </div>
        {% endif %}
        {% if form is defined %}
        {{ form({'action': url('user/login'), 'id': 'form-login', 'role': 'form', 'method': 'post'}) }}
          <h3 class="text-center fw-bold pb-4">Welcome Back</h3>
          <div class="mb-3">
            {{ form.label('email') }}
            {{ form.render('email', {'class': 'form-control', 'aria-describedby': 'emailHelp', 'required': 'required'}) }}
          </div>
          <div class="mb-3">
            {{ form.label('pass') }}
            {{ form.render('pass', {'class': 'form-control', 'required': 'required'}) }}
          </div>
          <div class="mb-3">
            {{ form.render('Login', {'class': 'btn btn-primary w-100'}) }}
          </div>
          <div class="text-center mt-3">
            <span>Don't have an account?</span> <a href="/signup" class="text-decoration-none">Sign up here</a>
          </div>
        {{ end_form() }}
        {% else %}
        <p>Form is not available. Please check your controller for proper form initialization.</p>
        {% endif %}
      </div>
    </div>
  </div>
</section>
{% endblock %}
