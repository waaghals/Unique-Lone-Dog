<h2>Groups</h2>
{% for group in groups %}
<p>
 Name: {{ group.name }}
<br>
 Description: {{ group.description }}
</p>
{% endfor  %}
<a href="{{ url.get({"for": "group-add"}) }}" >Add Group</a></li>