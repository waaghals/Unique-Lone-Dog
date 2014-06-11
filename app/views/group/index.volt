<h2>Your groups</h2>
<ul>
    {% for group in groups %}
    {{ partial('group/partials/listItem') }}
    {% endfor  %}
</ul>
<a href="{{ url.get({"for": "group-explore"}) }}" >Explore Groups</a>
