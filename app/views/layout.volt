<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    {% block title %} {% endblock %}
    {% include '/head.volt' %}
  </head>

  <body>
    {% block content %}{% endblock %} {% include '/foot.volt'%}
  </body>
</html>
