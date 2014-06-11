<h2>Groups</h2>
<p>
        <a href="{{ url.get({"for": "group-add"}) }}" >Add Group</a></li>
</p>
<ul>
{% for group in groups %}
<li>
<p>
        Name: {{ group.name }}
<br>
        Description: {{ group.description }}
<br>
        {% set hasGroup = false %}
        {% for gr in user.groups %}

                {% if gr == group %}
                        {% set hasGroup = true %}
                {% endif %}

        {% endfor %}

    {% if hasGroup %}
        <a href="{{ url.get({"for": "group-unsubscribe","id": group.id }) }}" >Unsubscribe</a>
    {% else %}
        <a href="{{ url.get({"for": "group-subscribe","id": group.id }) }}" >Subscribe</a>
    {% endif %}
</p>
</li>
{% endfor  %}
</ul>
<p>
<a href="{{ url.get({"for": "group"}) }}" >Return</a>
</p>