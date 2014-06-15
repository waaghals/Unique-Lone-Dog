<li>
    <p>
    <div>
        <a href="{{ url.get({"for": "item-show","id": item.id }) }}" >{{ item.name }}</a>
    </div>
    <div class="text-muted">
    {{ item.description }}
    </div>

    <a href="{{ item.URI }}" class="btn btn-secondary" >Open</a>
    <a href="{{ url.get({"for": "item-show","id": item.id }) }}" class="btn btn-secondary">Comments ({{ item.comments|length }})</a>
    {% if identity.get('role') == "Administrator" %}
    <a href="{{ url.get({"for": "group-delete","id": group.id }) }}" class="btn btn-secondary" >Delete</a>
    {% endif %}
</p>
</li>