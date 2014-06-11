<div>
    <h2>
        {{ item.name }}
    </h2>
        {{ content() }}
        <p>
        <h3>
            Comments:
        </h3>
        {% for comment in item.comments %}
            {{ comment.user.name }} :
            {{ comment.text }} <br />
        {% endfor %}
        <br />
        {{ partial('partials/commentForm') }}
    </p>
</div>