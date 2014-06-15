{% if groups|length > 0 %}
<ul>
{% for group in groups %}
    {{ partial('group/partials/listItem') }}
{% endfor  %}
</ul>
{% else %}
<p>No hubs</p>
{% endif %}