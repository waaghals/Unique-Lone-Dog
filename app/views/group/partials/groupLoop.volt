{% if groups|length > 0 %}
        {% for group in groups %}
            {% if loop.first %}
<ul>
                    {% endif %}
                            {{ partial('group/partials/listItem') }}
                    {% if loop.last %}
</ul>
            {% endif %}
        {% endfor  %}
    {% else %}
<p>No hubs</p>
    {% endif %}