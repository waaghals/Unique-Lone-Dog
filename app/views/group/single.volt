<div class="row">
    <h1>{{ group.name }}</h1>
</div>

<div class="row">
    <div class="grid-two-thirds">
        <h2>Latest items</h2>
        <ul>
            <li>Item</li>
            <li>Item</li>
            <li>Item</li>
            <li>Item</li>
            <li>Item</li>
        </ul>
    </div>
    <div class="grid-third">
        <h3>Group description</h3>
        <p>{{ group.description }}</p>
        {{ partial('group/partials/subscribe') }}

        <hr />
        <h3>Filters</h3>
        {# TODO: Make sexy #}
        {% for groupFilter in group.filters %}
        {% if loop.first %}
        <ul>
        {% endif %}
            <li>
{% if groupFilter.namespace is empty %}<span class="text-muted">namespace</span>{% else %}<span class="text-tall">{{groupFilter.namespace }}</span>{% endif %}:
{% if groupFilter.predicate is empty %}<span class="text-muted">predicate</span>{% else %}<span class="text-tall">{{groupFilter.predicate }}</span>{% endif %}=
{% if groupFilter.value is empty %}<span class="text-muted">value</span>{% else %}<span class="text-tall">{{groupFilter.value }}</span>{% endif %}
            </li>

        {% if loop.last %}
        </ul>
        {% endif %}
        {% endfor %}
        <a href="{{ url.get({"for": "group-addFilter","slug": group.slug }) }}" class="btn" >Add</a>
    </div>
</div>
