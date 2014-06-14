<div>
    <h2>{{ item.name }}</h2>
    <p>
        Description: <br />
        {{ item.description }}
    </p>
        {{ content() }}
    <p>
    <h3>
        Comments:
    </h3>
        {% for comment in item.comments %}
            {{ comment.user.name }} :
            {{ comment.text }}
    <hr />
        {% endfor %}

        {{ partial('partials/commentForm') }}
</div>