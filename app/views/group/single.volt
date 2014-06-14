<div class="row">
    <h1>{{ group.name }}</h1>
</div>

<div class="row">
    <div class="grid-two-thirds">
        {% for groupItem in group.latest() %}
        <h3>{{ groupItem.name }}</h3>
        <p>{{ groupItem.description }}</p>
        {% endfor %}
    </div>
    <div class="grid-third">
        <h3>Hub description</h3>
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
                <span class="text-tall">{{groupFilter.namespace }}</span><span class="text-muted">:</span><span class="text-tall">{{groupFilter.predicate }}</span><span class="text-muted">=</span><span class="text-tall">{{groupFilter.value }}
            </li>

        {% if loop.last %}
        </ul>
        {% endif %}
        {% endfor %}
        <a href="{{ url.get({"for": "group-addFilter","slug": group.slug }) }}" class="btn" >Add</a>
    </div>
</div>
