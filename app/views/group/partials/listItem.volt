<li>
    <p>
    <div>
        <a href="{{ url.get({"for": "group-show","slug": group.slug }) }}" >{{ group.name }}</a>
    </div>
    <div class="text-muted">
    {{ group.description }}
    </div>

    {{ partial('group/partials/subscribe') }}
    {% if identity.get('role') == "Administrator" %}
    <a href="{{ url.get({"for": "group-delete","id": group.id }) }}" class="btn btn-secondary" >Delete</a>
    {% endif %}
</p>
</li>