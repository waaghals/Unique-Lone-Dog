{% set hasGroup = false %}
{% for gr in identity.getUser().groups %}
{% if gr.id == group.id %}
{% set hasGroup = true %}
{% endif %}

{% endfor %}

{% if hasGroup %}
<a href="{{ url.get({"for": "group-unsubscribe","id": group.id }) }}" class="btn btn-secondary">Unsubscribe</a>
{% else %}
<a href="{{ url.get({"for": "group-subscribe","id": group.id }) }}" class="btn" >Subscribe</a>
{% endif %}