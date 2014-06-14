<h2>Your Hubs</h2>
<ul>
    {% for group in groups %}
    {{ partial('group/partials/listItem') }}
    {% endfor  %}
</ul>
<a href="{{ url.get({"for": "group-explore"}) }}" >Explore Hubs</a>
