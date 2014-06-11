{% set hasGroup = false %}
{% for gr in identity.getUser().groups %}

{% if gr == group %}
{% set hasGroup = true %}
{% endif %}

{% endfor %}

{% if hasGroup %}
<a href="{{ url.get({"for": "group-unsubscribe","id": group.id }) }}" >Unsubscribe</a>
{% else %}
<a href="{{ url.get({"for": "group-subscribe","id": group.id }) }}" >Subscribe</a>
{% endif %}