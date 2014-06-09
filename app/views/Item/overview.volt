{{ stylesheet_link("css/itemOverview.css") }}

<div class="text-center">
    {{ link_to("item/add", "Add new") }}
</div>
<h2> Items </h2>

{% for item in items %}
    <div>
    <h3>
        {{ link_to(['for': 'item-show', 'id': item.id], item.name) }}
    </h3>
        <div class="ImageContainer">
            <img src="{{ item.URI }}" id="Image">
        </div>
    </div>
{% endfor %}
