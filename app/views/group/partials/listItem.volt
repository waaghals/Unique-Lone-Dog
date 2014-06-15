<p>
    <a href="{{ url.get({"for": "group-show","slug": group.slug }) }}" >{{ group.name }}</a>
    {% if identity.get('Administrator') == "Users" %}
    <br />
        {{ link_to(['for': 'group-delete', 'id': group.id], 'Delete hub.') }}
    {% endif %}
    <br />
    Description: {{ group.description }}
    <br />

    {{ partial('group/partials/subscribe') }}
</p>
</li>