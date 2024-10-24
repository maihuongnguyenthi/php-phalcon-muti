{% extends 'layout.volt' %} {% block title %}
<title>Sign up</title>
{% endblock %} {% block content %}
<section class="login mt-4 d-flex align-items-center bg-dark">
  <div class="container mt-8">
    <div class="row">
      <div class="login__form d-flex flex-column align-items-center">
        <div class="login__form--title mt-5">Sign Up</div>
        {% if flashSession.has('error') %}
        <div class="alert alert-danger">
          {{ flashSession.output() }}
        </div>
        {% endif %}
        {% if form is defined %}
        {{ form({'action': url('user/signup'), 'id': 'form-login', 'role': 'form', 'method': 'post'}) }}
          <div class="mb-3">
            {{ form.label('name') }}
            {{ form.render('name', {'class': 'form-control', 'aria-describedby': 'emailHelp', 'required': 'required'}) }}
          </div>
          <div class="mb-3">
            {{ form.label('phone') }}
            {{ form.render('phone', {'class': 'form-control', 'aria-describedby': 'emailHelp', 'required': 'required'}) }}
          </div>
          <div class="mb-3">
            {{ form.label('address') }}
            {{ form.render('address', {'class': 'form-control', 'aria-describedby': 'emailHelp', 'required': 'required'}) }}
          </div>
          <div class="mb-3">
            {{ form.label('email') }}
            {{ form.render('email', {'class': 'form-control', 'aria-describedby': 'emailHelp', 'required': 'required'}) }}
          </div>
          <div class="mb-3">
            {{ form.label('pass') }}
            {{ form.render('pass', {'class': 'form-control', 'required': 'required'}) }}
          </div>
          <div class="mb-3">
            {{ form.render('signup', {'class': 'btn btn-primary'}) }}
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
