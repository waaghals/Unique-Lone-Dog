<p>
    <a href="{{ url.get({"for": "group-show","slug": group.slug }) }}" >{{ group.name }}</a>
    <br>
    Description: {{ group.description }}
    <br>

    {{ partial('group/partials/subscribe') }}
</p>
</li>