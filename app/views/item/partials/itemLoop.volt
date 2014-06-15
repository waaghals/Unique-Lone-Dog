{% if items|length > 0 %}
<ul>
{% for item in items %}
    {{ partial('item/partials/listItem') }}
{% endfor  %}
</ul>
{% else %}
<p>No items</p>
{% endif %}