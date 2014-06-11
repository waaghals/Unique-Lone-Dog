<h2>Groups</h2>
{% for group in groups %}
<ul>
    <li>
        <p>
            Name: {{ group.name }} <br />
            Description: {{ group.description }} <br />
            <a href="{{ url.get({"for": "group-unsubscribe","id": group.id }) }}" >Unsubscribe</a> <br />
        </p>
    </li>
</ul>
{% endfor  %}
<a href="{{ url.get({"for": "group-explore"}) }}" >Explore Groups</a>
