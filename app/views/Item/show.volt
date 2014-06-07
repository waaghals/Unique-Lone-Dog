<div>
    {% autoescape true %}
        {{ item.name }}
    {% endautoescape %}
    
    {{ item.URI }}
    <p>
        {% autoescape true %}
            {{ item.comment }}
        {% endautoescape %}
    <p>
</div>