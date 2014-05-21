<h2>Groups</h2>
<p>
<a href="{{ url.get({"for": "group-add"}) }}" >Add Group</a></li>
</p>
{% for group in groups %}
<p>
 Name: {{ group.name }}
<br>
 Description: {{ group.description }}
<br>
<a href="{{ url.get({"for": "group-subscribe","id": group.id }) }}" >Subscribe</a></li>
</p>
{% endfor  %}
<a href="{{ url.get({"for": "group"}) }}" >Return</a></li>
