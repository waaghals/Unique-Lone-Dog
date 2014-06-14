{{ content() }}
{{ form() }}
{% for element in form %}
    {% if(subclass(element, '\Phalcon\Forms\Element\Hidden')) %}
      {{ element.render() }}
    {% else %}
<div class="row">
    <div class="grid-fourth">
                {% if(subclass(element, '\Phalcon\Forms\Element\Submit')) %}
        &nbsp;
                {% else %}
                    {{ element.label() }}
                {% endif %}
    </div>
    <div class="grid-three-fourths">
                {{ element.render() }}
    </div>
</div>
    {% endif %}
{% endfor %}
{{ end_form() }}
