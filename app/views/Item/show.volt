<div>
    <h2>
        {% autoescape true %}
            {{ item.name }}
        {% endautoescape %}
    </h2>

    {{ item.URI }}
    <p>
        {% autoescape true %}
            {{ item.comment }}
        {% endautoescape %}
    <p>
</div>