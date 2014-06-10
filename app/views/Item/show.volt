{{ content() }}
<div>
    <h2>
        {{ item.name }}
    </h2>

    {{ item.URI }}
    <p>
        <h3>
            Comments:
        </h3>
        {% for comment in item.comments %}
            {{ comment.text }}
        {% endfor %}

        {{ partial('partials/genericForm') }}
    <p>
</div>