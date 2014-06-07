{{ stylesheet_link("css/itemOverview.css") }}
<div class="text-center">
    {{ link_to("item/add", "Add new") }}
</div>
<h2> Items </h2>

{% for item in items %}
    <div>
        {{ link_to(['for': 'item-show', 'id': item.id], item.name) }}
        <div class="ImageContainer">
            <img src="{{ item.URI }}" href=
        </div>
    </div>
{% endfor %}
