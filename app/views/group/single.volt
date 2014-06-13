{%- macro printFilter(groupFilter) %}
{% if groupFilter.type == "namespace" %}
<strong>{{ groupFilter.part}}</strong>:<em>predicate</em>=<em>value</em>
{% elseif groupFilter.type == "predicate" %}
<em>namespace</em>:<strong>{{ groupFilter.part}}</strong>=<em>value</em>
{% elseif groupFilter.type == "value" %}
<em>namespace</em>:<em>predicate</em>=<strong>{{groupFilter.path}}</strong>
{% endif %}
{%- endmacro %}

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
        <h3>Group <small>descrition</small></h3>
        <p>{{ group.description }}</p>
        {{ partial('group/partials/subscribe') }}

        <h3>Filters</h3>
        {% for groupFilter in group.filters %}
            {{ printFilter(groupFilter) }}
        {% endfor %}
    </div>
</div>
