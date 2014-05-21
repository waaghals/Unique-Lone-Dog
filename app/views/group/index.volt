<h2>Groups</h2>
{% for group in groups %}
<p>
 Name: {{ group.name }}
<br>
 Description: {{ group.description }}
<br>
<a href="{{ url.get({"for": "group-unsubscribe","id": group.id }) }}" >Unsubscribe</a></li>
</p>
{% endfor  %}
<a href="{{ url.get({"for": "group-explore"}) }}" >Explore Groups</a></li>