<div class="row">
    <h1>{{ group.name }}</h1>
</div>

<div class="row">
    <div class="grid-two-thirds">
        <h2>Latest items</h2>
        {% if group.tags.count() == 0 %}
        <p>
            Hub has no filters assigned.
            To show items in this hub you need to assign tags for filtering.
            Why don't you <a href="{{ url.get({"for": "group-addFilter","slug": group.slug }) }}">add</a> a filter.
        </p>
        {% endif %}
        {% for groupTag in group.tags %}
            {% for item in groupTag.items %}
                {{ partial('item/partials/listItem') }}
            {% endfor %}
        {% endfor %}
    </div>
    <div class="grid-third">
        <h3>Hub description</h3>
        <p>{{ group.description }}</p>
        {{ partial('group/partials/subscribe') }}

        <hr />
        <h3>Filters</h3>
        {# TODO: Make sexy #}
        {% for groupTag in group.tags %}
        {% if loop.first %}
        <ul>
        {% endif %}
            <li>
                {{groupTag.part}} <span class="text-muted text-small">{{ groupTag.id }}</span>
                <!-- phalcon bug: can't show perdicate and namespace -->
             {#   <span class="text-tall">{{groupTag.namespace }}</span><span class="text-muted">:</span><span class="text-tall">{{groupTag.predicate }}</span><span class="text-muted">=</span><span class="text-tall">{{groupTag.value }} #}
            </li>

        {% if loop.last %}
        </ul>
        {% endif %}
        {% endfor %}
        <a href="{{ url.get({"for": "group-addFilter","slug": group.slug }) }}" class="btn" >Add</a>
    </div>
</div>
