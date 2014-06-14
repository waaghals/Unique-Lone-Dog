<div>
    <h2>
        {{ item.name }} <br />
    </h2>
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
            {{ comment.text }} <br />
        {% endfor %}
        <br />
        {{ partial('partials/commentForm') }}
    </p>
</div>