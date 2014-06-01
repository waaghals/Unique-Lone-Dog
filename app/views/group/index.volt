<h2>Groups</h2>
{% for group in groups %}
<ul>
    <li>
        <p>
            Name: {{ group.name }}
        </p>
        <p>
            Description: {{ group.description }}
        </p>
        <p>
            <a href="{{ url.get({"for": "group-unsubscribe","id": group.id }) }}" >Unsubscribe</a>
        </p>
    </li>
</ul>
{% endfor  %}
<a href="{{ url.get({"for": "group-explore"}) }}" >Explore Groups</a>
