<h2>Hubs</h2>
<p>
    There are a total of <span class="text-tall">{{ groups|length}}</span> hubs. If you want, you could
    <a href="{{ url.get({"for": "group-add"}) }}" >add a Hub</a>.
</p>

    {% if groups|length > 0 %}
<ul>
        {% for group in groups %}
            {{ partial('group/partials/listItem') }}
        {% endfor  %}
</ul>
    {% else %}
<p>No hubs exists</p>
    {% endif %}

<p>
    <a href="{{ url.get({"for": "group"}) }}" >Return</a>
</p>
