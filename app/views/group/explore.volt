<h2>Groups</h2>
<p>
    <a href="{{ url.get({"for": "group-add"}) }}" >Add Group</a></li>
</p>
<ul>
    {% for group in groups %}
    {{ partial('group/partials/listItem') }}
    {% endfor  %}
</ul>
<p>
    <a href="{{ url.get({"for": "group"}) }}" >Return</a>
</p>