{{ content() }}
{{ form() }}
{% for element in form %}
{% if get_class(element) == "Phalcon\Forms\Element\Hidden" %}

{{ element.render() }}

{% else %}
{# default field template #}

{{ get_class(element) }}
<div class="row">
    <div class="grid-fourth">
        {{ element.label() }}
    </div>
    <div class="grid-three-fourths">
        {{ element.render() }}
    </div>
</div>
{% endif %}



{% endfor %}
{{ link_to("account/forgotPassword", "Forgot my password") }}
{{ end_form() }}
