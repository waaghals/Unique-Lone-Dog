<div class="text-center">
    {{ link_to("item/add", "Add new") }}
</div>
<h2> Items </h2>

{% for item in items %}
    <div border="1px black">
    <h3>
        {{ link_to(['for': 'item-show', 'id': item.id], item.name) }}
    </h3>
    Comment count: {{ item.comments|length }}
    </div>
{% endfor %}
