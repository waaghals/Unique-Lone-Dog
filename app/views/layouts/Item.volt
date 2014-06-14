<div>
    <h2>
        {{ item.name }}
            {% if identity.get('role') == "Administrator" %}
                {{ link_to(['for': 'delete-item', 'itemId': item.id], 'Delete item.') }}
            {% endif %}
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
    <table class="commenttable">
        {% for comment in item.comments %}
        <tr>
            <td>{{ comment.user.name }} : </td>
            <td>{{ comment.text }} </td>
                    {% if identity.get('role') == "Administrator" %}
            <td>{{ link_to(['for': 'delete-comment', 'commentId': comment.id], 'Delete comment.') }}</td>
                    {% endif %}
        </tr>
        {% endfor %}
    </table>
    <br />
        {{ partial('partials/commentForm') }}
</p>
</div>