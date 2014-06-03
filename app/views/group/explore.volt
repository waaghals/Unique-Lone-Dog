<h2>Groups</h2>
<p>
    <a href="{{ url.get({"for": "group-add"}) }}" >Add Group</a>

<ul>
    {% for group in groups %}
    {% set inGroup = false %}
    {% for gr in user.groups %}
    {% if gr == group %}
    {% set Group = true %}
    {% endif %}
    {% endfor %}
    <li>
        <p>Name: {{ group.name }}</p>
        <p>Description: {{ group.description }}</p>
        <p>
            {% if inGroup %}
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


