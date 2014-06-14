<h2>Hubs</h2>
<p>
    There are a total of <span class="text-tall">{{ groups|length}}</span> hubs. If you want, you could
    <a href="{{ url.get({"for": "group-add"}) }}" >add a Hub</a>.
</p>

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
<p>No hubs exists</p>
    {% endif %}

<p>
    <a href="{{ url.get({"for": "group"}) }}" >Return</a>
</p>
